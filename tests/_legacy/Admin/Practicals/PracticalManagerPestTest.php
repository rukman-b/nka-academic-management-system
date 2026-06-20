<?php

use App\Models\Module;
use App\Models\Practical;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('PracticalManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create();

        Permission::findOrCreate('view practicals');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view practicals');

        $this->actingAs($user);
    });

    it('renders the component successfully', function () {
        $this->get('/admin/practicals')
            ->assertSee('Add New Practical')
            ->assertSee('Existing Practicals');
    });

    it('can create a new practical', function () {
        $module = Module::factory()->create();

        Livewire::test('admin.practicals.practical-manager')
            ->set('module_id', $module->id)
            ->set('title', 'Practical Lab A')
            ->set('description', 'Basic hardware setup')
            ->call('create');

        expect(Practical::where('title', 'Practical Lab A')->exists())->toBeTrue();
    });

    it('can update an existing practical', function () {
        $practical = Practical::factory()->create();

        Livewire::test('admin.practicals.practical-manager')
            ->call('edit', $practical->id)
            ->set('title', 'Updated Lab Title')
            ->call('update');

        expect(Practical::find($practical->id)->title)->toBe('Updated Lab Title');
    });

    it('can delete a practical', function () {
        $practical = Practical::factory()->create();

        Livewire::test('admin.practicals.practical-manager')
            ->call('delete', $practical->id);

        expect(Practical::find($practical->id))->toBeNull();
    });
});
