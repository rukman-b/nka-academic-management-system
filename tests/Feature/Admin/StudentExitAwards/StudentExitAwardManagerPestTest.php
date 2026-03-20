<?php

use App\Models\Student;
use App\Models\ProgrammeExitAward;
use App\Livewire\Admin\StudentExitAwards\StudentExitAwardManager;
use function Pest\Laravel\{actingAs, get, assertDatabaseHas};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(\Database\Seeders\SpatieSeeder::class);

    $admin = \App\Models\User::factory()->create()->assignRole('superadmin');
    actingAs($admin);

    $this->student = Student::factory()->create();
    $this->award = ProgrammeExitAward::factory()->create();
});

it('renders the student exit award manager page', function () {
    get('/admin/student-exit-awards')
        ->assertOk()
        ->assertSee('Assigned Exit Awards');
});

it('creates a student exit award record', function () {
    Livewire::test(StudentExitAwardManager::class)
        ->set('student_id', $this->student->id)
        ->set('programme_exit_award_id', $this->award->id)
        ->set('awarded_at', '2024-12-01')
        ->call('save')
        ->assertSee('Student Exit Award saved successfully.');

    assertDatabaseHas('student_exit_awards', [
        'student_id' => $this->student->id,
        'programme_exit_award_id' => $this->award->id,
    ]);
});
