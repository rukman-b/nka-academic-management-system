<?php

// database/seeders/ExitAwardSeeder.php

namespace Database\Seeders;

use App\Models\ExitAward;
use Illuminate\Database\Seeder;

// database/seeders/ExitAwardSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExitAward;
use App\Models\Level;

class ExitAwardSeeder extends Seeder
{
    public function run(): void
    {
        // $level4 = Level::where('fheq_level', 3)->first();
        $level4 = Level::where('fheq_level', 4)->first();
        $level5 = Level::where('fheq_level', 5)->first();
        $level6 = Level::where('fheq_level', 6)->first();

        if (!$level4 || !$level5 || !$level6) {
            $this->command->error('Missing required FHEQ levels (4–6) in levels table.');
            return;
        }

        ExitAward::insert([
            [
                'title'       => 'Certificate of Higher Education',
                'short_code'  => 'CertHE',
                'level_id'    => $level4->id,
                'min_credits' => 120,
                'description' => 'Awarded after successful completion of Level 4 studies.'
            ],
            [
                'title'       => 'Diploma of Higher Education',
                'short_code'  => 'DipHE',
                'level_id'    => $level5->id,
                'min_credits' => 240,
                'description' => 'Awarded after successful completion of Level 5 studies.'
            ],
            [
                'title'       => 'Bachelor\'s Degree without Honours',
                'short_code'  => 'BA/BSc',
                'level_id'    => $level6->id,
                'min_credits' => 300,
                'description' => 'Exit route for students completing most but not all Level 6 requirements.'
            ],
            [
                'title'       => 'Bachelor\'s Degree with Honours',
                'short_code'  => 'BA(Hons)/BSc(Hons)',
                'level_id'    => $level6->id,
                'min_credits' => 360,
                'description' => 'Full honours award for completing Level 6 and all academic requirements.'
            ]
        ]);
    }
}
