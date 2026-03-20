<?php

namespace App\View\Composers;

use App\Constants\Guards;
use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardResolver;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

final class ErrorViewComposer
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly DashboardResolver $dashboardResolver,
    ) {}

    public function compose(View $view): void
    {
        ['guard' => $guard, 'user' => $user] = $this->guardResolver->identity();

        $guard ??= Guards::WEB;

        $userName = $user?->name
            ?? $user?->email
            ?? 'Unknown User';

        $roles = (is_object($user) && method_exists($user, 'getRoleNames'))
            ? $user->getRoleNames()
            : collect();

        // Resolve dashboard route safely (fallback to auth.reset)
        $dashboardRoute = 'auth.reset';

        if ($user) {
            $role = $this->dashboardResolver->highestPriorityRole($guard, $user); // <- keep this name consistent
            $candidate = $this->dashboardResolver->routeName($guard, $role);

            if (is_string($candidate) && $candidate !== '') {
                $dashboardRoute = $candidate;
            }
        }

        $dashboardUrl = Route::has($dashboardRoute)
            ? route($dashboardRoute)
            : route('auth.reset');

        $view->with([
            'identity_guard'      => $guard,
            'identity_user'       => $user,
            'identity_user_name'  => $userName,
            'identity_roles'      => $roles,
            'dashboard_route'     => $dashboardRoute,
            'dashboard_url'       => $dashboardUrl,
        ]);
    }
}
