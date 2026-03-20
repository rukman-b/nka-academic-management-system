<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Constants\Guards;


/**
|--------------------------------------------------------------------------
| Global Helpers (Keep Minimal)
|--------------------------------------------------------------------------
| These helpers are global functions and therefore effectively "public API"
| inside your application. Keep only truly generic helpers here.
|
| Rule:
| - Pure utility helpers ✅
| - Application behaviour / auth routing logic ❌ (move to services)
*/

/**
|--------------------------------------------------------------------------
| View / Blade Helpers
|--------------------------------------------------------------------------
*/

if (! function_exists('render_blade_attributes')) {
    /**
     * Render an array of attributes into a Blade-compatible attribute string.
     *
     * Use case:
     * - generating Blade attribute strings dynamically (e.g., Blade::render)
     *
     * Note:
     * - This is NOT final HTML attributes rendering.
     * - It outputs Blade dynamic attributes (e.g., :key="true") when values
     *   are arrays/booleans/numbers.
     */
    function render_blade_attributes(array $attributes): string
    {
        return collect($attributes)->map(function ($value, $key) {
            $isDynamic = is_array($value) || is_bool($value) || is_numeric($value);

            $bladeKey = $isDynamic ? ':' . $key : $key;

            $bladeValue = $isDynamic
                ? (is_array($value) ? json_encode($value) : ($value ? 'true' : 'false'))
                : e($value);

            return $bladeKey . '="' . $bladeValue . '"';
        })->implode(' ');
    }
}

/**
|--------------------------------------------------------------------------
| Academic Helpers
|--------------------------------------------------------------------------
*/

if (! function_exists('getDefaultAcademicYear')) {
    /**
     * Determine the default academic year based on today's date.
     *
     * Academic year starts on September 1st:
     * - Before Sep 1: current/next (e.g., 2025/2026)
     * - On/after Sep 1: next/next+1 (e.g., 2026/2027)
     */
    function getDefaultAcademicYear(): string
    {
        $today  = Carbon::today();
        $year   = $today->year;
        $cutoff = Carbon::create($year, 9, 1);

        return $today->lt($cutoff)
            ? "$year/" . ($year + 1)
            : ($year + 1) . '/' . ($year + 2);
    }
}


use Illuminate\Support\Facades\Auth;

if (! function_exists('nka_active_session_guard')) {
    /**
     * Resolve the currently authenticated guard among session guards (web + stakeholders).
     *
     * @return string|null
     */
    function nka_active_session_guard(): ?string
    {
        foreach (Guards::session() as $guard) { // <- your existing guard list
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return null;
    }
}



if (! function_exists('nka_verification_resend_route_name')) {
    /**
     * Get the guard-aware verification resend route name.
     *
     * web      => verification.resend
     * student  => student.verification.resend
     * employer => employer.verification.resend
     */
    function nka_verification_resend_route_name(): string
    {
        $guard = nka_active_session_guard();

        // Default to web route name when no stakeholder session is active
        if (! $guard || $guard === 'web') {
            return 'verification.resend';
        }

        $name = "{$guard}.verification.resend";

        // Safety fallback: if a route isn't registered for some guard
        return \Illuminate\Support\Facades\Route::has($name)
            ? $name
            : 'verification.resend';
    }
}




/**
|--------------------------------------------------------------------------
| Debugging Helpers
|--------------------------------------------------------------------------
*/

function nka_auth_debug(string $message, array $context = []): void
{
    // Facades may not be available during exception rendering
    if (! app()->bound('log')) {
        return;
    }

    if (app()->environment('production')) {
        return;
    }

    if (! config('logging.nka_auth_debug_enabled', false)) {
        return;
    }

    try {
        $trace  = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0] ?? [];
        $source = ($trace['file'] ?? 'unknown') . ':' . ($trace['line'] ?? '0');

        \Illuminate\Support\Facades\Log::channel('nka_auth_debug')
            ->debug("[NKA DEBUG] {$message} @ {$source}", $context);
    } catch (\Throwable $e) {
        // Swallow silently – debug must never break error handling
    }
}

