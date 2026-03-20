<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    protected $model = \App\Models\Skill::class;

    public function definition(): array
    {
        return [
            'skill_category_id' => \App\Models\SkillCategory::factory(),
            'name' => $this->faker->unique()->words(2, true),
        ];
    }
}