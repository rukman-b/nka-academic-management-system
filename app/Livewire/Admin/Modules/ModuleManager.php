<?php

namespace App\Livewire\Admin\Modules;

use App\Models\Module;
use App\Models\Level;
use App\Models\Department; 
use Illuminate\Validation\Rule;
use Livewire\Component;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Cache;

class ModuleManager extends Component
{
    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;


    public ?Module $editing = null;

    public string $module_code = '';
    public string $name = '';
    public ?string $fheq_level_id = '';
    public string $description = '';
    public array $department_ids = [];
    public int $mark = 0;
    public ?string $lecturer_id = null;
    // public $lecturers = null;

    public function mount(): void
    {
        //  $this->lecturers = collect(); // ensures it's never null
    }

    public function updatedDepartmentIds()
    {
        $this->filterLecturers();
    }

    private function filterLecturers()
    {
        //  $this->lecturers = !empty($this->department_ids)
        // ? Lecturer::whereIn('department_id', $this->department_ids)->orderBy('name')->get()
        // : collect();
         return !empty($this->department_ids)
        ? Lecturer::whereIn('department_id', $this->department_ids)->orderBy('name')->get()
        : collect();

    }

    public function create(): void
    {
        // $this->authorize('create', Module::class);
        $this->validateForm();

        $module = Module::create([
            'module_code'       => $this->module_code,
            'name'              => $this->name,
            'fheq_level_id'   => $this->fheq_level_id ?: null,
            'description'       => $this->description,
            'mark'  => $this->mark,
            'lecturer_id' => $this->lecturer_id ?: null,
            
        ]);

        $module->departments()->sync($this->department_ids);

        session()->flash('success', 'Module created successfully.');
        $this->refreshKey++;
        $this->resetExcept('refreshKey');
    }

    public function edit(Module $module): void
    {
        // $this->authorize('update', $module);

        $this->reset();

        $this->editing = $module;
        $this->module_code = $module->module_code;
        $this->name = $module->name;
        $this->fheq_level_id = (string) ($module->fheq_level_id ?? '');
        $this->description = $module->description ?? '';
        $this->department_ids = $module->departments()->pluck('departments.id')->toArray();
        $this->mark = $module->mark;
        $this->lecturer_id = $module->lecturer_id;
        $this->filterLecturers();

    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();


        $this->editing->update([
            'module_code'=> $this->module_code,
            'name' => $this->name,
            'fheq_level_id' => $this->fheq_level_id ?: null,
            'description' => $this->description,
            'mark' => $this->mark,
            'lecturer_id' => $this->lecturer_id ?: null,
        ]);

        $this->editing->departments()->sync($this->department_ids);

        session()->flash('success', 'Module updated successfully.');
        // $this->resetForm();
        $this->refreshKey++;
        $this->resetExcept('refreshKey');
        $this->filterLecturers();

    }

    public function delete(Module $module): void
    {
        // $this->authorize('delete', $module);
        

         $this->safeDelete(
            fn() => $module->delete(),
            'Module deleted successfully.',
            'Cannot delete this module because it is referenced by other records.'
        );
        $this->refreshKey++;
        // $this->resetForm();
        $this->resetExcept('refreshKey');

    }

    public function resetForm(): void
    {
        $this->reset();
        $this->filterLecturers();
    }

    public function validateForm(): void
    {
        $this->validate([
            // 'module_code' => ['required', 'regex:/^[A-Z]{4}[0-9]{5}$/'],
            'module_code' => ['required'],
            'name' => ['required', 'string', 'max:255', Rule::unique('modules', 'name')->ignore(optional($this->editing)->id)],
            'fheq_level_id' => ['required', Rule::exists('levels', 'id')],
            'description' => ['nullable', 'string'],
            'department_ids' => ['required', 'array','min:1'],
            'department_ids.*' => [Rule::exists('departments', 'id')],
            'lecturer_id' => ['nullable', 'exists:lecturers,id'],
            'mark' => ['required', 'numeric', 'min:0', 'max:100'],]);
    }

    public function render()
    {
        return view('livewire.admin.modules.module-manager', [
        'levels' => Level::cachedList(),
        'departments' => Department::cachedList(),
        
        'lecturers' => $this->filterLecturers(),
    ]);

    }
}
