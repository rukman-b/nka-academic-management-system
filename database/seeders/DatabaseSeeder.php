<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {


        // Automatically run 'all' group in testing environment
    if (app()->environment('testing')) 
    {
        $this->call([
            SpatieSeeder::class,
            StakeholderSeeder::class,
        ]);
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
            'all' => $this->call([
                SpatieSeeder::class,
                StakeholderSeeder::class,
            ]),
            default => $this->command->info('No seeders were run.'),
        };
    }

}
