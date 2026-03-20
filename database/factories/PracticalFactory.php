<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Practical>
 */
class PracticalFactory extends Factory
{
    protected $model = \App\Models\Practical::class;

    public function definition(): array
    {
        return [
            'module_id' => \App\Models\Module::factory(),
            'title' => 'Practical: ' . $this->faker->words(2, true),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
