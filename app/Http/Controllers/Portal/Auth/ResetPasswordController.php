<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Constants\Guards;
use App\Http\Controllers\Controller;
use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardResolver;
use App\Services\Auth\PasswordBrokerResolver;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly DashboardResolver $dashboardResolver,
        private readonly PasswordBrokerResolver $brokerResolver,
    ) {}

    /**
     * Resolve which guard this password reset request belongs to.
     *
     * Resolution order:
     * 1) explicit: request input/query 'guard'
     * 2) fallback: first URL segment (e.g., /student/password/reset/...)
     * 3) fallback: default guard
     *
     * Always validated against configured session guards to prevent "guard not defined".
     */
    protected function resolvedGuard(Request $request): string
    {
        $allowed = $this->guardResolver->configuredSessionGuardsInPriorityOrder();

        // 1) explicit (POST hidden input or query string)
        $guard = $request->input('guard') ?? $request->query('guard');

        // 2) fallback: first URL segment
        if (! $guard) {
            $first = $request->segment(1);
            $guard = in_array($first, $allowed, true) ? $first : Guards::default();
        }

        return in_array($guard, $allowed, true)
            ? $guard
            : Guards::default();
    }

    /**
     * Guard used to log the user in after a successful reset.
     * Called by ResetsPasswords trait.
     */
    protected function guard()
    {
        $guard = $this->resolvedGuard(request());
        return Auth::guard($guard);
    }

    /**
     * Password broker for the resolved guard.
     * Called by ResetsPasswords trait.
     */
    public function broker()
    {
        $guard = $this->resolvedGuard(request());
        $brokerKey = $this->brokerResolver->broker($guard);

        return Password::broker($brokerKey);
    }

    /**
     * Redirect path after successful password reset.
     * Must return a STRING URL/path (not a RedirectResponse).
     */
    protected function redirectTo()
    {
        $guard = $this->resolvedGuard(request());
        $user = Auth::guard($guard)->user();

        if (! $user) {
            return route('auth.reset');
        }

        $role = $this->dashboardResolver->highestPriorityRole($guard, $user);
        $routeName = $this->dashboardResolver->routeName($guard, $role);

        // Fail-safe if config drift occurs
        if (! \Illuminate\Support\Facades\Route::has($routeName)) {
            return route('auth.reset');
        }

        return route($routeName);
    }

    /**
     * Show the reset form.
     * Passes resolved guard so the view can post it back (hidden input).
     */
    public function showResetForm(Request $request, $token = null)
    {
        $guard = $this->resolvedGuard($request);

        $view = $guard === Guards::WEB
            ? 'vendor.adminlte.auth.passwords.reset'
            : 'portal.auth.passwords.reset';

        return view($view, [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
            'guard' => $guard,
        ]);
    }
}
