<?php

use App\Livewire\Admin\Departments\DepartmentManager;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function sampleAddress(): array {
    // Adjust keys to match your InteractsWithAddress rules if needed
    return [
        'line1'       => '123 High Street',
        'line2'       => '',
        'city'        => 'Negombo',
        'state'       => 'Western',
        'postal_code' => '11500',
        'country'     => 'Sri Lanka',
    ];
}

it('creates a department with address', function () {
    Livewire::test(DepartmentManager::class)
        ->set('name', 'Computer Science')
        ->set('description', 'Computing programmes')
        ->set('address', sampleAddress())
        ->call('create')
        ->assertSessionHas('success', 'Department created successfully.');

    $dept = Department::where('name', 'Computer Science')->first();
    expect($dept)->not->toBeNull();
    expect($dept->address)->not->toBeNull(); // polymorphic address was created
});

it('validates name is required on create', function () {
    Livewire::test(DepartmentManager::class)
        ->set('name', '') // missing
        ->set('description', 'Desc')
        ->set('address', sampleAddress())
        ->call('create')
        ->assertHasErrors(['name' => 'required']);
});

it('updates a department and its address', function () {
    $dept = Department::factory()->create([
        'name' => 'Maths',
        'description' => 'Numbers dept',
    ]);
    // give it an address if your model requires it; otherwise update will create one
    $dept->address()->create(sampleAddress());

    // Load into edit mode, change values, and update
    Livewire::test(DepartmentManager::class)
        ->call('edit', $dept)
        ->set('name', 'Mathematics')
        ->set('description', 'Updated description')
        ->set('address.city', 'Colombo')
        ->call('update')
        ->assertSessionHas('success', 'Department updated successfully.');

    $dept->refresh();
    expect($dept->name)->toBe('Mathematics');
    expect($dept->description)->toBe('Updated description');
    expect(optional($dept->address)->city)->toBe('Colombo');
});

it('deletes a department', function () {
    $dept = Department::factory()->create();

    Livewire::test(DepartmentManager::class)
        ->call('delete', $dept);

    expect(Department::find($dept->id))->toBeNull();
});

it('enforces unique name on create', function () {
    Department::factory()->create(['name' => 'Physics']);

    Livewire::test(DepartmentManager::class)
        ->set('name', 'Physics') // duplicate
        ->set('description', 'Duplicate try')
        ->set('address', sampleAddress())
        ->call('create')
        ->assertHasErrors(['name' => 'unique']);
});
