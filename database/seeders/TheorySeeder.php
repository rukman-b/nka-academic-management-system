<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TheorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('theories')->insert([
            ['module_id' => 1, 'title' => 'Control Structures', 'description' => 'Loops, conditions, and logic'],
            ['module_id' => 3, 'title' => 'UK Constitution Principles', 'description' => 'Foundations of public law'],
        ]);
    }
}