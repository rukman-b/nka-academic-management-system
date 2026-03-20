<?php

namespace App\Services\Auth;

use Illuminate\Support\Str;

final class DashboardResolver
{
    /**
     * Resolve dashboard route name for a given guard and optional role.
     * Falls back to 'auth.reset' when not resolvable.
     */
    public function routeName(string $guard, ?string $role = null): string
    {
        $config = config("nka.auth.dashboard_routes.$guard");
        if (is_string($config)) {
            return trim($config);
        }

        if (is_array($config)) {
            if ($role && isset($config['roles'][$role])) {
                return trim($config['roles'][$role]);
            }

            return trim($config['default'] ?? 'auth.reset');
        }

        return 'auth.reset';
    }

    /**
     * Resolve dashboard URL from the route name.
     */
    public function url(string $guard, ?string $role = null): string
    {
        return route($this->routeName($guard, $role));
    }

    /**
     * Resolve highest priority role for a user under a given guard.
     * Uses config('nka.dashboard_role_priority.<guard>') first, then alphabetical fallback.
     */
    public function highestPriorityRole(string $guard, $user): ?string
    {
        if (! $user || ! method_exists($user, 'getRoleNames')) {
            return null;
        }

        $roles = $user->getRoleNames()
            ->filter(fn ($r) => is_string($r))
            ->values();

        if ($roles->isEmpty()) {
            return null;
        }

        $priority = config("nka.dashboard_role_priority.$guard", []);

        $priorityLower = collect($priority)
            ->filter(fn ($r) => is_string($r))
            ->map(fn ($r) => Str::lower($r))
            ->values();

        foreach ($priorityLower as $prio) {
            $matched = $roles->first(fn ($r) => Str::lower($r) === $prio);
            if ($matched) {
                return $matched;
            }
        }

        return $roles->sortBy(fn ($r) => Str::lower($r))->first();
    }
}
