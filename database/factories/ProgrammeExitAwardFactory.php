<?php

namespace Database\Factories;

use App\Models\Programme;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgrammeExitAwardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'programme_id' => Programme::factory(), // Ensure a valid programme
            'level_id' => Level::factory(),         // Ensure a valid level
            'award_title' => $this->faker->randomElement([
                'CertHE', 'DipHE', 'BSc (Hons)', 'Foundation Certificate', 'Postgraduate Certificate'
            ]),
            'description' => $this->faker->sentence(),
        ];
    }
}
