<?php

namespace App\Constants;

/**
 * Guards
 * ======
 *
 * Centralised definition and classification of authentication guard names
 * used by the application.
 *
 * Purpose
 * -------
 * - Provide a single source of truth for all guard identifiers
 * - Prevent string duplication across routes, middleware, and services
 * - Support deterministic multi-guard resolution (single active session)
 * - Offer guard categorisation helpers for portal and API flows
 *
 * Design Notes
 * ------------
 * - Guards represent authentication context only (session or token)
 * - User providers, password brokers, roles, and permissions are configured elsewhere
 * - This class must not reference models, roles, or application logic
 *
 * Typical Usage
 * -------------
 * - Routes:
 *     auth: implode(',', Guards::session())
 *
 * - Middleware:
 *     Guards::priority()      // multi-guard resolution
 *     Guards::isPortal($g)    // portal-specific behaviour
 *
 * - UI / Logs:
 *     Guards::label($guard)
 *
 * - Validation:
 *     Guards::normalize($input)
 */

final class Guards
{
    
/**
 * Guard names for session-based authentication.
 * These represent interactive user portals.
 */
    public const WEB      = 'web';
    public const STUDENT  = 'student';
    public const EMPLOYER = 'employer';
    public const TESTUSER = 'testuser';

    /**
     * Non-session authentication guard (e.g. API tokens / Sanctum).
     * Only include if configured in config/auth.php.
     */
    public const API      = 'api';

    /**
     * Single source of truth for guard groupings.
     * Keep these lists in sync with config/auth.php.
     */
    private const SESSION_GUARDS = [
        self::WEB,
        self::STUDENT,
        self::EMPLOYER,
        self::TESTUSER,
    ];

    private const NON_SESSION_GUARDS = [
        self::API,
    ];

    /**
     * Preferred resolution order for multi-guard auth:
     * "first authenticated guard wins".
     */
    private const PRIORITY = self::SESSION_GUARDS;

    /**
     * Human-readable labels for each guard.
     */
    private const LABELS = [
        self::WEB      => 'Web',
        self::STUDENT  => 'Student',
        self::EMPLOYER => 'Employer',
        self::TESTUSER => 'Test User',
        self::API      => 'API',
    ];

    /**
     * Return all configured guard names (session + non-session).
     *
     * Use when validating guard input or iterating all known guards.
     */
    public static function all(): array
    {
        // array_values to guarantee numeric indexes
        return array_values(array_merge(self::SESSION_GUARDS, self::NON_SESSION_GUARDS));
    }

    /**
     * Return guards intended for session-based authentication.
     *
     * Used by route middleware and multi-guard authentication logic.
     */
    public static function session(): array
    {
        return self::SESSION_GUARDS;
    }

    /**
     * Return guards that do not use sessions (e.g. API).
     */
    public static function nonSession(): array
    {
        return self::NON_SESSION_GUARDS;
    }

    /**
     * Return portal guards (session-based, excluding the web guard).
     *
     * Useful for portal-specific routing and UI logic.
     */
    public static function portal(): array
    {
        return array_values(array_diff(self::SESSION_GUARDS, [self::WEB]));
    }

    /**
     * Return guard priority for deterministic multi-guard resolution.
     *
     * The first authenticated guard in this list is treated as active.
     */
    public static function priority(): array
    {
        return self::PRIORITY;
    }

    /**
     * Return the default session guard for the application.
     *
     * Must remain consistent with config/auth.php defaults.guard.
     */
    public static function default(): string
    {
        return self::WEB;
    }

    /**
     * Determine whether a guard name is valid and configured.
     */
    public static function isValid(?string $guard): bool
    {
        if ($guard === null || $guard === '') {
            return false;
        }

        return in_array($guard, self::all(), true);
    }

    /**
     * Determine whether a guard uses session-based authentication.
     */
    public static function isSession(string $guard): bool
    {
        return in_array($guard, self::SESSION_GUARDS, true);
    }

    /**
     * Determine whether a guard represents a portal user.
     */
    public static function isPortal(string $guard): bool
    {
        return self::isSession($guard) && $guard !== self::WEB;
    }

    /**
     * Return all human-readable guard labels.
     *
     * Intended for UI display, logs, and reports.
     */
    public static function labels(): array
    {
        return self::LABELS;
    }

    /**
     * Return a human-readable label for a given guard.
     */
    public static function label(string $guard): string
    {
        return self::LABELS[$guard] ?? ucfirst($guard);
    }

    /**
     * Normalize a guard value from user input or route parameters.
     *
     * Returns null if the guard is not recognised.
     */
    public static function normalize(?string $guard): ?string
    {
        if ($guard === null) {
            return null;
        }

        $guard = strtolower(trim($guard));

        return self::isValid($guard) ? $guard : null;
    }
}
