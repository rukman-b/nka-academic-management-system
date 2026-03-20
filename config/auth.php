<?php

use App\Constants\Guards;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', Guards::WEB),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],


    //Planning to remove
    //  // Add this line to fix the EnsureEmailIsVerified fallback redirect
    // 'verification_redirect' => 'verification.notice',



    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        Guards::WEB => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        Guards::STUDENT => [
            'driver' => 'session',
            'provider' => 'students',
         ],
        Guards::EMPLOYER => [
            'driver' => 'session',
            'provider' => 'employers',
         ],

        Guards::TESTUSER => [
            'driver' => 'session',
            'provider' => 'testusers',
         ],

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent the model / table. These providers may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],

        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],

        'employers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employer::class,
        ],

        'testusers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Testuser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60, //Token expiration time (in minutes)
            'throttle' => 60, //Time (in minutes) to wait before a user can request another password reset link.

        ],
      'students' => [
            'provider' => 'students',
            'table' => 'student_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

      'employers' => [
            'provider' => 'employers',
            'table' => 'employer_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'testusers' => [
            'provider' => 'testusers',
            'table' => 'testuser_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),




];
