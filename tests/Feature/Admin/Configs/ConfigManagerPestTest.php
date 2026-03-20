<?php

use App\Livewire\Admin\Configs\ConfigManager;
use App\Models\Config;
use App\Models\Programme;
use Livewire\Livewire;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->artisan('migrate:fresh --seed');
    $this->programme = Programme::first() ?? Programme::factory()->create();
});

it('displays the config manager component', function () {
    Livewire::test(ConfigManager::class)
        ->assertStatus(200);
});

it('creates a config with valid data', function () {
    Livewire::test(ConfigManager::class)
        ->set('programme_id', $this->programme->id)
        ->set('name', 'Test Config ' . Str::random(5))
        ->set('description', 'Some description')
        ->set('duration', '2 Years')
        ->set('delivery_method', 'Online')
        ->set('language', 'English')
        ->set('pass_marks', 40)
        ->set('programme_type', 'Full-time')
        ->set('active', true)
        ->call('save');

    expect(Config::where('name', 'like', 'Test Config%')->exists())->toBeTrue();
});

it('rejects config creation with missing fields', function () {
    Livewire::test(ConfigManager::class)
        ->set('name', '') // missing required fields
        ->set('programme_id', null)
        ->call('save')
        ->assertHasErrors(['programme_id', 'name', 'duration', 'delivery_method', 'language', 'pass_marks', 'programme_type']);
});

it('updates an existing config', function () {
    $config = Config::factory()->create(['programme_id' => $this->programme->id]);

    Livewire::test(ConfigManager::class)
        ->call('edit', $config->id)
        ->set('name', 'Updated Config Name')
        ->call('save');

    expect(Config::find($config->id)->name)->toBe('Updated Config Name');
});

it('deletes a config', function () {
    $config = Config::factory()->create(['programme_id' => $this->programme->id]);

    Livewire::test(ConfigManager::class)
        ->call('delete', $config->id);

    expect(Config::find($config->id))->toBeNull();
});
