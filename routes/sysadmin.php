<?php

use App\Constants\Guards;
use App\Constants\Roles;
use App\Livewire\Sysadmin\Spatie\PermissionIndex;
use App\Livewire\Sysadmin\Spatie\RoleForm;
use App\Livewire\Sysadmin\Spatie\RoleIndex;
use App\Livewire\Sysadmin\Spatie\UserForm;
use App\Livewire\Sysadmin\Spatie\UserIndex;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:'. Guards::WEB, 'email.verified:'. Guards::WEB, 'role:'. Roles::SYSTEM_ADMIN]) // Apply authentication
    ->prefix('sysadmin')        // URL prefix: /admin/...
    ->as('sysadmin.')           // Name prefix: admin.***
    ->group(function () {


        // Sysadmin Dashboard Route
        Route::get('/dashboard', \App\Livewire\Sysadmin\Misc\Dashboard::class)->name('dashboard');
 
        // Users Management
        Route::get('users', UserIndex::class)->name('users');
        Route::get('users/create', UserForm::class)->name('users.create');
        Route::put('users/{user}/edit', UserForm::class)->name('users.edit'); // <- GET instead of PUT for showing the form
        // Route::get('users/{user}/edit', UserForm::class)->name('users.edit'); // <- GET instead of PUT for showing the form

        // Roles Management
        Route::get('roles', RoleIndex::class)->name('roles');
        Route::get('roles/create', RoleForm::class)->name('roles.create');
        Route::get('roles/{role}/edit', RoleForm::class)->name('roles.edit');

        // Permissions Management
        Route::get('permissions', PermissionIndex::class)->name('permissions');

        Route::get('users/{user}/permissions', \App\Livewire\Sysadmin\Spatie\UserPermissionsForm::class)
        ->name('users.permissions');
    });

