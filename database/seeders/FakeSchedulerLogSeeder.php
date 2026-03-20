<?php

// database/seeders/FakeSchedulerLogSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchedulerLog;
use Illuminate\Support\Carbon;

class FakeSchedulerLogSeeder extends Seeder
{

    public function run(): void
    {
        SchedulerLog::truncate();
        $now = Carbon::now()->subDays(5);
        for ($i = 0; $i < 10; $i++) {
            $start = $now->copy()->addDays($i)->setTime(3, 0);
            SchedulerLog::create([
                'command'     => 'cleanup:login-attempts',
                'started_at'  => $start,
                'finished_at' => $start->copy()->addSeconds(rand(20, 45)),
                'status'      => $i % 4 === 0 ? 'failed' : 'success',
                'output'      => 'Simulated output'
            ]);
        }
    }

}
