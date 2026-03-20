<?php

use Illuminate\Support\Facades\Route;

use App\Constants\Guards;
use App\Http\Controllers\Auth\CommonLogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Portal\Auth\PortalLoginController;
use App\Http\Controllers\Portal\Auth\PortalRegisterController;
use App\Http\Controllers\Portal\Auth\ForgotPasswordController;
use App\Http\Controllers\Portal\Auth\ResetPasswordController;
use App\Http\Controllers\Portal\Auth\CustomEmailVerificationController;

/*
|--------------------------------------------------------------------------
| Portal hub (guest entry point)
|--------------------------------------------------------------------------
*/
Route::view('/', 'portal-hub')
    ->name('portal.hub')
    ->middleware('redirect.loggedin');

/*
|--------------------------------------------------------------------------
| Web guard auth (guest-only: login/register/password reset)
|--------------------------------------------------------------------------
| These are for the default "web" guard.
*/
Route::middleware('redirect.loggedin')->group(function () {

    // Login & Register
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password reset (web)
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Email verification (web guard) - NOT guest-only
|--------------------------------------------------------------------------
*/
Route::prefix('email')->as('verification.')->group(function () {
    Route::get('verify', [CustomEmailVerificationController::class, 'showVerificationNotice'])
        ->middleware('auth:web')
        ->name('notice');

    Route::get('verify/{id}/{hash}', [CustomEmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verify');

    Route::post('verification-notification', [CustomEmailVerificationController::class, 'resend'])
        ->middleware(['auth:web', 'throttle:6,1'])
        ->name('resend');
});

/*
|--------------------------------------------------------------------------
| Portal guards auth (student/employer/testuser) - guest-only routes
|--------------------------------------------------------------------------
| Generates routes like:
|   /student/login, /student/register, /student/password/reset, ...
|   /employer/login, /employer/register, ...
|
| NOTE:
| - These routes are behind redirect.loggedin (guest-only gate)
| - Verification routes are NOT included here (to prevent redirect loops)
*/
Route::middleware('redirect.loggedin')->group(function () {

    foreach (Guards::portal() as $guard) {

        Route::prefix($guard)->as($guard . '.')->group(function () {

            // Login
            Route::get('login', [PortalLoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [PortalLoginController::class, 'login'])->name('login.submit');

            // Register
            Route::get('register', [PortalRegisterController::class, 'showRegistrationForm'])->name('register');
            Route::post('register', [PortalRegisterController::class, 'register'])->name('register.submit');

            // Password reset
            Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
            Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

            Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
            Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        });
    }
});

/*
|--------------------------------------------------------------------------
| Portal guard email verification routes - authenticated (NO redirect.loggedin)
|--------------------------------------------------------------------------
*/
foreach (Guards::portal() as $guard) {

    Route::prefix($guard)->as($guard . '.')->group(function () use ($guard) {

        Route::prefix('email')->as('verification.')->group(function () use ($guard) {

            Route::get('verify', [CustomEmailVerificationController::class, 'showVerificationNotice'])
                ->middleware('auth:' . $guard)
                ->name('notice');

            Route::get('verify/{id}/{hash}', [CustomEmailVerificationController::class, 'verify'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verify');

            Route::post('verification-notification', [CustomEmailVerificationController::class, 'resend'])
                ->middleware(['auth:' . $guard, 'throttle:6,1'])
                ->name('resend');
        });
    });
}

/*
|--------------------------------------------------------------------------
| Session reset page (multi-guard protected)
|--------------------------------------------------------------------------
| IMPORTANT:
| Do NOT put email.verified here, otherwise unverified users can't reach it.
*/
Route::view('/auth/reset', 'errors.session-reset')
    ->middleware([
        'web',
        'auth:' . implode(',', Guards::session()),
    ])
    ->name('auth.reset');

/*
|--------------------------------------------------------------------------
| Logout (multi-guard)
|--------------------------------------------------------------------------
| Must stay after other auth routes to override default logout if present.
*/
Route::middleware(['auth:' . implode(',', Guards::session())])->group(function () {
    Route::post('/logout', CommonLogoutController::class)->name('logout');
});
