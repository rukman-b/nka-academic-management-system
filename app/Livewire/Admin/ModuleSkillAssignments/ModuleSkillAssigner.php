<?php

namespace App\Livewire\Admin\ModuleSkillAssignments;

use App\Models\Module;
use App\Models\Skill;
use App\Models\Department;
use App\Models\ModuleSkill;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class ModuleSkillAssigner extends Component
{
     use HandlesDeleteExceptions;

    public $department_id = '';
    public $module_id = '';
    public $selectedSkillIds = [];

    public $departments;
    public $filteredModules = [];
    public $filteredSkills = [];
    public $assignments = [];

    public $refreshKey = 0;

    public function mount(): void
    {
        // $this->departments = Department::orderBy('name')->get(); //Do not rmove
        // $this->assignments = ModuleSkill::with(['module','skill'])->get(); // Do not remove

        $this->departments = Department::cachedList();
        $this->assignments = ModuleSkill::cachedWithRelations();
        // dd($this->assignments);
    }

   public function updatedDepartmentId(): void
    {
        $this->reset(['module_id', 'filteredModules', 'selectedSkillIds', 'filteredSkills', 'assignments']);

        if ($this->department_id) {
            // Load modules that belong to the selected department
            $this->filteredModules = Module::whereHas('departments', function ($query) {
                $query->where('departments.id', $this->department_id);
            })->orderBy('name')->get();

            // Load all skill assignments for modules in this department
            $this->assignments = ModuleSkill::whereHas('module.departments', function ($query) {
                $query->where('departments.id', $this->department_id);
            })
            ->with(['module', 'skill.skillCategory']) // eager load all relationships
            ->get();
        }
        else
        {
            $this->mount();
        }
    }


    public function updatedModuleId(): void
    {
        $this->selectedSkillIds = [];
        $this->filteredSkills = [];
        $this->assignments = [];

        if ($this->module_id) {
            // Get assigned skill IDs for this module
            $assignedSkillIds = ModuleSkill::where('module_id', $this->module_id)
                ->pluck('skill_id');

            // Get unassigned skills
            $this->filteredSkills = Skill::whereNotIn('id', $assignedSkillIds)
                ->orderBy('name')
                ->get();

            // Get current skill assignments with full details
            $this->assignments = ModuleSkill::where('module_id', $this->module_id)
                ->with(['module', 'skill.skillCategory'])
                ->get();
        }
        else
        {
            $this->updatedDepartmentId();
        }
    }

    public function resetForm()
    {
        
    }


    public function assign(): void
    {

        // dd($this->selectedSkillIds);
        
        $this->validate([
            'module_id' => 'required|exists:modules,id',
            'selectedSkillIds' => 'required|array|min:1',
            'selectedSkillIds.*' => 'exists:skills,id'
        ]);

        

        foreach ($this->selectedSkillIds as $skillId) {
            DB::table('module_skill')->insertOrIgnore([
                'module_id' => $this->module_id,
                'skill_id' => $skillId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        session()->flash('success', 'Skills assigned to module successfully.');
        $this->updatedModuleId();
        $this->refreshKey++;
    }

    public function delete($id): void
    {
       
        // $this->authorize('delete', $skill);
        
        $assignment = ModuleSkill::findOrFail($id);

         $this->safeDelete(
            fn() =>  $assignment->delete(),
            'Module-skill assignment deleted successfully.',
            'Cannot delete this module-skill assignment because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->reset(['selectedSkillIds', 'filteredSkills', 'assignments']);



        if(!empty($this->module_id))
        {

            $this->updatedModuleId();
        }
        elseif(!empty($this->department_id))
        {
            $this->updatedDepartmentId();
        }
        else
        {
            $this->mount();
        }
    }

   public function render()
   {
       return view('livewire.admin.module-skill-assignments.module-skill-assigner', [
           'availableSkills' => $this->filteredSkills,
           'moduleSkillAssginments' => $this->assignments,
       ]);
    }

}
