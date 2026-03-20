<?php

namespace App\Livewire\Admin\ConfigModuleAssignments;

use App\Models\Config;
use App\Models\Module;
use App\Models\ConfigModule;
use App\Models\Department;
use App\Models\Programme;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Validation\Rule;

class ConfigModuleManager extends Component
{
    public ?ConfigModule $editing = null;
    public ?int $config_id = null;
    public ?int $module_id = null;
    public bool $is_optional = false;
    public ?int $department_id = null;
    public $filteredConfigs = [];
    public ?int $programme_id = null;
    public $filteredProgrammes = [];

    // Reactive update trigger
    public $refreshKey = 0;


    public function mount(): void
    {
        $this->resetForm();
    }

    // public function updatedDepartmentId()
    // {
    //     // $this->filteredProgrammes = Programme::where('department_id',$this->department_id)->get();
    //     // $this->resetExcept('department_id');
    // }
    // public function create(): void
    // {
    //     $this->resetForm();
    // }

    public function edit(ConfigModule $configModule): void
    {
        $this->editing = $configModule;
        $this->config_id = $configModule->config_id;
        $this->module_id = $configModule->module_id;
        $this->is_optional = $configModule->is_optional;
    }

    public function save(): void
    {
        $this->validate([
            'config_id' => ['required', Rule::exists('configs', 'id')],
            'module_id' => ['required', Rule::exists('modules', 'id')],
            'is_optional' => ['boolean'],
        ]);

        ConfigModule::updateOrCreate(
            ['id' => optional($this->editing)->id],
            [
                'config_id' => $this->config_id,
                'module_id' => $this->module_id,
                'is_optional' => $this->is_optional,
            ]
        );

        $this->dispatch('toast', 'Config Module saved successfully.');
        $this->resetForm();
        $this->refreshKey ++;

    }

    public function delete(ConfigModule $configModule): void
    {
        $configModule->delete();
        $this->dispatch('toast', 'Config Module deleted.');
        $this->refreshKey ++;

    }

    public function resetForm(): void
    {
        $this->reset(['editing', 'config_id', 'module_id', 'is_optional']);
    }

    public function render()
    {
        //Do not remove
        // return view('livewire.admin.config-module-assignments.config-module-manager', [
        //     'configs' => Config::where('programme_id',$this->programme_id)->get(),
        //     'modules' => ($this->department_id && $this->config_id)
        //                 ? Module::with('departments')
        //                     ->whereHas('departments', fn($q) => $q->where('departments.id', $this->department_id))
        //                     ->whereNotIn('id', ConfigModule::where('config_id', $this->config_id)->pluck('module_id'))
        //                     ->orderBy('name')
        //                     ->get()
        //                 : collect(),

        //     'configModules' => ConfigModule::with(['config', 'module'])->orderByDesc('id')->get(),
        //     'departments' => Department::orderBy('name')->get(),
        //     'programmes' => Programme::where('department_id',$this->department_id)->get(),

        // ]);

        return view('livewire.admin.config-module-assignments.config-module-manager', [
            'configs' => Config::cachedByProgramme($this->programme_id),
            'modules' => ($this->department_id && $this->config_id)
                        ? Cache::tags(['module'])->remember(
                            "unassigned_modules_for_department_{$this->department_id}_config_{$this->config_id}",
                            config('nka.cacheTTL.long_term'),
                            function () {
                                return Module::with('departments')
                                    ->whereHas('departments', fn ($q) =>
                                        $q->where('departments.id', $this->department_id)
                                    )
                                    ->whereNotIn('id', ConfigModule::where('config_id', $this->config_id)->pluck('module_id'))
                                    ->orderBy('name')
                                    ->get();
                                        }
                                    )
                                    : collect(),

            'configModules' => ConfigModule::cachedWithRelations(),
            'departments' => Department::cachedList(),
            'programmes' => Programme::cachedByDepartment($this->department_id),

        ]);
    }
}
