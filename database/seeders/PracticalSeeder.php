<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PracticalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('practicals')->insert([
            ['module_id' => 1, 'title' => 'Python Lab 1', 'description' => 'Hands-on programming basics'],
            ['module_id' => 2, 'title' => 'UI Wireframe Sketch', 'description' => 'Design a basic user interface'],
        ]);
    }
}