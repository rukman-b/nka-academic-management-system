<?php

// app/Schedulers/LoginAttemptCleanupScheduler.php

namespace App\Schedulers;

use App\Foundation\Scheduling\BaseScheduler;
use Illuminate\Console\Scheduling\Schedule;

class LoginAttemptCleanupScheduler extends BaseScheduler
{
    public static function register(Schedule $schedule): void
    {
        static::logCommand($schedule, 'cleanup:login-attempts', 'monthlyOn', 1, '03:00');
    }
}
