<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

// class ProgrammeExitAwardSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $level4 = DB::table('levels')->where('fheq_level', 4)->value('id');
//         $level5 = DB::table('levels')->where('fheq_level', 5)->value('id');
//         $level6 = DB::table('levels')->where('fheq_level', 6)->value('id');

//         DB::table('programme_exit_awards')->insert([
//             ['programme_id' => 1, 'level_id' => $level4, 'award_title' => 'CertHE', 'description' => 'Certificate of Higher Education'],
//             ['programme_id' => 1, 'level_id' => $level5, 'award_title' => 'DipHE', 'description' => 'Diploma of Higher Education'],
//             ['programme_id' => 1, 'level_id' => $level6, 'award_title' => 'BSc (Hons)', 'description' => 'Bachelor of Science Honours'],
//             ['programme_id' => 2, 'level_id' => $level4, 'award_title' => 'CertHE', 'description' => null],
//             ['programme_id' => 2, 'level_id' => $level5, 'award_title' => 'DipHE', 'description' => null],
//         ]);
//     }
// }


namespace Database\Seeders;

use App\Models\Programme;
use App\Models\Level;
use App\Models\ProgrammeExitAward;
use Illuminate\Database\Seeder;

class ProgrammeExitAwardSeeder extends Seeder
{
    public function run(): void
    {
        $awardMap = [
            4 => 'CertHE',
            5 => 'DipHE',
            6 => 'BSc (Hons)',
            7 => 'Postgraduate Diploma',
            8 => 'Masters Degree',
        ];

        $programmes = Programme::all();
        $levels = Level::all();

        foreach ($programmes as $programme) {
            foreach ($levels as $level) {
                if (isset($awardMap[$level->fheq_level])) {
                    ProgrammeExitAward::updateOrCreate([
                        'programme_id' => $programme->id,
                        'level_id' => $level->id,
                    ], [
                        'award_title' => $awardMap[$level->fheq_level],
                        'description' => "Awarded upon completion of FHEQ  Level {$level->fheq_level}.",
                    ]);
                }
            }
        }
    }
}

