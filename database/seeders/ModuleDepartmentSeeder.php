<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('module_department')->insert([
            ['module_id' => 1, 'department_id' => 1],
            ['module_id' => 2, 'department_id' => 1],
            ['module_id' => 2, 'department_id' => 2],
            ['module_id' => 3, 'department_id' => 3],
        ]);
    }
}