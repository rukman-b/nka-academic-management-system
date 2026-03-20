<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theory>
 */
class TheoryFactory extends Factory
{
    protected $model = \App\Models\Theory::class;

    public function definition(): array
    {
        return [
            'module_id' => \App\Models\Module::factory(),
            'title' => 'Theory: ' . $this->faker->words(2, true),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
