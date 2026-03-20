<?php

use App\Constants\Roles;


return [

    /*
    |--------------------------------------------------------------------------
    | NKA Configuration
    |--------------------------------------------------------------------------
    |
    | Central configuration for Negombo Knowledge Academy (NKA).
    | Keep this file deterministic and environment-safe:
    | - Avoid runtime calls (e.g., now()) inside config
    | - Prefer primitives (strings/ints/bools/arrays)
    | - Move behaviour into services (resolvers, managers)
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Academic Rules
    |--------------------------------------------------------------------------
    */
    'academic' => [

        'grading' => [
            // Programme-level defaults (can be overridden by Configs if needed)
            'pass_mark' => [
                'undergraduate' => 40,
                'postgraduate'  => 50,
            ],

            // If a resit mark is capped, what is the maximum awarded mark?
            'resit_mark_cap' => [
                'undergraduate' => 40,
                'postgraduate'  => 50,
            ],

            // Student optional module selection policy
            'optional_module_limit_per_level' => 2,
        ],

        'year' => [
            // How many academic years are selectable (UI constraints)
            'selectable_range' => [
                'past'   => 3,
                'future' => 2,
            ],
        ],

        'semester' => [
            // Duration rules used by validation logic
            'duration_weeks' => [
                'min' => 12,
                'max' => 18,
            ],

            // Authoritative semester labels used in UI
            'names' => [
                'Semester 1',
                'Semester 2',
                'Semester 3',
                'Full Year',
            ],

            // Semesters excluded from duration validation (special terms)
            'exclude_from_duration_check' => [
                'Semester 3',
                'Full Year',
            ],
        ],

        'resit' => [
            // Resit administrative policy
            'window_weeks'         => 4,
            'exam_month'           => 8,   // August (1-12)
            'max_attempts'         => 1,
            'max_credits_per_year' => 60,

            // Legacy compatibility: some older logic may still read this
            'mark_cap_legacy' => 40,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication & Access
    |--------------------------------------------------------------------------
    */
    'auth' => [

        // Default fallback route for unauthenticated web requests
        'unauthenticated_redirect_route' => 'portal.hub',

        /*
        |----------------------------------------------------------------------
        | Dashboard Routes
        |----------------------------------------------------------------------
        | Supports:
        | - string route name for simple guards
        | - role-based map for guards like 'web'
        */
        'dashboard_routes' => [
            'web' => [
                'roles' => [
                    Roles::SYSTEM_ADMIN     => 'sysadmin.dashboard',
                    Roles::SUPER_ADMIN      => 'admin.dashboard',
                    Roles::ADMIN            => 'admin.dashboard',
                ],
                'default' => 'auth.reset',
            ],

            'student'  => 'student.dashboard',
            'employer' => 'employer.dashboard',
            'testuser' => 'testuser.dashboard',
        ],

        // Role priority per guard (used when resolving a dashboard role)
        'dashboard_role_priority' => [
            'web' => ['sysadmin', 'superadmin', 'admin'],
        ],

        // Password broker name per guard (must exist in config/auth.php -> passwords)
        'password_brokers' => [
            'web'      => 'users',
            'student'  => 'students',
            'employer' => 'employers',
            'testuser' => 'testusers',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | UI / AdminLTE
    |--------------------------------------------------------------------------
    */
    'ui' => [

        // Theme/skin asset mapping per guard (paths are project-specific)
        'skins' => [
            'web'      => '', // staff uses default AdminLTE styles
            'student'  => 'resources/scss/skins/student/student.scss',
            'employer' => 'resources/css/skins/employer.css',
            'testuser' => 'resources/css/skins/testuser.css',
        ],

        /*
        |----------------------------------------------------------------------
        | AdminLTE Overrides by Guard
        |----------------------------------------------------------------------
        | These are applied at runtime (e.g. AdminLTESettingsService).
        | Keep them as AdminLTE config keys => values.
        */
        'adminlte_overrides_by_guard' => [
            'student' => [
                'adminlte.layout_topnav' => true,
                'adminlte.classes_body'  => 'glassmorphism-theme',
            ],
            'employer' => [
                'adminlte.layout_topnav' => true,
            ],
            'testuser' => [
                'adminlte.layout_topnav' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Batch/Student State Machine
    |--------------------------------------------------------------------------
    | Allowed transitions for batch_student.status.
    */
    'batch_student' => [
        'status_transitions' => [
            'paused'    => ['paused', 'active'],
            'active'    => ['active', 'paused', 'exit'],
            'exit'      => ['exit'],
            'completed' => ['completed'],
            ''          => ['active'], // initial/default state
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | System Flags
    |--------------------------------------------------------------------------
    */
    'system' => [
        'status' => [
            'active'   => 1,
            'inactive' => 0,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    | Use TTL in seconds for config. Compute expiry using now()->addSeconds(...)
    | inside services (never call now() in config files).
    */
    'cache' => [
        'ttl_seconds' => [
            'long'   => 60 * 60 * 24 * 30 * 6,  // ~6 months
            'medium' => 60 * 60 * 24 * 7 * 4,   // ~4 weeks
            'short'  => 60 * 60,                // 1 hour
        ],
    ],

];
