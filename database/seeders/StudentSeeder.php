<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Programme;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'), 
            'phone' => '0712345678',
            'dob' => '2000-01-01',
        ]);

        // Create 20 dummy students using factory
        Student::factory()->count(20)->create();
    }
}
