<?php

namespace App\Livewire\Admin\ModuleTheoryAssignments;

use App\Models\Module;
use App\Models\Theory;
use App\Models\Department;
use App\Models\ModuleTheory;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;
use Illuminate\Support\Facades\Cache;

class ModuleTheoryAssigner extends Component
{

    use HandlesDeleteExceptions;

    public $department_id = '';
    public $theory_id = '';
    public $module_id = '';
    public $teaching_notes = '';

    public $departments;
    public $filteredTheories = [];
    public $filteredModules = [];
    public $assignments;

    public $item;

    public $refreshKey = 0;

    public function mount(): void
    {
        // $this->departments = Department::orderBy('name')->get(); // Do not remove this
        // $this->assignments = ModuleTheory::all(); //Do not remove this

        $this->departments = Department::cachedList();
        $this->assignments = ModuleTheory::cachedAllWithRelations();
    }

    //Do not remove this
    public function updatedDepartmentId(): void
    {
        // $this->reset(['theory_id', 'module_id', 'filteredTheories', 'filteredModules', 'teaching_notes']);
        $this->resetForm();

        if ($this->department_id)
        {
            $this->filteredTheories = Theory::where('department_id', $this->department_id)
                ->orderBy('title')
                ->get();

            $this->filteredModules = Module::whereHas('departments', function ($query) {
                $query->where('departments.id', $this->department_id);
            })
                ->orderBy('name')
                ->get();

            $this->assignments = ModuleTheory::with('module')
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

    public function delete(ModuleTheory $moduleTheory)
    {

        $this->safeDelete(
            fn() =>  $moduleTheory->delete(),
            'Module-theory assignment deleted successfully.',
            'Cannot delete this module-theory assignment because it is referenced by other records.'
        );

        $this->refreshKey++;
        // $this->resetForm();


        if (!empty($this->theory_id)) {
            $this->updatedTheoryId(); // re-filter modules and assignments
        } elseif (!empty($this->department_id)) {
            $this->updatedDepartmentId();
        } else {
            $this->mount(); // full reload if nothing is selected
        }

        // $this->authorize('delete', $theory);
       
    }

    public function resetForm(): void
    {
        $this->theory_id = '';
        $this->module_id = '';
        $this->filteredModules = [];
        $this->filteredTheories = [];
        $this->teaching_notes = '';
    }



    //Do not remove this
    public function updatedTheoryId(): void
    {
        $this->module_id = '';
        $this->teaching_notes = '';

        if ($this->theory_id && $this->department_id) {
            $assignedModuleIds = ModuleTheory::where('theory_id', $this->theory_id)
                ->pluck('module_id');

            $moduleIdsOfDepartment = DB::table('module_department')
                ->where('department_id', $this->department_id)
                ->pluck('module_id');

            $availableModuleIds = $moduleIdsOfDepartment->diff($assignedModuleIds);

            $this->filteredModules = Module::whereIn('id', $availableModuleIds)
                ->orderBy('name')
                ->get();

            $this->assignments = ModuleTheory::with('module')
                ->where('theory_id', $this->theory_id)
                ->get();
        }
        elseif (empty($this->theory_id) && $this->department_id)
        {
            $this->updatedDepartmentId();
        }
    }

    

    public function assign(): void
    {
        $this->validate([
            'theory_id' => 'required|exists:theories,id',
            'module_id' => 'required|exists:modules,id',
            'teaching_notes' => 'nullable|string',
        ]);

        ModuleTheory::create([
            'theory_id' => $this->theory_id,
            'module_id' => $this->module_id,
            'teaching_notes' => $this->teaching_notes,
        ]);

        $this->module_id = '';
        $this->teaching_notes = '';

        $this->updatedTheoryId();
        session()->flash('success', 'Theory assigned to module successfully.');
        $this->refreshKey++;
    }

    public function render()
    {
        return view('livewire.admin.module-theory-assignments.module-theory-manager');
    }

    public function loadDetailsModal($id)
    {
       
        $this->item = ModuleTheory::findOrFail($id);
        $this->dispatch('show-details-modal');
    }
}
