<?php

namespace App\Livewire\Admin\Practicals;

use App\Models\Department;
use App\Models\Practical;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class PracticalManager extends Component
{

    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;

    public ?Practical $editing = null;

    public string $title = '';
    public string $description = '';
    public ?int $department_id = null;

    public function mount(): void
    {
        $this->resetForm();
    }

    public function create(): void
    {
        // $this->authorize('create', Practical::class);
        $this->validateForm();

        Practical::create([
            'title' => $this->title,
            'description' => $this->description,
            'department_id' => $this->department_id,
        ]);

        session()->flash('success', 'Practical created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Practical $practical): void
    {
        // $this->authorize('update', $practical);

        $this->editing = $practical;
        $this->title = $practical->title;
        $this->description = $practical->description ?? '';
        $this->department_id = $practical->department_id;
    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();

        $this->editing->update([
            'title' => $this->title,
            'description' => $this->description,
             'department_id' => $this->department_id,

        ]);

        session()->flash('success', 'Practical updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function delete(Practical $practical): void
    {
        // $this->authorize('delete', $practical);
       
         $this->safeDelete(
            fn() => $practical->delete(), 
            'Practical deleted successfully.',
            'Cannot delete this practical because it is referenced by other records.'
        );
        $this->refreshKey++;
        $this->resetForm();

    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->title = '';
        $this->description = '';
        $this->department_id = null;
    }

    public function validateForm(): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.practicals.practical-manager', [
            // 'practicals' => Practical::orderBy('title')->get(),
            // 'departments' => Department::orderBy('name')->get(),
            'departments' => Department::cachedList(),

        ]);
    }
}
