<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchStudentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('batch_student')->insert([
            [
                'batch_id' => 1,
                'student_id' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'batch_id' => 3,
                'student_id' => 1,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'batch_id' => 4,
                'student_id' => 1,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'batch_id' => 2,
                'student_id' => 2,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
