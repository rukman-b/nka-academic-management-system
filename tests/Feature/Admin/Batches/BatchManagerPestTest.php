<?php

use App\Livewire\Admin\Batches\BatchManager;
use App\Models\Batch;
use App\Models\Config;
use App\Models\Programme;
use Livewire\Livewire;

beforeEach(function () {
    $this->artisan('migrate:fresh --seed');

    $this->programme = Programme::first() ?? Programme::factory()->create();
    $this->config = Config::first() ?? Config::factory()->create([
        'programme_id' => $this->programme->id,
    ]);
});

it('renders the batch manager component', function () {
    Livewire::test(BatchManager::class)
        ->assertStatus(200);
});

it('creates a new batch', function () {
    Livewire::test(BatchManager::class)
        ->set('programme_id', $this->programme->id)
        ->set('config_id', $this->config->id)
        ->set('code', 'B-2025-001')
        ->set('start_date', now()->toDateString())
        ->set('end_date', now()->addMonths(6)->toDateString())
        ->set('active', true)
        ->call('create');

    expect(Batch::where('code', 'B-2025-001')->exists())->toBeTrue();
});

it('updates an existing batch', function () {
    $batch = Batch::factory()->create([
        'programme_id' => $this->programme->id,
        'config_id' => $this->config->id,
        'code' => 'B-2025-897',
    ]);

    Livewire::test(BatchManager::class)
        ->call('edit', $batch->id)
        ->set('code', 'B-2025-UPDATED-01')
        ->call('update');

    $batch->refresh();
    expect($batch->code)->toBe('B-2025-UPDATED-01');
});

it('deletes a batch', function () {
    $batch = Batch::factory()->create([
        'programme_id' => $this->programme->id,
        'config_id' => $this->config->id,
    ]);

    Livewire::test(BatchManager::class)
        ->call('delete', $batch->id);

    expect(Batch::find($batch->id))->toBeNull();
});

it('validates required fields', function () {
    Livewire::test(BatchManager::class)
        ->call('create')
        ->assertHasErrors([
            'programme_id',
            'config_id',
            'code',
        ]);
});
