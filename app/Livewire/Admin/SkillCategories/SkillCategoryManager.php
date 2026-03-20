<?php

namespace App\Livewire\Admin\SkillCategories;

use App\Models\SkillCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class SkillCategoryManager extends Component
{
    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;


    public ?SkillCategory $editing = null;
    public string $name = '';

    public function mount(): void
    {
        $this->resetForm();
    }

    public function create(): void
    {
        // $this->authorize('create', SkillCategory::class);
        $this->validateForm();

        SkillCategory::create([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Skill category created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(SkillCategory $category): void
    {
        // $this->authorize('update', $category);

        $this->editing = $category;
        $this->name = $category->name;
    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();

        $this->editing->update([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Skill category updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function delete(SkillCategory $category): void
    {
        // $this->authorize('delete', $category);
       
         $this->safeDelete(
            fn() =>  $category->delete(),
            'Skill category deleted successfully.',
            'Cannot delete this skill category because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->resetForm();

    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->name = '';
    }

    public function validateForm(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('skill_categories', 'name')->ignore(optional($this->editing)->id)],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.skill-categories.skill-categories-manager', [
            'categories' => SkillCategory::orderBy('name')->get(),
        ]);
    }
}
