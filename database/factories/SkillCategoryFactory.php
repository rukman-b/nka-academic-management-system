<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillCategory>
 */
class SkillCategoryFactory extends Factory
{
    protected $model = \App\Models\SkillCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word() . ' Skills',
        ];
    }
}
