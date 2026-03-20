<?php

namespace App\Services\Auth;

use App\Constants\Guards;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

final class GuardRedirectService
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
    ) {}

    public function redirectToLogin(Request $request): RedirectResponse
    {
        $guard = $this->resolveGuardFromRequest($request);

        $routeName = $this->loginRouteNameForGuard($guard);

        if (! Route::has($routeName)) {
            return redirect()->guest($this->fallbackUrl());
        }

        return redirect()->guest(route($routeName));
    }

    public function resolveGuardFromRequest(Request $request): string
    {
        $segment = Guards::normalize($request->segment(1));
        if ($segment && Guards::isPortal($segment)) {
            return $segment;
        }

        $detected = $this->guardResolver->detect();
        if ($detected && Guards::isValid($detected)) {
            return $detected;
        }

        return Guards::default();
    }

    public function loginRouteNameForGuard(string $guard): string
    {
        if ($guard === Guards::WEB) {
            return 'login';
        }

        if (Guards::isPortal($guard)) {
            return "{$guard}.login";
        }

        return $this->fallbackRouteName();
    }

    public function fallbackRouteName(): string
    {
        return (string) config('nka.auth.unauthenticated_redirect_route', 'portal.hub');
    }

    public function fallbackUrl(): string
    {
        $fallback = $this->fallbackRouteName();

        return Route::has($fallback)
            ? route($fallback)
            : '/';
    }
}
