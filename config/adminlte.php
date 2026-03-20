<?php
use App\Constants\Permissions;


return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    // 'title' => 'AdminLTE 3',
    // 'title_prefix' => '',
    // 'title_postfix' => '',
    'title' => 'Student Portal',
    'title_prefix' => 'NKA-HUB - ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>NKA</b>HUB',
    'logo_img' => 'vendor/adminlte/dist/img/NKA_Logo.png',
    // 'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'NKA Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/NKA_Logo.png',
            'alt' => 'NKA Preloader Image',
            'effect' => 'animation__wobble',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => '',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/page-not-found',
    'logout_url' => 'logout',  // Completely disable
    'logout_method' => 'POST',    
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundlin
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => 'vite',
    'laravel_css_path' => 'resources/css/app.css',
    'laravel_js_path' => 'resources/js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'pages',
            'url' => 'admin/pages',
            'icon' => 'far fa-fw fa-file',
            'label' => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'route' => 'profile',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'route' => 'change-password',
            'icon' => 'fas fa-fw fa-lock',
        ],

        //System Admin Menue items
        [
            'header'=>'SYSTEM ADMINISTRATOR',
            'can' => Permissions::VIEW_SYSTEM_ADMIN_MENU_HEADING,
        
        ],
            [
                // 'text'=>'Dashboard',
                // 'route'=>'sysadmin.dashboard.index',   
                // 'icon' => 'fas fa-tachometer-alt',
                // 'can' => 'sys-admin-menu',

                'text' => 'Dashboard',
                'route'  => 'sysadmin.dashboard',
                'icon'   => 'fas fa-tools',
                // 'active' => ['sysadmin/*'],
                'classes' => 'wire-navigate',
                'can' => Permissions::VIEW_SYSTEM_ADMIN_DASHBOARD,
            ],
            [
                'text' => 'Users',
                'route'  => 'sysadmin.users',
                'icon' => 'fas fa-users',
                'can' => Permissions::VIEW_USERS,
            ],
            [
                'text' => 'Roles',
                'route'  => 'sysadmin.roles',
                'icon' => 'fas fa-user-shield',
                'can' => Permissions::VIEW_ROLES,
            ],
            [
                'text' => 'Permissions',
                'route' => 'sysadmin.permissions',
                'icon' => 'fas fa-key',
                'can' => Permissions::VIEW_PERMISSIONS,
            ],
            // [
            //     'text' => 'Create User',
            //     'url'  => 'admin/users/create',
            //     'icon' => 'fas fa-user-plus',
            // ],

        // Admin Menu Items    
        [
            'header'=>'SUPER STUDENT ADMIN',
            'can' => Permissions::VIEW_SUPER_ADMIN_MENU_HEADING,
        
        ],
        [
            'header'=>'ADMIN',
            'can' => 'admin-menu',
        
        ],
            [
                'text'=>'Dashboard',
                'route'=>'admin.dashboard',   
                'icon' => 'fas fa-tachometer-alt',
                'can' => Permissions::VIEW_ADMIN_DASHBOARD,
            ],
            
            
           
        [
            'text' => 'University',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Departments',
                    'route' => 'admin.departments',
                    'icon'  => 'fas fa-building',
                    // 'can'   => \App\Constants\Permissions::VIEW_DEPARTMENTS,
                    'can' => 'view admin dashboard',
                ],
            ],
        ],
        
        [
            'text' => 'Programme Details',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
               
                [
                    'text' => 'Levels',
                    'route' => 'admin.levels',
                    'icon'  => 'fas fa-layer-group',
                    // 'can'   => \App\Constants\Permissions::VIEW_LEVELS,
                    'can' => 'view admin dashboard',

                ],
                 [
                    'text' => 'Programmes',
                    'route' => 'admin.programmes',
                    'icon'  => 'fas fa-graduation-cap',
                    // 'can'   => \App\Constants\Permissions::VIEW_PROGRAMMES,
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Modules',
                    'route' => 'admin.modules',
                    'icon'  => 'fas fa-puzzle-piece',
                    // 'can'   => \App\Constants\Permissions::VIEW_MODULES,
                    'can' => 'view admin dashboard',

                ],

                [
                    'text' => 'Practicals',
                    'route' => 'admin.practicals',
                    'icon'  => 'fas fa-vials',
                    // 'can'   => \App\Constants\Permissions::VIEW_PRACTICALS,
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Theories',
                    'route' => 'admin.theories',
                    'icon'  => 'fas fa-book',
                    // 'can'   => \App\Constants\Permissions::VIEW_THEORIES,
                    'can' => 'view admin dashboard',

                ],
                 [
                    'text' => 'Skills',
                    'route' => 'admin.skills',
                    'icon'  => 'fas fa-tools',
                    // 'can'   => \App\Constants\Permissions::VIEW_SKILLS,
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Skill Categories',
                    'route' => 'admin.skillcategories',
                    'icon'  => 'fas fa-list-alt',
                    // 'can'   => \App\Constants\Permissions::VIEW_SKILLCATEGORIES,
                    'can' => 'view admin dashboard',

                ],
            ],
        ],
        [
            'text' => 'Configs',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Programme Configs',
                    'route' => 'admin.configs',
                    'icon'  => 'fas fa-cogs',
                    // 'can'   => 'view configs', // OPTIONAL: if you use Spatie permission-based visibility
                    'can' => 'view admin dashboard',

                ],
                
            ],
        ],

         [
            'text' => 'Assignments',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Config Modules Assignment',
                    'url'  => 'admin/config-modules',
                    'icon' => 'fas fa-puzzle-piece',
                    'can' => 'view admin dashboard', // optional: use Spatie permission if applicable
                ],
                [
                    'text' => 'Module Practicals Assignment',
                    'route' => 'admin.practical-module-assignments',
                    'icon'  => 'fas fa-vials',
                    // 'can'   => \App\Constants\Permissions::VIEW_PRACTICALS,
                    'can' => 'view admin dashboard',

                ],
                 [
                    'text' => 'Module Thoery Assignment',
                    'route' => 'admin.module-theory-assignments',
                    'icon'  => 'fas fa-vials',
                    // 'can'   => \App\Constants\Permissions::VIEW_PRACTICALS,
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Module Skill Assignment',
                    'route' => 'admin.module-skill-assigner',
                    'icon' => 'fas fa-tools',
                    'can'  => 'view admin dashboard', // optional: add permission if using Spatie
                ],
                 [
                    'text' => 'Assign Students to Batches',
                    'url'  => 'admin/assign-student-batch',
                    'icon' => 'fas fa-user-plus',
                    'can' => 'view admin dashboard', // Optional: use a Spatie permission
                ],
            ],
        ],
        
        [
            'text' => 'Semesters',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Manage Semesters',
                    'url'  => 'admin/semesters',
                    'icon' => 'fas fa-calendar-alt',
                    // 'can'  => 'view semesters', // optional, if using Spatie permissions
                    'can' => 'view admin dashboard',

                ],

                 [
                    'text' => 'Module Semesters',
                    'url' => 'admin/module-semester-assign',
                    'icon' => 'fas fa-calendar-week',
                    'can' => 'view admin dashboard',

                ],

            ],
        ],

        [
            'text' => 'Awards',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Exit Awards',
                    'route' => 'admin.exit-awards',
                    'icon' => 'fas fa-certificate',
                    'can' => 'view admin dashboard', // Optional: Spatie permission check
                ],
                [
                    'text' => 'Programme Exit Awards',
                    'url'  => 'admin/programme-exit-awards',
                    'icon' => 'fas fa-award',
                    // 'can'  => 'view programme_exit_awards',
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Student Exit Awards',
                    'route' => 'admin.student-exit-awards',
                    'icon' => 'fas fa-certificate',
                    // 'can' => 'manage student e xit awards', // Adjust permission as needed
                    'can' => 'view admin dashboard',

                ],
            ],
        ],
        [
            'text' => 'Students',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Students',
                    'route' => 'admin.students',
                    'icon'  => 'fas fa-user-graduate',
                    // 'can'   => 'view students', // Optional: Add a Spatie permission if using
                    'can' => 'view admin dashboard',

                ],
                [
                    'text' => 'Batches',
                    'route' => 'admin.batches',
                    'icon'  => 'fas fa-users',
                    // 'can'   => \App\Constants\Permissions::VIEW_BATCHES,
                    'can' => 'view admin dashboard',

                ],
            ],
        ],

        [
            'text' => 'Tools',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Copy Module Offerings',
                    'route' => 'admin.module-offerings.copy',
                    'icon' => 'fas fa-copy',
                    'can' => 'view admin dashboard',
                ],
            ],
        ],
        

        // [
        //     'text' => 'multilevel',
        //     'icon' => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url' => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url' => '#',
        //                 ],
        //                 [
        //                     'text' => 'level_two',
        //                     'url' => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url' => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url' => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url' => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text' => 'important',
        //     'icon_color' => 'red',
        //     'url' => '#',
        // ],
        // [
        //     'text' => 'warning',
        //     'icon_color' => 'yellow',
        //     'url' => '#',
        // ],
        // [
        //     'text' => 'information',
        //     'icon_color' => 'cyan',
        //     'url' => '#',
        // ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        // 'Chartjs' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
        //         ],
        //     ],
        // ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];