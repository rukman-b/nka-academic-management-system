<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgrammeFactory extends Factory
{
    protected $model = \App\Models\Programme::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence(3),
            'department_id' => \App\Models\Department::factory(),
        ];
    }
}
