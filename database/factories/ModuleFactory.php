<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    protected $model = \App\Models\Module::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'global_level_id' => null, // or optionally: Level::factory()
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}