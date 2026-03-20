<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\Auth\LoginAttemptService;

class LogLoginSuccess
{
    public function handle(Login $event): void
    {
        $guard = $event->guard ?? 'web';

        LoginAttemptService::log(
            guard: $guard,
            userId: $event->user->id,
            successful: true
        );
    }
}
