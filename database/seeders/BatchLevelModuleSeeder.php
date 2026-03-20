<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BatchLevelModuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('batch_level_module')->insert([
            ['batch_id' => 1, 'level_id' => 4, 'module_id' => 1, 'status' => 'active'],
            ['batch_id' => 1, 'level_id' => 4, 'module_id' => 2, 'status' => 'pending'],
            ['batch_id' => 2, 'level_id' => 4, 'module_id' => 3, 'status' => 'active'],
        ]);
    }
}