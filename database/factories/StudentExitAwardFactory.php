<?php

namespace Database\Factories;

use App\Models\StudentExitAward;
use App\Models\Student;
use App\Models\ProgrammeExitAward;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentExitAwardFactory extends Factory
{
    protected $model = StudentExitAward::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'programme_exit_award_id' => ProgrammeExitAward::factory(),
            'awarded_at' => $this->faker->date(),
        ];
    }
}
