<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureGuardEmailIsVerified;
use App\Schedulers\LoginAttemptCleanupScheduler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;


// Import Spatie middleware classes
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:[
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/shared.php',
            __DIR__.'/../routes/sysadmin.php',
            __DIR__.'/../routes/admin.php',
            __DIR__.'/../routes/student.php',
            __DIR__.'/../routes/employer.php',
            __DIR__.'/../routes/testuser.php',
            __DIR__.'/../routes/spatie_common_routes.php',

        
        ], 
        commands: __DIR__.'/../routes/console.php', 
        health: '/up',
    ) ->withSchedule(function (Schedule $schedule) {

        LoginAttemptCleanupScheduler::register($schedule);

    })->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'auth' => Authenticate::class, // Register your Authenticate middleware
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'email.verified' => EnsureGuardEmailIsVerified::class,
            'redirect.loggedin' => \App\Http\Middleware\RedirectLoggedInToDashboard::class,
        ]);

        $middleware->web(append: [

        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withCommands([
                \App\Console\Commands\CleanOldLoginAttempts::class, 
        ])
->create();
