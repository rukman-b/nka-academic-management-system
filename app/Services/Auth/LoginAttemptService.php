<?php

namespace App\Services\Auth;

use App\Models\LoginAttempt;

class LoginAttemptService
{
    public static function log(string $guard, ?int $userId, bool $successful): void
    {
        LoginAttempt::create([
            'guard' => $guard,
            'user_id' => $userId,
            'successful' => $successful,
            'attempted_at' => now(),
        ]);
    }
}
