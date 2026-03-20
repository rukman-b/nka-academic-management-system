<?php

namespace App\Http\Middleware;

use App\Constants\Guards;
use App\Services\Auth\GuardRedirectService;
use App\Services\Auth\GuardResolver;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class EnsureGuardEmailIsVerified
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly GuardRedirectService $redirectService,
    ) {}

    /**
     * Ensure the authenticated user (under the resolved guard) has a verified email.
     *
     * Usage:
     * - email.verified
     * - email.verified:web
     * - email.verified:student
     * - email.verified:web,student,employer
     *
     * Rules:
     * - If multiple guards are provided, the first authenticated guard wins.
     * - If no guards are provided, uses Guards::session() (single-session model).
     * - If the user does not implement MustVerifyEmail, this middleware is a no-op.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = $this->normalizeGuards($guards);

        // Resolve authenticated identity (first authenticated guard wins)
        ['guard' => $guard, 'user' => $user] = $this->guardResolver->identity($guards);

        if (! $user) {
            // Not authenticated under any of the expected guards
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return $this->redirectService->redirectToLogin($request);
        }

        // If verification is required and not satisfied, block access
        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Email address is not verified.'], 403);
            }

            return redirect()->route($this->verificationNoticeRouteFor($guard ?? Guards::default()));
        }

        return $next($request);
    }

    /**
     * Normalise the middleware guard parameters.
     *
     * - Filters invalid/empty entries
     * - If none provided, defaults to all session guards (consistent with single-session behaviour)
     */
    private function normalizeGuards(array $guards): array
    {
        $guards = collect($guards)
            ->filter(fn ($g) => is_string($g) && $g !== '')
            ->map(fn ($g) => Guards::normalize($g))
            ->filter()
            ->unique()
            ->values()
            ->all();

        return $guards ?: Guards::session();
    }

    /**
     * Resolve verification notice route name for the given guard.
     *
     * web    -> verification.notice
     * others -> {guard}.verification.notice (student.verification.notice, employer.verification.notice, ...)
     */
    private function verificationNoticeRouteFor(string $guard): string
    {
        return $guard === Guards::WEB
            ? 'verification.notice'
            : "{$guard}.verification.notice";
    }
}
