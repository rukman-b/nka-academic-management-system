<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use App\Services\Auth\LoginAttemptService;

class LogLoginFailure
{
    public function handle(Failed $event): void
    {
        $guard = $event->guard ?? 'web';

        LoginAttemptService::log(
            guard: $guard,
            userId: optional($event->user)->id,
            successful: false
        );
    }
}
