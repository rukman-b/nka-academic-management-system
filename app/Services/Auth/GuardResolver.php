<?php

namespace App\Services\Auth;

use App\Constants\Guards;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

final class GuardResolver
{
    /**
     * Detect the first authenticated guard from a set of guards.
     *
     * @param array<string>|null $guards
     */
    public function detect(?array $guards = null): ?string
    {
        $guardsToCheck = $this->normalizeGuards($guards);

        foreach ($guardsToCheck as $guard) {
            if ($this->isGuardConfigured($guard) && Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return null;
    }

    /**
     * Resolve the current authenticated identity from a set of guards.
     *
     * @param array<string>|null $guards
     * @return array{guard: string|null, user: Authenticatable|null}
     */
    public function identity(?array $guards = null): array
    {
        $guard = $this->detect($guards);

        if (! $guard) {
            return ['guard' => null, 'user' => null];
        }

        $user = Auth::guard($guard)->user();

        return $user
            ? ['guard' => $guard, 'user' => $user]
            : ['guard' => null, 'user' => null];
    }

    /**
     * Normalize input guards into a validated, ordered list.
     *
     * @param array<string>|null $guards
     * @return array<string>
     */
    private function normalizeGuards(?array $guards): array
    {
        if ($guards === null || $guards === []) {
            return $this->configuredSessionGuardsInPriorityOrder();
        }

        return collect($guards)
            ->filter(fn ($g) => is_string($g))
            ->map(fn ($g) => Guards::normalize($g))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Session guards configured in auth.php, returned in Guards::priority() order.
     *
     * @return array<string>
     */
    public function configuredSessionGuardsInPriorityOrder(): array
    {
        $configuredSession = collect(config('auth.guards', []))
            ->filter(fn ($g) => ($g['driver'] ?? null) === 'session')
            ->keys()
            ->values()
            ->all();

        // Only allow session guards known by your system AND configured in auth.php
        $base = array_values(array_intersect(Guards::session(), $configuredSession));

        // Priority from Guards (single source of truth)
        $priority = array_values(array_intersect(Guards::priority(), $base));
        $remaining = array_values(array_diff($base, $priority));

        return array_values(array_merge($priority, $remaining));
    }

    private function isGuardConfigured(string $guard): bool
    {
        return array_key_exists($guard, config('auth.guards', []));
    }
}
