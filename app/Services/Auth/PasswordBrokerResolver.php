<?php

namespace App\Services\Auth;

final class PasswordBrokerResolver
{
    /**
     * Resolve broker key for a guard.
     * Falls back to auth.defaults.passwords when unmapped or invalid.
     */
    public function broker(string $guard): string
    {
        $map = config('nka.auth.password_brokers', []);
        $fallback = config('auth.defaults.passwords', 'users');
        $broker = $map[$guard] ?? $fallback;

        return config("auth.passwords.$broker") ? $broker : $fallback;
    }
}
