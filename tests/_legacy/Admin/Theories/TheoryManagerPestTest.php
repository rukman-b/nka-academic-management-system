<?php

use App\Models\Module;
use App\Models\Theory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('TheoryManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create();

        Permission::findOrCreate('view theories');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view theories');

        $this->actingAs($user);
    });

    it('renders the component successfully', function () {
        $this->get('/admin/theories')
            ->assertSee('Add New Theory')
            ->assertSee('Existing Theories');
    });

    it('can create a new theory', function () {
        $module = Module::factory()->create();

        Livewire::test('admin.theories.theory-manager')
            ->set('module_id', $module->id)
            ->set('title', 'Theory 1')
            ->set('description', 'Intro to fundamentals')
            ->call('create');

        expect(Theory::where('title', 'Theory 1')->exists())->toBeTrue();
    });

    it('can update an existing theory', function () {
        $theory = Theory::factory()->create();

        Livewire::test('admin.theories.theory-manager')
            ->call('edit', $theory->id)
            ->set('title', 'Updated Theory')
            ->call('update');

        expect(Theory::find($theory->id)->title)->toBe('Updated Theory');
    });

    it('can delete a theory', function () {
        $theory = Theory::factory()->create();

        Livewire::test('admin.theories.theory-manager')
            ->call('delete', $theory->id);

        expect(Theory::find($theory->id))->toBeNull();
    });
});
