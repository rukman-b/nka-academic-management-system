<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SysadminNotificationSeeder extends Seeder
{
    public function run(): void
    {
        $sysadmins = User::role('sysadmin')->get();

        if ($sysadmins->isEmpty()) {
            $this->command->warn('No sysadmin users found. Skipping notification seeding.');
            return;
        }

        $samples = [
            [
                'message' => '[Scheduled] 132 login attempt(s) deleted (older than 2025-04-01).',
                'type'    => 'cleanup',
                'level'   => 'info',
            ],
            [
                'message' => '[Scheduled] Cleanup failed: database timeout at 03:00.',
                'type'    => 'cleanup',
                'level'   => 'error',
            ],
            [
                'message' => '[Health Check] Redis connection failed.',
                'type'    => 'health',
                'level'   => 'error',
            ],
            [
                'message' => '[Scheduler] All scheduled tasks completed at 03:00.',
                'type'    => 'scheduler',
                'level'   => 'success',
            ],
            [
                'message' => '[System] Mail queue contains 145 pending emails.',
                'type'    => 'health',
                'level'   => 'warning',
            ],
        ];

        foreach ($sysadmins as $user) {
            foreach ($samples as $sample) {
                DB::table('notifications')->insert([
                    'id'           => Str::uuid(),
                    'type'         => 'App\Notifications\LoginCleanupSummaryNotification', // optional: class name
                    'notifiable_type' => get_class($user),
                    'notifiable_id'   => $user->id,
                    'data'         => json_encode($sample),
                    'created_at'   => Carbon::now()->subMinutes(rand(1, 120)),
                    'updated_at'   => Carbon::now(),
                ]);
            }
        }

        $this->command->info("Seeded sample notifications for {$sysadmins->count()} sysadmin user(s).");
    }
}
