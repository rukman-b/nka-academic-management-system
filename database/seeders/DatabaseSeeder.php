<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Automatically seed the default dataset during tests.
        if (app()->environment('testing')) {
            $this->call($this->defaultSeeders());

            return;
        }

        $options = [
            'spatie' => 'SpatieSeeder (Roles & Permissions)',
            'stakeholder' => 'StakeholderSeeder (Users & Students)',
            'all' => 'Run ALL seeders',
            'none' => 'Exit without seeding',
        ];

        $choice = $this->command->choice(
            'Which seeder group would you like to run?',
            $options,
            'none'
        );

        match ($choice) {
            'spatie' => $this->call([SpatieSeeder::class]),
            'stakeholder' => $this->call([StakeholderSeeder::class]),
            'all' => $this->call($this->defaultSeeders()),
            default => $this->command->info('No seeders were run.'),
        };
    }

    /**
     * Seeders included in the default/demo dataset.
     */
    private function defaultSeeders(): array
    {
        return [
            SpatieSeeder::class,
            StakeholderSeeder::class,
        ];
    }
}