<?php

namespace Database\Factories;

use App\Models\Config;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigFactory extends Factory
{
    protected $model = Config::class;

    public function definition(): array
    {
        return [
            'programme_id'    => Programme::inRandomOrder()->first()?->id ?? Programme::factory(),
            'name'            => $this->faker->unique()->sentence(3),
            'description'     => $this->faker->optional()->paragraph(),
            'duration'        => $this->faker->randomElement(['1 Year', '18 Months', '2 Years']),
            'delivery_method' => $this->faker->randomElement(['Online', 'NKA premises', 'Hybrid']),
            'language'        => $this->faker->randomElement(['English', 'Sinhala', 'Tamil']),
            'pass_marks'      => $this->faker->randomElement([40, 50]),
            'programme_type'  => $this->faker->randomElement(['Full-time', 'Part-time']),
            'active'          => $this->faker->boolean(90),
        ];
    }
}
