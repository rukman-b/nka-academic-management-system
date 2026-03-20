<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgrammeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('programmes')->insert([
            ['name' => 'BSc Computer Science', 'department_id' => 1],
            ['name' => 'BA Graphic Design', 'department_id' => 2],
            ['name' => 'LLB Law', 'department_id' => 3],
            ['name' => 'BEng Mechanical Engineering', 'department_id' => 4],
            ['name' => 'BA English Literature', 'department_id' => 5],
            ['name' => 'BSc Psychology', 'department_id' => 6],
            ['name' => 'BSc Artificial Intelligence', 'department_id' => 1],
            ['name' => 'BSc Cyber Security', 'department_id' => 1],
            ['name' => 'BSc Data Science', 'department_id' => 1],
            ['name' => 'BSc Biomedical Science', 'department_id' => 7],
        ]);
    }
}