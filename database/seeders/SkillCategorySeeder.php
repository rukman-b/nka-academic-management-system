<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('skill_categories')->insert([
            ['name' => 'Communication Skills'],
            ['name' => 'Technical Skills'],
            ['name' => 'Problem Solving'],
            ['name' => 'Research Skills'],
            ['name' => 'Analytical Thinking'],
        ]);
    }
}