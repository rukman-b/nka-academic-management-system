<?php

namespace App\Livewire\Admin\PracticalModuleAssignments;

use App\Models\Module;
use App\Models\Practical;
use App\Models\Department;
use App\Models\ModulePractical;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;
use Illuminate\Support\Facades\Cache;

class PracticalModuleAssigner extends Component
{

    use HandlesDeleteExceptions;

    public $department_id = '';
    public $practical_id = '';
    public $module_id = '';
    public $lab_room = '';
    public $instructor_notes = '';

    public $departments;
    public $filteredPracticals = [];
    public $filteredModules = [];
    public $assignments;

    public $item;

    public $refreshKey = 0;

    public function mount(): void
    {
        $this->departments = Department::orderBy('name')->get();
        $this->assignments = ModulePractical::all();
        // foreach($this->assignments as $assignment)
        // {
        //     dd($assignment->id);
        // }
    }

    public function delete(ModulePractical $modulePractical)
    {
         // $this->authorize('delete', $practical);
       
         $this->safeDelete(
            fn() => $modulePractical->delete(),
            'Module-practical assignment deleted successfully.',
            'Cannot delete this module-practical assignment because it is referenced by other records.' 
        );
        
        $this->refreshKey++;
        // $this->resetForm();


        if (!empty($this->practical_id)) {
            $this->updatedPracticalId(); // re-filter modules and assignments
        } elseif (!empty($this->department_id)) {
            $this->updatedDepartmentId();
        } else {
            $this->mount(); // full reload if nothing is selected
        }
    }



    public function updatedDepartmentId(): void
    {
        // $this->reset(['practical_id', 'module_id', 'filteredPracticals', 'filteredModules', 'lab_room', 'instructor_notes']);

        $this->resetForm();

        if ($this->department_id) 
        {
            $this->filteredPracticals = Practical::where('department_id', $this->department_id)
                ->orderBy('title')
                ->get();

            $this->filteredModules = Module::whereHas('departments', function ($query) {
                $query->where('departments.id', $this->department_id);
                })
                ->orderBy('name')
                ->get();

        $this->assignments = ModulePractical::with('module')
            ->whereHas('module.departments', function ($query) {
                $query->where('departments.id', $this->department_id);
            })
            ->get();

        }
        else
        {
            $this->mount();
        }
    }

    //Do not remove this
    // public function updatedPracticalId(): void
    // {
    //     $this->module_id = '';
    //     $this->lab_room = '';
    //     $this->instructor_notes = '';

    //   if ($this->practical_id && $this->department_id) {
    //         $assignedModuleIds = ModulePractical::where('practical_id', $this->practical_id)
    //             ->pluck('module_id');

    //         // Query only the IDs from the pivot table
    //         $moduleIdsOfDepartment = DB::table('module_department')
    //             ->where('department_id', $this->department_id)
    //             ->pluck('module_id');

    //         // Get modules not yet assigned to this practical
    //         $availableModuleIds = $moduleIdsOfDepartment->diff($assignedModuleIds);

    //         // Retrieve the Module models
    //         $this->filteredModules = Module::whereIn('id', $availableModuleIds)
    //             ->orderBy('name')
    //             ->get();

    //         // Load current assignments
    //         $this->assignments = ModulePractical::with('module')
    //             ->where('practical_id', $this->practical_id)
    //             ->get();
    //      }
    //      elseif(empty($this->practical_id) && $this->department_id)
    //      {
    //         $this->updatedDepartmentId();
    //      }

    // }
    

    public function updatedPracticalId(): void
    {
        if ($this->practical_id && $this->department_id) {
        $assignedModuleIds = Cache::tags(['module_practicals'])->remember(
            "assigned_module_ids_for_practical_{$this->practical_id}",
            now()->addHours(2),
            fn () => ModulePractical::where('practical_id', $this->practical_id)
                ->pluck('module_id')
        );

        $moduleIdsOfDepartment = Cache::tags(['module'])->remember(
            "module_ids_for_department_{$this->department_id}",
            now()->addWeeks(1),
            fn () => DB::table('module_department')
                ->where('department_id', $this->department_id)
                ->pluck('module_id')
        );

        $this->filteredModules = Cache::tags(['module'])->remember(
            "filtered_modules_for_practical_{$this->practical_id}_department_{$this->department_id}",
            now()->addHours(1),
            fn () => Module::whereIn('id', $moduleIdsOfDepartment->diff($assignedModuleIds))
                ->orderBy('name')
                ->get()
        );

        $this->assignments = Cache::tags(['module_practicals'])->remember(
            "assignments_for_practical_{$this->practical_id}",
            now()->addHours(2),
            fn () => ModulePractical::with('module')
                ->where('practical_id', $this->practical_id)
                ->get()
        );
    }

    }

    public function assign(): void
    {
        $this->validate([
            'practical_id' => 'required|exists:practicals,id',
            'module_id' => 'required|exists:modules,id',
            'lab_room' => 'nullable|string|max:255',
            'instructor_notes' => 'nullable|string',
        ]);

        ModulePractical::create([
            'practical_id' => $this->practical_id,
            'module_id' => $this->module_id,
            'lab_room' => $this->lab_room,
            'instructor_notes' => $this->instructor_notes,
        ]);

        $this->module_id = '';
        $this->lab_room = '';
        $this->instructor_notes = '';

        $this->updatedPracticalId();
        session()->flash('success', 'Practical assigned to module successfully.');
        $this->refreshKey++;
    }

    public function render()
    {
        return view('livewire.admin.practical-module-assignments.practical-module-assigner');
    }

    public function resetForm(): void
    {
        // $this->practical_id = '';
        // $this->module_id = '';
        $this->lab_room = '';
        $this->instructor_notes = '';
        $this->filteredModules = [];
        $this->filteredPracticals = [];
    }


    public function loadDetailsModal($id)
    {
        $this->item = ModulePractical::findOrFail($id);
        $this->dispatch('show-details-modal');
    }

}
