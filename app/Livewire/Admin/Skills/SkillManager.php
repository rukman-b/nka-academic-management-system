<?php

namespace App\Livewire\Admin\Skills;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class SkillManager extends Component
{

    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;


    public ?Skill $editing = null;

    public string $name = '';
    public string $skill_category_id = '';
    public ?string $description = '';

    public function mount(): void
    {
        $this->resetForm();
    }

    public function create(): void
    {
        $this->authorize('create', Skill::class);
        $this->validateForm();

        Skill::create([
            'name' => $this->name,
            'skill_category_id' => $this->skill_category_id,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Skill created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Skill $skill): void
    {
        $this->authorize('update', $skill);

        $this->editing = $skill;
        $this->name = $skill->name;
        $this->skill_category_id = $skill->skill_category_id;
        $this->description = $skill->description;
    }

    public function update(): void
    {
        $this->authorize('update', $this->editing);
        $this->validateForm();

        $this->editing->update([
            'name' => $this->name,
            'skill_category_id' => $this->skill_category_id,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Skill updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function delete(Skill $skill): void
    {
        $this->authorize('delete', $skill);

         $this->safeDelete(
            fn() =>  $skill->delete(),
            'Skill deleted successfully.',
            'Cannot delete this skill because it is referenced by other records.'
        );


        $this->refreshKey++;
        $this->resetForm();

    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->name = '';
        $this->skill_category_id = '';
        $this->description = '';
    }

    public function validateForm(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('skills', 'name')->ignore(optional($this->editing)->id)],
            'skill_category_id' => ['required', Rule::exists('skill_categories', 'id')],
             'description' => ['nullable', 'string'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.skills.skill-manager', [
            'categories' => SkillCategory::cachedOrdered(),
        ]);
    }


    public function showDetails($id)
    {
        $this->editing = Skill::findOrFail($id);
        $this->dispatch('show-config-modal');
    }
}
