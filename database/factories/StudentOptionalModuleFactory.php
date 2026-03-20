<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ConfigLevelModule;
use App\Models\StudentOptionalModule;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentOptionalModuleFactory extends Factory
{
    protected $model = StudentOptionalModule::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'config_level_module_id' => ConfigLevelModule::factory(),
            'selected_at' => now(),
        ];
    }
}
