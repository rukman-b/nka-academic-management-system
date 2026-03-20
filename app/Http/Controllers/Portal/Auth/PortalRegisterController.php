<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\GuardLogoutService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Constants\Guards;


class PortalRegisterController extends Controller
{
    protected function resolvedGuard(Request $request): string
    {
        $guard = $request->segment(1);

        return in_array($guard, Guards::portal(), true)
            ? $guard
            : Guards::default();
    }

    protected function modelClassForGuard(string $guard): string
    {
        $provider = config("auth.guards.$guard.provider");
        $model = config("auth.providers.$provider.model");

        abort_unless(is_string($model) && class_exists($model), 500, "Model not found for guard [$guard]");

        return $model;
    }

    public function showRegistrationForm(Request $request)
    {
        $guard = $this->resolvedGuard($request);

        return view('portal.auth.register', [
            'guard' => $guard,
        ]);
    }

    public function register(Request $request)
    {
        $guard = $this->resolvedGuard($request);
        $modelClass = $this->modelClassForGuard($guard);
        $table = (new $modelClass())->getTable();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', "unique:$table,email"],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        GuardLogoutService::logoutAuthenticatedGuards();

        $user = $modelClass::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user instanceof MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        Auth::guard($guard)->login($user);

        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            return redirect()->route($guard . '.verification.notice');
        }

        return redirect()->intended(get_guard_dashboard_url($guard));
    }
}
