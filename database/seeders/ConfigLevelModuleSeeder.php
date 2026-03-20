<?php

namespace Database\Seeders;


use App\Models\ConfigLevelModule;
use App\Models\Config;
use App\Models\Level;
use App\Models\Module;
use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class ConfigLevelModuleSeeder extends Seeder
{
    public function run(): void
    {
        $configs    = Config::all();
        $levels     = Level::all();
        $modules    = Module::all();
        $lecturers  = Lecturer::all();
        $combinations = [];

        $createdCount = 0;

        // 🔁 Create 20 unique config-level-module rows
        while ($createdCount < 20) {
            $config = $configs->random();
            $level = $levels->random();
            $module = $modules->random();
            $key = $config->id . '-' . $level->id . '-' . $module->id;

            if (in_array($key, $combinations)) {
                continue;
            }

            $combinations[] = $key;

            ConfigLevelModule::create([
                'config_id'    => $config->id,
                'level_id'     => $level->id,
                'module_id'    => $module->id,
                'lecturer_id'  => optional($lecturers->random())->id,
                // ✅ Force the first record to be optional
                'is_optional'  => $createdCount === 0 ? true : fake()->boolean(30),
                'start_date'   => fake()->dateTimeBetween('-1 month', '+1 week')->format('Y-m-d'),
                'end_date'     => fake()->dateTimeBetween('+2 weeks', '+3 months')->format('Y-m-d'),
            ]);

            $createdCount++;
        }

        // Ensure one record has is_optional = 1 (true)
        ConfigLevelModule::where('is_optional', '!=', 1)->inRandomOrder()->first()?->update(['is_optional' => 1]);

    }
}
