<?php

use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('LevelManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create(['email' => 'admin@example.com']);

        Permission::findOrCreate('view levels');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view levels');

        $this->actingAs($user);
    });

    it('renders the level manager component successfully', function () {
        $this->get('/admin/levels')
            ->assertSee('Add New Level')
            ->assertSee('Existing Levels');
    });

    it('can create a new level', function () {
        Livewire::test('admin.levels.level-manager')
            ->set('fheq_level', 8)
            ->set('name', 'Level 8')
            ->set('description', 'Doctoral Degree')
            ->call('create');

        expect(Level::where('fheq_level', 8)->exists())->toBeTrue();
    });

    it('can update an existing level', function () {
        $level = Level::factory()->create(['fheq_level' => 9, 'name' => 'Old Level']);

        Livewire::test('admin.levels.level-manager')
            ->call('edit', $level->id)
            ->set('fheq_level', 9)
            ->set('name', 'Updated Level')
            ->set('description', 'Updated Description')
            ->call('update');

        expect(Level::find($level->id)->name)->toBe('Updated Level');
    });

    it('can delete a level', function () {
        $level = Level::factory()->create();

        Livewire::test('admin.levels.level-manager')
            ->call('delete', $level->id);

        expect(Level::find($level->id))->toBeNull();
    });
});
