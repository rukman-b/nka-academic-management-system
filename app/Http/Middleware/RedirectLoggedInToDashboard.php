<?php

namespace App\Http\Middleware;

use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

final class RedirectLoggedInToDashboard
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly DashboardResolver $dashboardResolver,
    ) {}

    public function handle(Request $request, Closure $next)
    {
        // Allow the recovery route to load without loops
        if ($request->routeIs('auth.reset')) {
            return $next($request);
        }

        // Only iterate guards that are actually configured as session guards
        foreach ($this->guardResolver->configuredSessionGuardsInPriorityOrder() as $guard) {
            if (Auth::guard($guard)->check()) {
                return $this->redirectToDashboard($guard);
            }
        }

        return $next($request);
    }

    private function redirectToDashboard(string $guard)
    {
        $user = Auth::guard($guard)->user();

        if (! $user) {
            // Defensive: if check() was true but user retrieval failed
            return redirect()->route('auth.reset');
        }

        // Role-aware for guards that support roles, otherwise null
        $role = $this->dashboardResolver->highestPriorityRole($guard, $user);

        $routeName = $this->dashboardResolver->routeName($guard, $role);

        // Fail-safe if config drift occurs
        if (! Route::has($routeName)) {
            return redirect()->route('auth.reset');
        }

        return redirect()->to(route($routeName));
    }
}
