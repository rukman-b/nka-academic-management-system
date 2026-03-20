<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
            ProgrammeDetailsSeeder::class,
        ]);
        return;
    }


    
        $options = [
            'spatie' => 'SpatieSeeder (Roles & Permissions)',
            'stakeholder' => 'StakeholderSeeder (Users & Students)',
            'programme' => 'ProgrammeDetailsSeeder (Programmes, Levels, Skills, etc.)',
            'studentPortal' => 'StudentPortalSeeder(StudentOptionalModuleSeeder, etc.)',
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
            'programme' => $this->call([ProgrammeDetailsSeeder::class]),
            'studentPortal' => $this->call([StudentPortalSeeder::class]),
            'all' => $this->call([
                SpatieSeeder::class,
                StakeholderSeeder::class,
                ProgrammeDetailsSeeder::class,
                StudentPortalSeeder::class,
            ]),
            default => $this->command->info('No seeders were run.'),
        };
    }

}
