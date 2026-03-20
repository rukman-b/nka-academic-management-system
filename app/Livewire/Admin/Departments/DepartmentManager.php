<?php

namespace App\Livewire\Admin\Departments;

use App\Models\Department;
use Illuminate\Validation\Rule;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;
use App\Livewire\Traits\InteractsWithAddress;


class DepartmentManager extends Component
{

    use InteractsWithAddress, HandlesDeleteExceptions;
    
    // Reactive update trigger
    public $refreshKey = 0;

    public $address = [];

    public ?Department $editing = null;
    public string $name = '';
    public string $description = '';

    public function mount(): void
    {
        // $this->resetForm();
        $this->address = $this->defaultAddress();
    }

    public function create(): void
    {
        // $this->authorize('create', Department::class);
        $this->validateForm();

        // dd($this->address);
        $department = Department::create([
                                            'name' => $this->name,
                                            'description' => $this->description,
                                        ]);

        $department->address()->create($this->address);

        session()->flash('success', 'Department created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Department $department): void
    {
        // $this->authorize('update', $department);

        $this->editing = $department;
        $this->name = $department->name;
        $this->description = $department->description;

        $this->address = $department->address?->toArray() ?? $this->defaultAddress();
        // dd($this->address);
    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();

        // dd($this->name);
        $this->editing->update([
            'name' => $this->name,
            'description'=>$this->description,
        ]);

        if ($this->editing->address) {
                $this->editing->address->update($this->address);
            } else {
                $this->editing->address()->create($this->address);
            }

        session()->flash('success', 'Department updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }


    public function delete(Department $department): void
    {

        $this->safeDelete(
            fn() => $department->delete(),
            'Department deleted successfully.',
            'Cannot delete this department because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->resetForm();


    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->name = '';
        $this->description = '';

        
        $this->address = $this->defaultAddress();
        
    }


    public function validateForm(): void
    {
        $this->validate(array_merge([
            'name' => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->ignore(optional($this->editing)->id)],
            'description' => ['nullable', 'string'],
        ], $this->addressValidationRules()));
    }


    public function render()
    {
        return view('livewire.admin.departments.department-manager', [
            // 'departme  nts' => Department::orderBy('name')->get(),
        ]);
    }
}
