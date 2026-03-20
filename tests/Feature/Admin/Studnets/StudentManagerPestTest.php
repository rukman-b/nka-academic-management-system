<?php

use App\Livewire\Admin\Students\StudentManager;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, actingAs, assertDatabaseHas, assertDatabaseMissing};

// Enable automatic database refresh between tests
uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed Spatie roles/permissions
    $this->seed(\Database\Seeders\SpatieSeeder::class);

    // Create superadmin user and login
    $superadmin = \App\Models\User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'superadmin@nka.local',
        'password' => bcrypt('password'),
    ]);
    $superadmin->assignRole('superadmin');
    actingAs($superadmin);

    // Programme, config, and batch
    $this->programme = \App\Models\Programme::factory()->create(['name' => 'Test Programme']);
    $this->config = \App\Models\Config::factory()->create([
        'programme_id' => $this->programme->id,
        'name' => 'Test Config',
        'duration' => 1,
        'delivery_method' => 'Blended',
        'language' => 'English',
        'pass_marks' => 50,
        'programme_type' => 'Diploma',
    ]);
    $this->batch = \App\Models\Batch::factory()->create([
        'programme_id' => $this->programme->id,
        'config_id' => $this->config->id,
        'code' => 'TEST-BATCH-001',
    ]);
});

it('renders the student manager component page', function () {
    get('/admin/students')
        ->assertOk()
        ->assertSee('Student List');
});

it('creates a new student successfully', function () {
    Livewire::test(StudentManager::class)
        ->set('name', 'John Doe')
        ->set('email', 'john.doe@example.com')
        ->set('phone', '0711234567')
        ->set('dob', '2000-12-31')
        ->set('programme_id', $this->programme->id)
        ->set('batch_id', $this->batch->id)
        ->set('password', 'secret123')
        ->set('password_confirmation', 'secret123')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('students', [
        'email' => 'john.doe@example.com',
        'name' => 'John Doe',
        'programme_id' => $this->programme->id,
        'batch_id' => $this->batch->id,
    ]);
});

it('updates an existing student', function () {
    $student = Student::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
        'programme_id' => $this->programme->id,
        'batch_id' => $this->batch->id,
    ]);

    Livewire::test(StudentManager::class)
        ->call('edit', $student->id)
        ->set('name', 'Updated Name')
        ->set('password', '')
        ->set('password_confirmation', '')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('students', [
        'id' => $student->id,
        'name' => 'Updated Name',
    ]);
});

it('deletes a student successfully', function () {
    $student = Student::factory()->create([
        'programme_id' => $this->programme->id,
        'batch_id' => $this->batch->id,
    ]);

    Livewire::test(StudentManager::class)
        ->call('delete', $student->id)
        ->assertHasNoErrors();

    assertDatabaseMissing('students', [
        'id' => $student->id,
    ]);
});

it('shows validation error if password confirmation mismatches', function () {
    Livewire::test(StudentManager::class)
        ->set('name', 'Alice')
        ->set('email', 'alice@example.com')
        ->set('programme_id', $this->programme->id)
        ->set('password', 'secret123')
        ->set('password_confirmation', 'wrongpass')
        ->call('save')
        ->assertHasErrors(['password' => 'confirmed']);
});
