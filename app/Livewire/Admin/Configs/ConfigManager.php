<?php

namespace App\Livewire\Admin\Configs;

use App\Models\Config;
use App\Models\Programme;
use Livewire\Component;
use Illuminate\Validation\Rule;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class ConfigManager extends Component 
{

    use HandlesDeleteExceptions;

    public $selectedConfig;

    public ?Config $editing = null;

    public $programme_id;
    public $code;
    public $description;
    public $pass_marks;
    public $status = true;

    // Reactive update trigger
    public $refreshKey = 0;


    public function mount(): void
    {
        $this->resetForm();
    }

    public function updatedProgrammeId($property): void
    {
        
            $this->generateName();
        
    }

    public function generateName(): void
    {
        $programme = Programme::find($this->programme_id);

        if ($programme) {
            $year  = now()->format('y');
            $next  = now()->addYear()->format('y');
            $base  = strtoupper($programme->short_name . '_' . $year . '_' . $next);

            // Optional suffix logic to ensure uniqueness
            $existingCount = Config::where('code', 'like', "{$base}%")->count();
            $suffix = $existingCount > 0 ? '_C' . ($existingCount + 1) : '_C1';

            $this->code = $base . $suffix;
        }
    }


    public function save(): void
    {
        $rules = [
            'programme_id'       => ['required', 'exists:programmes,id'],
            'code'               => ['required', 'string', 'max:255', Rule::unique('configs', 'code')->ignore(optional($this->editing)->id)],
            'description'        => ['nullable', 'string'],
            'pass_marks'         => ['required', 'integer', 'min:0', 'max:100'],
            'status'             => ['boolean'],
        ];

        $this->validate($rules);

        $data = $this->formData();

        if ($this->editing) {
            $this->editing->update($data);
            session()->flash('success', 'Configuration updated.');
        } else {
            Config::create($data);
            session()->flash('success', 'Configuration created.');
        }

        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Config $config): void
    {
        $this->editing            = $config;
        $this->programme_id       = $config->programme_id;
        $this->code               = $config->code;
        $this->description        = $config->description;
        $this->pass_marks         = $config->pass_marks;
        $this->status             = (bool) $config->status;
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    public function delete(Config $config): void
    {

       
         // $this->authorize('delete', $module);
       
         $this->safeDelete(
            fn() => $config->delete(),
            'Config deleted successfully.',
            'Cannot delete this config because it is referenced by other records.'
        );
        $this->refreshKey++;
        $this->resetForm();

        
    }

    protected function resetForm(): void
    {
        $this->editing            = null;
        $this->programme_id       = '';
        $this->code               = '';
        $this->description        = '';
        $this->pass_marks         = '';
        $this->status             = true;
        $this->resetValidation();
    }

    protected function formData(): array
    {
        return [
            'programme_id'       => $this->programme_id,
            'code'               => $this->code,
            'description'        => $this->description,
            'pass_marks'         => $this->pass_marks,
            'status'             => $this->status,
        ];
    }

    public function render()
    {
        return view('livewire.admin.configs.config-manager', [
            // 'configs'          => Config::with('programme')->latest()->get(),
            'programmes'       => Programme::cachedList(),
        ]);
    }

    public function loadConfig($id)
    {
        $this->selectedConfig = Config::with('programme')->findOrFail($id);
        $this->dispatch('show-config-modal');
    }

    // public function closeModal()
    // {
    //     $this->selectedConfig = null;
    // }
}
