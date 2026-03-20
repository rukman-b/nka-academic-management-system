<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Programme;
use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition(): array
    {
        return [
            'programme_id' => Programme::inRandomOrder()->first()?->id ?? Programme::factory(),
            'config_id' => Config::inRandomOrder()->first()?->id ?? Config::factory(),
            'code' => 'B-' . fake()->unique()->numerify('2025-###'),
            'start_date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
            'active' => fake()->boolean(80),
        ];
    }
}
