<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Constants\Guards;
use App\Http\Controllers\Controller;
use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardLogoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PortalLoginController extends Controller
{
    public function __construct(
        private readonly GuardLogoutService $logoutService,
        private readonly DashboardResolver $dashboardResolver,
    ) {}

    /**
     * Resolve portal guard from the URL prefix.
     *
     * Expected routes:
     * - /student/login
     * - /employer/login
     * - /testuser/login
     *
     * Falls back to Guards::default() if the prefix is not a recognised portal guard.
     */
    private function resolveGuard(Request $request): string
    {
        $prefix = Guards::normalize($request->segment(1));

        return ($prefix && in_array($prefix, Guards::portal(), true))
            ? $prefix
            : Guards::default();
    }

    public function showLoginForm(Request $request)
    {
        return view('portal.auth.login', [
            'guard' => $this->resolveGuard($request),
        ]);
    }

    public function login(Request $request)
    {
        $guard = $this->resolveGuard($request);

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable'],
        ]);

        // Enforce single-session behaviour across session guards
        $this->logoutService->logoutAnyAuthenticatedGuard();

        $remember = (bool) ($credentials['remember'] ?? false);

        $ok = Auth::guard($guard)->attempt([
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember);

        if (! $ok) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();

        // Intended first, then guard dashboard
        return redirect()->intended(
            $this->dashboardResolver->url($guard)
        );
    }
}
