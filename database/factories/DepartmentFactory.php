<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = \App\Models\Department::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word() . ' Department',
        ];
    }
}