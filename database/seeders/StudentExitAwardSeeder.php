<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\ProgrammeExitAward;
use App\Models\StudentExitAward;

class StudentExitAwardSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $awards = ProgrammeExitAward::all();

        foreach ($students as $student) {
            $matchedAwards = $awards->where('programme_id', $student->programme_id)->random(1);
            foreach ($matchedAwards as $award) {
                StudentExitAward::firstOrCreate([
                    'student_id' => $student->id,
                    'programme_exit_award_id' => $award->id,
                ], [
                    'awarded_at' => now()->subDays(rand(1, 365)),
                ]);
            }
        }
    }
}
