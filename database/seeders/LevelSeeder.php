<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('levels')->insert([
            ['fheq_level' => 4, 'name' => 'Level 4', 'description' => 'Certificate of Higher Education'],
            ['fheq_level' => 5, 'name' => 'Level 5', 'description' => 'Diploma of Higher Education'],
            ['fheq_level' => 6, 'name' => 'Level 6', 'description' => 'Bachelor’s Degree'],
            ['fheq_level' => 7, 'name' => 'Level 7', 'description' => 'Master’s Degree'],
        ]);
    }
}