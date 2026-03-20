<?php

use App\Models\Programme;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('ProgrammeManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create(['email' => 'admin@example.com']);

        Permission::findOrCreate('view programmes');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view programmes');

        $this->actingAs($user);
    });

    it('renders the component successfully', function () {
        $this->get('/admin/programmes')
            ->assertSee('Add New Programme')
            ->assertSee('Existing Programmes');
    });

    it('can create a new programme', function () {
        $dept = Department::factory()->create();

        Livewire::test('admin.programmes.programme-manager')
            ->set('name', 'BSc Software Engineering')
            ->set('department_id', $dept->id)
            ->call('create');

        expect(Programme::where('name', 'BSc Software Engineering')->exists())->toBeTrue();
    });

    it('can update an existing programme', function () {
        $dept = Department::factory()->create();
        $programme = Programme::factory()->create();

        Livewire::test('admin.programmes.programme-manager')
            ->call('edit', $programme->id)
            ->set('name', 'Updated Name')
            ->set('department_id', $dept->id)
            ->call('update');

        expect(Programme::find($programme->id)->name)->toBe('Updated Name');
    });

    it('can delete a programme', function () {
        $programme = Programme::factory()->create();

        Livewire::test('admin.programmes.programme-manager')
            ->call('delete', $programme->id);

        expect(Programme::find($programme->id))->toBeNull();
    });

    it('programme belongs to a department', function () {
        $department = Department::factory()->create();
        $programme = Programme::factory()->create(['department_id' => $department->id]);

        expect($programme->department)->not->toBeNull();
        expect($programme->department->id)->toBe($department->id);
    });
});
