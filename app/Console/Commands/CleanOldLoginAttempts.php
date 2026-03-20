<?php

namespace App\Console\Commands;

use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Notifications\LoginCleanupSummaryNotification; // ← correct FQCN

class CleanOldLoginAttempts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Usage: php artisan cleanup:login-attempts --days=90
     */
    protected $signature = 'cleanup:login-attempts {--days=90 : Delete attempts older than this many days}';

    /**
     * The console command description.
     */
    protected $description = 'Delete login attempts older than a given number of days (default: 90).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = max(1, (int) $this->option('days')); // simple guard
        $cutoff = now()->subDays($days)->startOfDay();

        $deleted = LoginAttempt::where('attempted_at', '<', $cutoff)->delete();

        $msg = "Deleted {$deleted} login attempt(s) older than {$cutoff->toDateString()} ({$days} days).";
        $this->info($msg);
        Log::info("[Scheduled] {$msg}");

        // Notify all sysadmins
        User::role('sysadmin')->each(function ($user) use ($deleted, $cutoff) {
            $user->notify(new LoginCleanupSummaryNotification($deleted, $cutoff->toDateString()));
        });

        return self::SUCCESS;
    }
}
