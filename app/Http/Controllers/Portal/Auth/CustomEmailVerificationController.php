<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\DashboardResolver;
use App\Services\Auth\GuardResolver;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CustomEmailVerificationController extends Controller
{
    public function __construct(
        private readonly GuardResolver $guardResolver,
        private readonly DashboardResolver $dashboardResolver,
    ) {}

    /**
     * Verification notice page.
     * If the current user is already verified, redirect them away.
     */
    public function showVerificationNotice()
    {
        ['guard' => $guard, 'user' => $user] = $this->guardResolver->identity();

        // If unauthenticated, show notice (or you could redirect to portal hub)
        if (! $guard || ! $user) {
            return view('vendor.adminlte.auth.verify');
        }

        // If verification not required for this user model, treat as verified
        if (! ($user instanceof MustVerifyEmail)) {
            return $this->redirectToDashboard($guard, $user);
        }

        // Already verified -> go where they intended / dashboard
        if ($user->hasVerifiedEmail()) {
            return $this->redirectToDashboard($guard, $user);
        }

        return view('vendor.adminlte.auth.verify');
    }

    public function notice()
    {
        return $this->showVerificationNotice();
    }


    /**
     * Handle the signed verification link.
     */
    public function verify(Request $request, $id, $hash)
    {
        $guard = $this->guardResolver->detect();

        if (! $guard) {
            abort(403, 'Unauthenticated.');
        }

        // Signed URL validation must happen before trusting parameters
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }

        $user = $this->resolveUserFromGuardProvider($guard, (int) $id);

        if (! $user || ! ($user instanceof MustVerifyEmail)) {
            abort(403, 'Invalid verification link.');
        }

        // Verify hash matches the user's verification email (Laravel pattern)
        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
            abort(403, 'Invalid verification link.');
        }

        // If already verified, just log in and redirect
        if ($user->hasVerifiedEmail()) {
            Auth::guard($guard)->login($user);

            return $this->redirectToDashboard($guard, $user)
                ->with('message', 'Your email is already verified.');
        }

        // Canonical Laravel method (sets email_verified_at and fires events safely)
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        Auth::guard($guard)->login($user);

        return $this->redirectToDashboard($guard, $user)
            ->with('message', 'Your email has been verified successfully.');
    }

    /**
     * Resend verification email for the currently authenticated user.
     */
    public function resend(Request $request)
    {
        ['guard' => $guard, 'user' => $user] = $this->guardResolver->identity();

        if (! $guard || ! $user) {
            abort(403);
        }

        // If this model does not require verification, just redirect
        if (! ($user instanceof MustVerifyEmail)) {
            return $this->redirectToDashboard($guard, $user);
        }

        // Not verified -> resend notification
        if (! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            return back()->with('message', 'A new verification link has been sent to your email address.');
        }

        // Already verified -> go to dashboard
        return $this->redirectToDashboard($guard, $user);
    }

    /**
     * Resolve a user instance based on the guard's configured provider model.
     * This avoids hardcoding User/Student/Employer models.
     */
    private function resolveUserFromGuardProvider(string $guard, int $id): ?object
    {
        $provider = config("auth.guards.$guard.provider");
        $model    = $provider ? config("auth.providers.$provider.model") : null;

        if (! is_string($model) || ! class_exists($model)) {
            abort(403, 'Invalid authentication context.');
        }

        return $model::find($id);
    }

    /**
     * Redirect to intended URL, falling back to a guard/role-specific dashboard.
     * If dashboard route is missing, fail safe to auth.reset.
     */
    private function redirectToDashboard(string $guard, $user)
    {
        $role = $this->dashboardResolver->highestPriorityRole($guard, $user);
        $routeName = $this->dashboardResolver->routeName($guard, $role);

        if (! Route::has($routeName)) {
            return redirect()->route('auth.reset');
        }

        return redirect()->intended(route($routeName));
    }
}
