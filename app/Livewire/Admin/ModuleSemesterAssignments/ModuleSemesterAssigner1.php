<?php

namespace App\Livewire\Admin\ModuleSemesterAssignments;

use App\Models\Module;
use App\Models\Semester;
use App\Models\ModuleSemester;
use Livewire\Component;

class ModuleSemesterAssigner extends Component
{
    public $module_id;
    public $semester_id;
    public $editing = null;
    public $assignedSemesters = [];
    public $availableModules = [];
    public $availableSemesters = [];

    public function mount()
    {
        $this->availableModules = Module::orderBy('name')->get();
        $this->availableSemesters = Semester::orderBy('start_date')->get();
    }

    public function updatedModuleId()
    {
        $this->loadAssignedSemesters();
    }

    public function loadAssignedSemesters()
    {
        if ($this->module_id) {
            $this->assignedSemesters = ModuleSemester::with('semester')
                ->where('module_id', $this->module_id)
                ->get();
        } else {
            $this->assignedSemesters = [];
        }
    }

    public function assign()
    {
        $this->validate([
            'module_id' => 'required|exists:modules,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        ModuleSemester::firstOrCreate([
            'module_id' => $this->module_id,
            'semester_id' => $this->semester_id,
        ]);

        $this->reset('semester_id');
        $this->loadAssignedSemesters();
        session()->flash('success', 'Semester assigned to module.');
    }

    public function remove($id)
    {
        ModuleSemester::findOrFail($id)->delete();
        $this->loadAssignedSemesters();
        session()->flash('success', 'Semester removed.');
    }

    public function render()
    {
        return view('livewire.admin.module-semester-assignments.module-semester-assigner');
    }
}
