<?php

namespace App\Livewire\Admin\Theories;

use App\Models\Department;
use App\Models\Theory;
use Illuminate\Validation\Rule;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class TheoryManager extends Component
{

    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;

    public ?Theory $editing = null;

    public string $department_id = '';
    public string $title = '';
    public string $description = '';

    public function mount(): void
    {
        $this->resetForm();
    }

    public function create(): void
    {
       
        // $this->authorize('create', Theory::class);
        $this->validateForm();

        Theory::create([
            'department_id' => $this->department_id,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Theory created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Theory $theory): void
    {
        // $this->authorize('update', $theory);

        $this->editing = $theory;
        $this->department_id = $theory->department_id;
        $this->title = $theory->title;
        $this->description = $theory->description ?? '';
    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();

        $this->editing->update([
            'department_id' => $this->department_id,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Theory updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function delete(Theory $theory): void
    {
        // $this->authorize('delete', $theory);
       
         $this->safeDelete(
            fn() =>  $theory->delete(),
            'Theory deleted successfully.',
            'Cannot delete this theory because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->resetForm();


    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->department_id = '';
        $this->title = '';
        $this->description = '';
    }

    public function validateForm(): void
    {
        $this->validate([
            'department_id' => ['required', Rule::exists('modules', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.theories.theory-manager', [
            // 'theories' => Theory::with('department')->orderBy('title')->get(), //Do not remove this line of
            // 'departments' => Department::orderBy('name')->get(),
            'departments' => Department::cachedList(),
        ]);
    }
}
