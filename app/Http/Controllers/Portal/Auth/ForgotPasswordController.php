<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Constants\Guards;
use App\Http\Controllers\Controller;
use App\Services\Auth\GuardResolver;
use App\Services\Auth\PasswordBrokerResolver;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly PasswordBrokerResolver $brokerResolver,
    ) {}

    /**
     * Decide guard from:
     * 1) explicit query/input "guard"
     * 2) URL prefix (/student/password/reset => student)
     * 3) fallback to default guard
     *
     * Always validated against configured session guards.
     */
    protected function resolvedGuard(Request $request): string
    {
        $allowed = $this->guardResolver->configuredSessionGuardsInPriorityOrder();

        // 1) explicit
        $guard = $request->input('guard') ?? $request->query('guard');

        // 2) URL prefix fallback
        if (! $guard) {
            $first = $request->segment(1);
            $guard = in_array($first, $allowed, true) ? $first : Guards::default();
        }

        return in_array($guard, $allowed, true)
            ? $guard
            : $this->guardResolver->defaultGuard();
    }

    /**
     * Override trait method so web uses AdminLTE view and portals use portal view.
     */
    public function showLinkRequestForm(Request $request)
    {
        $guard = $this->resolvedGuard($request);

        $view = $guard === Guards::WEB
            ? 'vendor.adminlte.auth.passwords.email'
            : 'portal.auth.passwords.email';

        return view($view, [
            'guard' => $guard,
        ]);
    }

    /**
     * Make broker guard-aware (trait calls this).
     */
    public function broker()
    {
        $guard = $this->resolvedGuard(request());

        $brokerKey = $this->brokerResolver->broker($guard);
        return Password::broker($brokerKey);
    }
}
