<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    protected $model = Lecturer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'department_id' => Department::inRandomOrder()->first()?->id ?? 1, // fallback to ID 1
            'active' => true,
        ];
    }
}
