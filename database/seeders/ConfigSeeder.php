<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure related programmes exist first
        if (\App\Models\Programme::count() === 0) {
            $this->call(\Database\Seeders\ProgrammeSeeder::class);
        }

        Config::factory()->count(10)->create();
    }
}
