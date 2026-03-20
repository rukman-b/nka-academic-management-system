<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one of each department exists
        // Lecturer::factory()->create(['department_id' => 3]);
        // Lecturer::factory()->create(['department_id' => 2]);
        // Lecturer::factory()->create(['department_id' => 5]);

        // Create the rest randomly
        Lecturer::factory()->count(7)->create();


    }
}
