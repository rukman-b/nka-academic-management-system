<?php

use App\Models\Module;
use App\Models\Level;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('ModuleManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create(['email' => 'admin@example.com']);

        Permission::findOrCreate('view modules');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view modules');

        $this->actingAs($user);
    });

    it('renders the module manager component successfully', function () {
        $this->get('/admin/modules')
            ->assertSee('Add New Module')
            ->assertSee('Existing Modules');
    });

    it('can create a new module', function () {
        $level = Level::factory()->create();
        $departments = Department::factory()->count(2)->create();

        Livewire::test('admin.modules.module-manager')
            ->set('name', 'Advanced Programming')
            ->set('global_level_id', $level->id)
            ->set('description', 'Covers OOP and design patterns')
            ->set('department_ids', $departments->pluck('id')->toArray())
            ->call('create');

        expect(Module::where('name', 'Advanced Programming')->exists())->toBeTrue();
    });

    it('can update an existing module', function () {
        $module = Module::factory()->create();
        $departments = Department::factory()->count(1)->create();

        Livewire::test('admin.modules.module-manager')
            ->call('edit', $module->id)
            ->set('name', 'Updated Module')
            ->set('global_level_id', '')
            ->set('department_ids', $departments->pluck('id')->toArray())
            ->call('update');

        expect(Module::find($module->id)->name)->toBe('Updated Module');
    });

    it('can delete a module', function () {
        $module = Module::factory()->create();

        Livewire::test('admin.modules.module-manager')
            ->call('delete', $module->id);

        expect(Module::find($module->id))->toBeNull();
    });
});
