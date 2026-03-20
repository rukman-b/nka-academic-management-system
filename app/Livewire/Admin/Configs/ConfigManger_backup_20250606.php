<?php

//This version has duration, delivery_type, experienc_type included. But has been removed for the time being as they are external to my project expectation.


namespace App\Livewire\Admin\Configs;

use App\Models\Config;
use App\Models\Programme;
use App\Models\DeliveryType;
use App\Models\ExperienceType;
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
    public $delivery_type_id;
    public $experience_type_id;
    public $name;
    public $description;
    public $duration;
    public $delivery_method;
    public $language;
    public $pass_marks;
    public $status = true;

    // Reactive update trigger
    public $refreshKey = 0;


    public function mount(): void
    {
        $this->resetForm();
    }

    public function updated($property): void
    {
        if (in_array($property, ['programme_id', 'delivery_type_id', 'experience_type_id'])) {
            $this->generateName();
        }
    }

    public function generateName(): void
    {
        $programme = Programme::find($this->programme_id);
        $delivery  = DeliveryType::find($this->delivery_type_id);
        $experience = ExperienceType::find($this->experience_type_id);

        if ($programme && $delivery && $experience) {
            $year = now()->format('y');
            $this->name = strtoupper(
                $programme->short_name . '_' .
                $delivery->code . '_' .
                $experience->code . '_' .
                $year
            );
        }
    }

    public function save(): void
    {
        $rules = [
            'programme_id'       => ['required', 'exists:programmes,id'],
            'delivery_type_id'   => ['required', 'exists:delivery_types,id'],
            'experience_type_id' => ['required', 'exists:experience_types,id'],
            'name'               => ['required', 'string', 'max:255', Rule::unique('configs', 'name')->ignore(optional($this->editing)->id)],
            'description'        => ['nullable', 'string'],
            'duration'           => ['required', 'string'],
            'delivery_method'    => ['required', 'string'],
            'language'           => ['required', 'string'],
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
        $this->delivery_type_id   = $config->delivery_type_id;
        $this->experience_type_id = $config->experience_type_id;
        $this->name               = $config->name;
        $this->description        = $config->description;
        $this->duration           = $config->duration;
        $this->delivery_method    = $config->delivery_method;
        $this->language           = $config->language;
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
        $this->delivery_type_id   = '';
        $this->experience_type_id = '';
        $this->name               = '';
        $this->description        = '';
        $this->duration           = '';
        $this->delivery_method    = '';
        $this->language           = '';
        $this->pass_marks         = '';
        $this->status             = true;
        $this->resetValidation();
    }

    protected function formData(): array
    {
        return [
            'programme_id'       => $this->programme_id,
            'delivery_type_id'   => $this->delivery_type_id,
            'experience_type_id' => $this->experience_type_id,
            'name'               => $this->name,
            'description'        => $this->description,
            'duration'           => $this->duration,
            'delivery_method'    => $this->delivery_method,
            'language'           => $this->language,
            'pass_marks'         => $this->pass_marks,
            'status'             => $this->status,
        ];
    }

    public function render()
    {
        return view('livewire.admin.configs.config-manager', [
            'configs'          => Config::with('programme')->latest()->get(),
            'programmes'       => Programme::orderBy('name')->get(),
            'deliveryTypes'    => DeliveryType::where('status', true)->get(),
            'experienceTypes'  => ExperienceType::where('status', true)->get(),
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
