<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    protected $model = \App\Models\Level::class;

    public function definition(): array
    {
        return [
            'fheq_level' => $this->faker->unique()->numberBetween(4, 8),
            'name' => 'Level ' . $this->faker->unique()->numberBetween(4, 8),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
