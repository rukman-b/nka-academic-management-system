<?php

// app/Schedulers/BaseScheduler.php

namespace App\Foundation\Scheduling;

use App\Models\SchedulerLog;
use Illuminate\Console\Scheduling\Schedule;

abstract class BaseScheduler
{
    protected static function logCommand(Schedule $schedule, string $command, string $frequencyMethod, ...$params): void
    {
        $schedule->command($command)
            ->{$frequencyMethod}(...$params)
            ->before(function () use ($command) {
                SchedulerLog::create([
                    'command' => $command,
                    'started_at' => now(),
                    'status' => 'pending',
                ]);
            })
            ->after(function () use ($command) {
                SchedulerLog::where('command', $command)
                    ->latest('started_at')
                    ->first()?->update([
                        'finished_at' => now(),
                        'status' => 'success',
                    ]);
            });
    }
}
