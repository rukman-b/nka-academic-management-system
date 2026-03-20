<?php

namespace App\Constants;

/**
 * Roles
 * =====
 *
 * Centralised definition of **authorisation role keys** used by the system.
 *
 * Purpose
 * -------
 * - Provide a single source of truth for Spatie role names
 * - Prevent string duplication across policies, middleware, controllers, and UI
 * - Provide human-readable labels for display (AdminLTE user menu, badges, logs)
 *
 * Design Notes
 * ------------
 * - Roles are authorisation only (RBAC). They are not guards.
 * - This class must remain framework-agnostic (no model/service references).
 * - Keep keys aligned with your Spatie `roles` table values.
 */
final class Roles
{
    /** Web-guard roles (staff users) */
    public const SYSTEM_ADMIN = 'sysadmin';
    public const SUPER_ADMIN  = 'superadmin';
    public const ADMIN        = 'admin';

    /**
     * Role labels used for UI display.
     * Keep labels stable for a consistent UX.
     */
    private const LABELS = [
        self::SYSTEM_ADMIN => 'System Administrator',
        self::SUPER_ADMIN  => 'Super Admin',
        self::ADMIN        => 'Admin',
    ];

    /**
     * Get all known role keys.
     *
     * Useful for:
     * - validation (`in:`)
     * - seeding
     * - deterministic ordering / priority lists
     *
     * @return array<int, string>
     */
    public static function all(): array
    {
        return [
            self::SYSTEM_ADMIN,
            self::SUPER_ADMIN,
            self::ADMIN,
        ];
    }

    /**
     * Get all human-readable labels keyed by role name.
     *
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return self::LABELS;
    }

    /**
     * Resolve a human-readable label for a role key.
     * Falls back to a safe title-cased string for unknown roles.
     */
    public static function label(?string $role): string
    {
        $role = self::normalize($role);

        if ($role === null) {
            return 'User';
        }

        return self::LABELS[$role] ?? ucfirst($role);
    }

    /**
     * Check if the role key is one of the known roles.
     */
    public static function isValid(?string $role): bool
    {
        if ($role === null || $role === '') {
            return false;
        }

        return in_array($role, self::all(), true);
    }

    /**
     * Normalise role input (e.g. from request/query/route params).
     * Returns null if empty.
     */
    public static function normalize(?string $role): ?string
    {
        if ($role === null) {
            return null;
        }

        $role = strtolower(trim($role));

        return $role !== '' ? $role : null;
    }
}
