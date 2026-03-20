<?php

namespace App\Livewire\Admin\Programmes;

use Livewire\Component;
use App\Models\Programme;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Level;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;

class ProgrammeManager extends Component
{
    use HandlesDeleteExceptions;


    public $refreshKey = 0;

    public ?Programme $editing = null;

    public string $name = '';
    public string $department_id = '';
    public string $short_name = '';
    public ?int $starting_level_id;
    public ?int $offered_level_id;

    public function mount(): void
    {
        $this->resetForm();
    }

    public function updated($property): void
    {
        if ($property === 'name') {
            $this->generateShortNameFromName();
        }
    }

    public function generateShortNameFromName(): void
    {
        $words = explode(' ', $this->name);

        if (count($words) > 1) {
            $level = strtoupper(Str::slug(array_shift($words), '_'));
            $programme = strtoupper(collect($words)->map(fn($w) => substr($w, 0, 3))->implode('_'));
            $this->short_name = $level . '_' . $programme;
        }
    }

    public function create(): void
    {
        $this->validateForm();

        Programme::create([
            'name' => $this->name,
            'short_name' => $this->short_name,
            'department_id' => $this->department_id,
            'starting_level_id' => $this->starting_level_id,
            'offered_level_id' => $this->offered_level_id,
        ]);

        session()->flash('success', 'Programme created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Programme $programme): void
    {
        $this->editing = $programme;
        $this->name = $programme->name;
        $this->short_name = $programme->short_name;
        $this->department_id = $programme->department_id;
        $this->starting_level_id = $programme->starting_level_id;
        $this->offered_level_id = $programme->offered_level_id;
    }

    public function update(): void
    {
        $this->validateForm();

        $this->editing->update([
            'name' => $this->name,
            'short_name' => $this->short_name,
            'department_id' => $this->department_id,
            'starting_level_id' => $this->starting_level_id,
            'offered_level_id' => $this->offered_level_id,

        ]);

        session()->flash('success', 'Programme updated successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function delete(Programme $programme): void
    {
       

        $this->safeDelete(
            fn() => $programme->delete(),
            'Programme deleted successfully.',
            'Cannot delete this programme because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->resetForm();

    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->name = '';
        $this->short_name = '';
        $this->department_id = '';
        $this->starting_level_id = null;
        $this->offered_level_id = null;
    }

    public function validateForm(): void
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('programmes', 'name')->ignore(optional($this->editing)->id),
            ],
            'short_name' => [
                'required',
                'string',
                'min:3',
                'max:25',
                'regex:/^[A-Z0-9_]+$/',
                Rule::unique('programmes', 'short_name')->ignore(optional($this->editing)->id),
            ],
            'department_id' => ['required', Rule::exists('departments', 'id')],
            'starting_level_id' => ['required', 'integer', Rule::exists('levels', 'id')],
            'offered_level_id' => ['required', 'integer', Rule::exists('levels', 'id')],
        ]);

        $startingLevel = Level::find($this->starting_level_id);
        $offeredLevel = Level::find($this->offered_level_id);

        if ($startingLevel && $offeredLevel && $startingLevel->fheq_level > $offeredLevel->fheq_level) {
            $this->addError('starting_level_id', 'The starting level must be less than or equal to the offered level.');
            throw \Illuminate\Validation\ValidationException::withMessages([
                'starting_level_id' => 'The starting level must be less than or equal to the offered level.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.programmes.programme-manager', [
            'departments' =>  Department::cachedList(),
            'levels' => Level::cachedList(),

        ]);
    }
}
