<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Computer Science'],
            ['name' => 'Art and Design'],
            ['name' => 'Law'],
            ['name' => 'Engineering'],
            ['name' => 'Humanities'],
            ['name' => 'Psychology'],
            ['name' => 'Medical Sciences'],
        ]);
    }
}