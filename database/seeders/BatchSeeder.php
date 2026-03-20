<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;

class BatchSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Batch::factory()->count(10)->create();
    }
}
