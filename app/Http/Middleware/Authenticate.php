<?php

namespace App\Http\Middleware;


use App\Services\AdminLTE\AdminLTESettingsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Services
use App\Services\Auth\GuardRedirectService;
use App\Services\Auth\GuardResolver;

class Authenticate
{
    
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $activeGuard = app(GuardResolver::class)->detect($guards);

        if (is_string($activeGuard)) {
            if ($request->isMethod('get')) {
                app(AdminLTESettingsService::class)->apply($request,$activeGuard);
            }
            return $next($request);
        }

        // Handle API requests
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Web route unauthenticated — redirect via GuardRedirectService
        return app(GuardRedirectService::class)->redirectToLogin($request);
    }
}
