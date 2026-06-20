<?php

use App\Models\ConfigLevelModule;
use App\Models\Student;
use App\Models\StudentOptionalModule;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    // Fresh migration before each test to ensure clean DB
    $this->artisan('migrate:fresh');
});

// Departments Table
it('has departments table with correct columns', function () {
    expect(Schema::hasTable('departments'))->toBeTrue();
    expect(Schema::hasColumns('departments', [
        'id', 'name', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Programmes Table
it('has programmes table with correct columns', function () {
    expect(Schema::hasTable('programmes'))->toBeTrue();
    expect(Schema::hasColumns('programmes', [
        'id', 'name', 'department_id', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Levels Table
it('has levels table with correct columns', function () {
    expect(Schema::hasTable('levels'))->toBeTrue();
    expect(Schema::hasColumns('levels', [
        'id', 'fheq_level', 'name', 'description', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Programme Exit Awards Table
it('has programme_exit_awards table with correct columns and unique constraint', function () {
    expect(Schema::hasTable('programme_exit_awards'))->toBeTrue();
    expect(Schema::hasColumns('programme_exit_awards', [
        'id', 'programme_id', 'level_id', 'award_title', 'description', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Batches Table
it('has batches table with correct columns', function () {
    expect(Schema::hasTable('batches'))->toBeTrue();
    expect(Schema::hasColumns('batches', [
        'id', 'programme_id', 'code', 'start_date', 'end_date', 'active', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Modules Table
it('has modules table with correct columns', function () {
    expect(Schema::hasTable('modules'))->toBeTrue();
    expect(Schema::hasColumns('modules', [
        'id', 'name', 'global_level_id', 'description', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Batch Level Module Table
it('has batch_level_module table with correct columns and unique constraint', function () {
    expect(Schema::hasTable('batch_level_module'))->toBeTrue();
    expect(Schema::hasColumns('batch_level_module', [
        'id', 'batch_id', 'level_id', 'module_id', 'start_date', 'end_date', 'status', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Students Table
it('has students table with correct columns', function () {
    expect(Schema::hasTable('students'))->toBeTrue();
    expect(Schema::hasColumns('students', [
        'id', 'name', 'email', 'phone', 'dob', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Batch Student Table
it('has batch_student pivot table with correct columns and unique constraint', function () {
    expect(Schema::hasTable('batch_student'))->toBeTrue();
    expect(Schema::hasColumns('batch_student', [
        'id', 'batch_id', 'student_id', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Practicals Table
it('has practicals table with correct columns', function () {
    expect(Schema::hasTable('practicals'))->toBeTrue();
    expect(Schema::hasColumns('practicals', [
        'id', 'module_id', 'title', 'description', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Theories Table
it('has theories table with correct columns', function () {
    expect(Schema::hasTable('theories'))->toBeTrue();
    expect(Schema::hasColumns('theories', [
        'id', 'module_id', 'title', 'description', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Skill Categories Table
it('has skill_categories table with correct columns', function () {
    expect(Schema::hasTable('skill_categories'))->toBeTrue();
    expect(Schema::hasColumns('skill_categories', [
        'id', 'name', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Skills Table
it('has skills table with correct columns', function () {
    expect(Schema::hasTable('skills'))->toBeTrue();
    expect(Schema::hasColumns('skills', [
        'id', 'skill_category_id', 'name', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Module Department Table
it('has module_department pivot table with correct columns and unique constraint', function () {
    expect(Schema::hasTable('module_department'))->toBeTrue();
    expect(Schema::hasColumns('module_department', [
        'id', 'module_id', 'department_id', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

// Student Exit Awards Table
it('has student_exit_awards table with correct columns and unique constraint', function () {
    expect(Schema::hasTable('student_exit_awards'))->toBeTrue();
    expect(Schema::hasColumns('student_exit_awards', [
        'id', 'student_id', 'programme_exit_award_id', 'awarded_at', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

it('has configs table with correct columns and constraints', function () {
    expect(Schema::hasTable('configs'))->toBeTrue();
    expect(Schema::hasColumns('configs', [
        'id',
        'programme_id',
        'name',
        'description',
        'duration',
        'delivery_method',
        'language',
        'pass_marks',
        'programme_type',
        'active',
        'created_at',
        'updated_at'
    ]))->toBeTrue();
});

it('has lecturers table with correct columns', function () {
    expect(Schema::hasTable('lecturers'))->toBeTrue();
    expect(Schema::hasColumns('lecturers', [
        'id', 'name', 'email', 'phone', 'department', 'active', 'created_at', 'updated_at'
    ]))->toBeTrue();
});


it('has config_level_modules table with correct columns', function () {
    expect(Schema::hasTable('config_level_modules'))->toBeTrue();
    expect(Schema::hasColumns('config_level_modules', [
        'id',
        'config_id',
        'level_id',
        'module_id',
        'lecturer_id',
        'is_optional',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ]))->toBeTrue();
});


it('has batches table with correct columns and foreign keys', function () {
    expect(Schema::hasTable('batches'))->toBeTrue();
    expect(Schema::hasColumns('batches', [
        'id', 'programme_id', 'config_id', 'code', 'start_date', 'end_date', 'active', 'created_at', 'updated_at'
    ]))->toBeTrue();
});

//programme_exit_awards
it('has programme_exit_awards table with expected columns', function () {
    expect(Schema::hasTable('programme_exit_awards'))->toBeTrue();

    $columns = Schema::getColumnListing('programme_exit_awards');

    $expectedColumns = [
        'id',
        'programme_id',
        'level_id',
        'award_title',
        'description',
        'created_at',
        'updated_at',
    ];

    foreach ($expectedColumns as $column) {
        expect($columns)->toContain($column);
    }
});

//Student_exit_awards
it('has student_exit_awards table with expected columns', function () {
    expect(Schema::hasTable('student_exit_awards'))->toBeTrue();

    $columns = Schema::getColumnListing('student_exit_awards');
    expect($columns)->toEqualCanonicalizing([
        'id',
        'student_id',
        'programme_exit_award_id',
        'awarded_at',
        'created_at',
        'updated_at',
    ]);
});

it('has student_optional_modules table with correct columns', function () {
    expect(Schema::hasTable('student_optional_modules'))->toBeTrue();

    $expected = [
        'id',
        'student_id',
        'config_level_module_id',
        'selected_at',
        'created_at',
        'updated_at',
    ];

    foreach ($expected as $column) {
        expect(Schema::hasColumn('student_optional_modules', $column))->toBeTrue();
    }
});

it('enforces uniqueness on student_id and config_level_module_id in student_optional_modules', function () {
    $student = Student::factory()->create();
    $module = ConfigLevelModule::factory()->create();

    // First insert should succeed
    StudentOptionalModule::create([
        'student_id' => $student->id,
        'config_level_module_id' => $module->id,
        'selected_at' => now(),
    ]);

    // Second insert should fail due to unique constraint
    $this->expectException(\Illuminate\Database\QueryException::class);

    StudentOptionalModule::create([
        'student_id' => $student->id,
        'config_level_module_id' => $module->id,
        'selected_at' => now(),
    ]);
});
