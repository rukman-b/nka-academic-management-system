<?php

namespace App\Services\Auth;

use App\Constants\Guards;
use Illuminate\Support\Facades\Auth;

class GuardLogoutService
{
    /**
     * Logout ALL authenticated session-based guards for the current request.
     *
     * This is a SAFETY / CLEANUP utility.
     *
     * Under normal system rules, only ONE guard should ever be authenticated
     * in a single browser session. This method exists to defensively clean up
     * the session in case:
     *  - a bug
     *  - a misconfiguration
     *  - a future change
     * results in multiple guards being authenticated at the same time.
     *
     * Typical use cases:
     *  - forced session reset
     *  - security cleanup
     *  - testing / debugging
     *
     * NOT recommended for normal "Logout" button flows.
     *
     * @param  array<string>  $guards  Optional subset of guards to check
     * @return array<string>           List of guards that were logged out
     */
    public static function logoutAuthenticatedGuards(array $guards = []): array
    {
        $guards = $guards ?: Guards::session();

        $loggedOut = [];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                $loggedOut[] = $guard;
            }
        }

        if (!empty($loggedOut)) {
            self::invalidateSession();
        }

        return $loggedOut;
    }

    /**
     * Logout the SINGLE currently-authenticated guard and return its name.
     *
     * This is the PRIMARY method for normal user-initiated logout flows.
     *
     * It aligns with the system policy:
     *  - Only ONE user (one guard) may be logged in per browser session.
     *
     * Behaviour:
     *  - Finds the first authenticated session-based guard
     *  - Logs it out
     *  - Invalidates the session ONCE
     *  - Returns the guard name so the caller can redirect appropriately
     *
     * @param  array<string>  $guards  Optional subset of guards to check
     * @return string|null             Guard that was logged out, or null if none
     */
    public static function logoutAnyAuthenticatedGuard(array $guards = []): ?string
    {
        $guards = $guards ?: Guards::session();

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                self::invalidateSession();

                return $guard;
            }
        }

        return null;
    }

    /**
     * Invalidate the current session safely.
     *
     * - Rotates the session ID
     * - Regenerates the CSRF token
     * - Executed only when a session exists
     *
     * Extracted to avoid duplication and to keep logout logic consistent.
     */
    private static function invalidateSession(): void
    {
        if (request()->hasSession()) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
    }
}
