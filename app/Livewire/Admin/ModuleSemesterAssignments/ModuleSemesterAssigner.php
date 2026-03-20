<?php


namespace App\Livewire\Admin\ModuleSemesterAssignments;

use App\Models\Department;
use App\Models\Module;
use App\Models\Semester;
use App\Models\ModuleSemester;
use Livewire\Component;
use App\Services\ModuleSemesterService;

class ModuleSemesterAssigner extends Component
{

    // Reactive update trigger
    public $refreshKey = 0;

    public $departmentId;
    public $moduleId;
    public $semesterId;
    public $offeringType = 'main';
    public $assignResit = false;

    public $filteredModules = [];

    public function updatedDepartmentId() 
    { 
        if(empty($this->departmentId))
        {
            // $this->moduleId = null;
            $this->semesterId = null;
            $this->offeringType = 'main';

        }
        $this->filterModules(); 
    }
    public function updatedSemesterId() 
    { 
        $this->filterModules(); 
    }
    public function updatedOfferingType() 
    { 
        $this->filterModules(); 
    }



    public function assign()
    {
        $this->validate([
            'departmentId' => 'required|exists:departments,id',
            'moduleId' => 'required|exists:modules,id',
            'semesterId' => 'required|exists:semesters,id',
        ]);


        // Main assignment (Semester 1 or 2)
        app(ModuleSemesterService::class)->validateAndAssign(
            $this->moduleId,
            $this->semesterId,
            $this->offeringType
        );

        // Optional resit assignment (Semester 3 of same academic year)
        if ($this->assignResit) {
            $mainSemester = Semester::findOrFail($this->semesterId);
            $semester3 = Semester::where('academic_year', $mainSemester->academic_year)
                ->where('name', 'Semester 3')
                ->first();

            if ($semester3) {
                app(ModuleSemesterService::class)->validateAndAssign(
                    $this->moduleId,
                    $semester3->id,
                    'resit'
                );
            }
        }

        $this->reset(['moduleId', 'semesterId', 'assignResit']);
        $this->dispatch('toast', 'Module assigned successfully.');
        $this->refreshKey ++;

    }



    public function remove($id)
    {
        ModuleSemester::findOrFail($id)->delete();
        $this->dispatch('toast', 'Assignment removed.');
        $this->refreshKey ++;

    }


    protected function filterModules()
    {
        $academicYear = Semester::find($this->semesterId)?->academic_year;

        $this->filteredModules = Module::whereHas('departments', fn ($q) =>
            $q->where('departments.id', $this->departmentId)
        )->when($academicYear, fn ($query) =>
            $query->whereDoesntHave('moduleSemesters', fn ($q) =>
                $q->where('offering_type', $this->offeringType)
                  ->whereHas('semester', fn ($sq) =>
                      $sq->where('academic_year', $academicYear)
                  )
            )
        )->get();
    }

    public function render()
    {
        //Do not remove this 
        // return view('livewire.admin.module-semester-assignments.module-semester-assigner', [
        //     'departments' => Department::orderBy('name')->get(),
        //     'semesters' => Semester::whereIn('name', ['Semester 1', 'Semester 2','Full Year'])
        //                 ->orderBy('start_date')->get(),
        //     'assigned' => ModuleSemester::with(['module', 'semester'])
        //         ->when($this->departmentId, fn ($q) =>
        //             $q->whereHas('module.departments', fn ($q2) =>
        //                 $q2->where('departments.id', $this->departmentId)
        //             )
        //         )->get()
        // ]);

        return view('livewire.admin.module-semester-assignments.module-semester-assigner', [
            'departments' => Department::cachedList(),
            'semesters' => Semester::cachedStandardSemesters(),
            // 'assigned' => ModuleSemester::cachedAssignedByDepartment($this->departmentId)
        ]);
    }
}
