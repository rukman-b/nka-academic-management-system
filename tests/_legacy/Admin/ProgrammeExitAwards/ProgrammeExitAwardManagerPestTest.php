<?php

use App\Livewire\Admin\ProgrammeExitAwards\ProgrammeExitAwardManager;
use App\Models\ProgrammeExitAward;
use App\Models\Programme;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, actingAs};
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed roles & permissions
    $this->seed(\Database\Seeders\SpatieSeeder::class);

    // Login as superadmin
    $user = \App\Models\User::factory()->create(['email' => 'superadmin@nka.local']);
    $user->assignRole('superadmin');
    actingAs($user);

    // Create dependencies
    $this->programme = Programme::factory()->create(['name' => 'BSc Computer Science']);
    $this->level = Level::factory()->create(['fheq_level' => 5, 'name' => 'Level 5']);
});

it('renders the programme exit award manager page', function () {
    get('/admin/programme-exit-awards')
        ->assertOk()
        ->assertSee('Programme Exit Awards');
});

it('creates a new programme exit award record', function () {
    Livewire::test(ProgrammeExitAwardManager::class)
        ->set('programme_id', $this->programme->id)
        ->set('level_id', $this->level->id)
        ->set('award_title', 'DipHE')
        ->set('description', 'Diploma of Higher Education')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSee('Programme Exit Award saved successfully.');

    expect(ProgrammeExitAward::where('programme_id', $this->programme->id)->where('level_id', $this->level->id)->exists())->toBeTrue();
});
