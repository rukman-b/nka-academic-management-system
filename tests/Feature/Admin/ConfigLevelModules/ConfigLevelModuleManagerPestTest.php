<?php

use App\Livewire\Admin\ConfigLevelModules\ConfigLevelModuleManager;
use App\Models\Config;
use App\Models\Level;
use App\Models\Module;
use App\Models\Lecturer;
use App\Models\ConfigLevelModule;
use Livewire\Livewire;

beforeEach(function () {
    $this->artisan('migrate:fresh --seed');

    $this->config = Config::first() ?? Config::factory()->create();
    $this->level = Level::first() ?? Level::factory()->create();
    $this->module1 = Module::factory()->create();
    $this->module2 = Module::factory()->create();
    $this->lecturer1 = Lecturer::first() ?? Lecturer::factory()->create();
    $this->lecturer2 = Lecturer::factory()->create();
});

it('renders the config-level-module manager component', function () {
    Livewire::test(ConfigLevelModuleManager::class)
        ->assertStatus(200);
});

it('creates a new config-level-module record', function () {
    Livewire::test(ConfigLevelModuleManager::class)
        ->set('config_id', $this->config->id)
        ->set('level_id', $this->level->id)
        ->set('module_id', $this->module1->id)
        ->set('lecturer_id', $this->lecturer1->id)
        ->set('is_optional', true)
        ->set('start_date', '2025-06-01')
        ->set('end_date', '2025-07-01')
        ->call('create');

    $record = ConfigLevelModule::where([
        'config_id' => $this->config->id,
        'level_id' => $this->level->id,
        'module_id' => $this->module1->id,
    ])->first();

    expect($record)->not->toBeNull();
    expect($record->is_optional)->toEqual(1);
});

it('updates an existing config-level-module record', function () {
    $record = ConfigLevelModule::factory()->create([
        'config_id' => $this->config->id,
        'level_id' => $this->level->id,
        'module_id' => $this->module2->id,
        'lecturer_id' => $this->lecturer1->id,
        'is_optional' => false,
        'start_date' => '2025-06-01',
        'end_date' => '2025-07-01',
    ]);

    Livewire::test(ConfigLevelModuleManager::class)
        ->call('edit', $record->id)
        ->set('lecturer_id', $this->lecturer2->id)
        ->set('is_optional', true)
        ->call('update');

    $record->refresh();

    expect($record->lecturer_id)->toBe($this->lecturer2->id);
    expect($record->is_optional)->toEqual(1);;
});

it('deletes a config-level-module record', function () {
    $record = ConfigLevelModule::factory()->create([
        'config_id' => $this->config->id,
        'level_id' => $this->level->id,
        'module_id' => $this->module2->id,
    ]);

    Livewire::test(ConfigLevelModuleManager::class)
        ->call('delete', $record->id);

    expect(ConfigLevelModule::find($record->id))->toBeNull();
});

it('validates required fields on create', function () {
    Livewire::test(ConfigLevelModuleManager::class)
        ->call('create')
        ->assertHasErrors([
            'config_id',
            'level_id',
            'module_id',
            'start_date',
            'end_date',
        ]);
});
