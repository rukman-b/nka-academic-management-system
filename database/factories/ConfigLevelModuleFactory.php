<?php

namespace Database\Factories;

use App\Models\Config;
use App\Models\Level;
use App\Models\Module;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigLevelModuleFactory extends Factory
{
    // protected $model = \App\Models\ConfigLevelModule::class;

    public function definition(): array
    {
        // Fetch all combinations and filter out existing ones
        $existing = \App\Models\ConfigLevelModule::select('config_id', 'level_id', 'module_id')->get()->toArray();

        // Try up to 10 times to find a unique combination
        for ($i = 0; $i < 10; $i++) {
            $config = Config::inRandomOrder()->first() ?? Config::factory()->create();
            $level  = Level::inRandomOrder()->first() ?? Level::factory()->create();
            $module = Module::inRandomOrder()->first() ?? Module::factory()->create();

            $combination = [
                'config_id' => $config->id,
                'level_id' => $level->id,
                'module_id' => $module->id,
            ];

            if (!in_array($combination, $existing)) {
                $existing[] = $combination;

                return array_merge($combination, [
                    'lecturer_id' => Lecturer::inRandomOrder()->first()?->id,
                    'is_optional' => fake()->boolean(30),
                    'start_date'  => fake()->dateTimeBetween('-1 month', '+1 week')->format('Y-m-d'),
                    'end_date'    => fake()->dateTimeBetween('+2 weeks', '+3 months')->format('Y-m-d'),
                ]);
            }
        }

        // If all combinations are exhausted, return dummy unique (will not be used)
        return [
            'config_id' => 9999,
            'level_id' => 9999,
            'module_id' => 9999,
            'lecturer_id' => null,
            'is_optional' => false,
            'start_date' => null,
            'end_date' => null,
        ];
    }
}
