<?php

namespace App\Services\AdminLTE;

use App\Constants\Guards;
use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

final class AdminLTESettingsService
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly DashboardResolver $dashboardResolver,
    ) {}

    /**
     * Apply AdminLTE runtime configuration based on the active guard (and role where relevant).
     *
     * Design rules:
     * - web guard (staff) uses role-aware dashboard resolution
     * - non-web portals use topnav layout + guard label
     * - dashboard URL is always resolved through DashboardResolver (no helpers)
     */
    public function apply(Request $request, ?string $guard = null): void
    {
        ['guard' => $resolvedGuard, 'user' => $user] = $this->guardResolver->identity([$guard]);

        // If nothing is authenticated, do nothing (keep default AdminLTE config)
        if (! $resolvedGuard) {
            return;
        }

        // 1) Staff portal (web): role-aware title + dashboard
        if ($resolvedGuard === Guards::WEB) {
            $roleKey = $user ? $this->dashboardResolver->highestPriorityRole($resolvedGuard, $user) : null;

            Config::set([
                'adminlte.title_postfix' => ' | ' . $this->labelForWebUser($roleKey),
                'adminlte.dashboard_url' => $this->dashboardResolver->url($resolvedGuard, $roleKey),
            ]);

            return;
        }

        // 2) Non-web portals: topnav defaults + portal-specific overrides
        $overrides = $this->portalOverrides($resolvedGuard);

        $this->applyTopnavPortal($resolvedGuard, $user, $overrides);
    }

    /**
     * Apply common "topnav" defaults for portal guards (student/employer/etc.),
     * with a guard-based label and dashboard URL.
     */
    private function applyTopnavPortal(string $guard, $user, array $overrides = []): void
    {
        $roleKey = $user ? $this->dashboardResolver->highestPriorityRole($guard, $user) : null;

        Config::set(array_merge(
            $this->topnavDefaults(),
            [
                'adminlte.title_postfix' => ' | ' . Guards::label($guard),
                'adminlte.dashboard_url' => $this->dashboardResolver->url($guard, $roleKey),
            ],
            $overrides
        ));
    }

    /**
     * Central place to manage per-portal tweaks (body classes, theme switching, etc.)
     * Add new guards here without changing apply().
     */
    private function portalOverrides(string $guard): array
    {
        return match ($guard) {
            Guards::STUDENT => [
                // Your student theme hook (example)
                'adminlte.classes_body' => 'glassmorphism-theme',
            ],
            Guards::EMPLOYER => [
                // Keep empty for now, ready for employer theme later
                // 'adminlte.classes_body' => 'employer-theme',
            ],
            Guards::TESTUSER => [
                // No overrides by default
            ],
            default => [
                // Safe default for any future portal guard
            ],
        };
    }

    /**
     * Default AdminLTE "topnav" configuration for portal experiences.
     */
    private function topnavDefaults(): array
    {
        return [
            'adminlte.layout_topnav' => true,
            'adminlte.layout_dark_mode' => false,
            'adminlte.classes_topnav' => 'navbar-white navbar-light',
            'adminlte.classes_topnav_nav' => 'navbar-expand-lg',
            'adminlte.classes_topnav_container' => 'container-fluid',
            'adminlte.classes_content_header' => 'container-fluid',
            'adminlte.classes_content' => 'container-fluid',
            'adminlte.usermenu_header_class' => '',
        ];
    }

    /**
     * Translate the resolved staff "role key" into a human label for the UI title postfix.
     * If no role is available, fall back to a safe label.
     */
    private function labelForWebUser(?string $roleKey): string
    {
        if (! $roleKey) {
            return 'Staff';
        }

        // Roles::label() exists in your project, but keeping this method isolated
        // avoids coupling AdminLTE logic to RBAC details elsewhere.
        return \App\Constants\Roles::label($roleKey);
    }
}
