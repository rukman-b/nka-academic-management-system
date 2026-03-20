<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $yearsToSeed = 4; // Current year + 3 previous years
        $now = Carbon::now();
        $currentStartYear = $now->month >= 9 ? $now->year : $now->year - 1;

        for ($i = $currentStartYear - ($yearsToSeed - 1); $i <= $currentStartYear; $i++) {
            $academicYear = "{$i}/" . ($i + 1);

            Semester::updateOrCreate(
                ['name' => 'Semester 1', 'academic_year' => $academicYear],
                ['start_date' => "{$i}-09-15", 'end_date' => "{$i}-12-15"]
            );

            Semester::updateOrCreate(
                ['name' => 'Semester 2', 'academic_year' => $academicYear],
                ['start_date' => ($i + 1) . "-01-15", 'end_date' => ($i + 1) . "-04-15"]
            );

            Semester::updateOrCreate(
                ['name' => 'Semester 3', 'academic_year' => $academicYear],
                ['start_date' => ($i + 1) . "-07-01", 'end_date' => ($i + 1) . "-08-01"]
            );

            Semester::updateOrCreate(
                ['name' => 'Full Year', 'academic_year' => $academicYear],
                ['start_date' => ($i + 1) . "-07-01", 'end_date' => ($i + 1) . "-08-01"]
            );
        }
    }
}
