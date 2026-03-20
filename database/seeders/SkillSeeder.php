<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SkillSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('skills')->insert([
            ['name' => 'Written Communication', 'skill_category_id' => 1],
            ['name' => 'Public Speaking', 'skill_category_id' => 1],
            ['name' => 'Programming in Python', 'skill_category_id' => 2],
            ['name' => 'Data Analysis', 'skill_category_id' => 2],
            ['name' => 'Debugging', 'skill_category_id' => 2],
            ['name' => 'Critical Thinking', 'skill_category_id' => 3],
            ['name' => 'Literature Review', 'skill_category_id' => 4],
            ['name' => 'Statistical Reasoning', 'skill_category_id' => 5],
            ['name' => 'System Design', 'skill_category_id' => 2],
            ['name' => 'Scientific Method', 'skill_category_id' => 4],
        ]);
    }
}
