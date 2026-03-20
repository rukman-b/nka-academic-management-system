<?php

namespace Database\Seeders;

use App\Constants\Guards;
use App\Constants\Permissions;
use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $systemAdminPermissions = [
            Permissions::VIEW_SYSTEM_ADMIN_MENU_HEADING,
            Permissions::VIEW_SYSTEM_ADMIN_DASHBOARD,

            Permissions::VIEW_USERS,
            Permissions::CREATE_USERS,
            Permissions::EDIT_USERS,
            Permissions::DELETE_USERS,

            Permissions::VIEW_ROLES,
            Permissions::CREATE_ROLES,
            Permissions::EDIT_ROLES,
            Permissions::DELETE_ROLES,

            Permissions::VIEW_PERMISSIONS,
            Permissions::CREATE_PERMISSIONS,
            Permissions::EDIT_PERMISSIONS,
            Permissions::DELETE_PERMISSIONS,
        ];

        $superAdminPermissions = [
            Permissions::VIEW_SUPER_ADMIN_MENU_HEADING,
            Permissions::VIEW_ADMIN_DASHBOARD,

            Permissions::VIEW_DEPARTMENTS,
            Permissions::CREATE_DEPARTMENTS,
            Permissions::EDIT_DEPARTMENTS,
            Permissions::DELETE_DEPARTMENTS,

            Permissions::VIEW_PROGRAMMES,
            Permissions::CREATE_PROGRAMMES,
            Permissions::EDIT_PROGRAMMES,
            Permissions::DELETE_PROGRAMMES,
            Permissions::VIEW_STUDENTS_IN_PROGRAMMES,
            Permissions::ASSIGN_STUDENTS_TO_PROGRAMMES,
            Permissions::REMOVE_STUDENTS_FROM_PROGRAMMES,

            Permissions::VIEW_LEVELS,
            Permissions::CREATE_LEVELS,
            Permissions::EDIT_LEVELS,
            Permissions::DELETE_LEVELS,
            Permissions::VIEW_STUDENTS_IN_LEVELS,
            Permissions::ASSIGN_STUDENTS_TO_LEVELS,
            Permissions::REMOVE_STUDENTS_FROM_LEVELS,

            Permissions::VIEW_MODULES,
            Permissions::CREATE_MODULES,
            Permissions::EDIT_MODULES,
            Permissions::DELETE_MODULES,

            Permissions::ASSIGN_MODULES_TO_BATCHES,

            Permissions::VIEW_BATCHES,
            Permissions::CREATE_BATCHES,
            Permissions::EDIT_BATCHES,
            Permissions::DELETE_BATCHES,

            Permissions::VIEW_PRACTICALS,
            Permissions::CREATE_PRACTICALS,
            Permissions::EDIT_PRACTICALS,
            Permissions::DELETE_PRACTICALS,

            Permissions::VIEW_THEORIES,
            Permissions::CREATE_THEORIES,
            Permissions::EDIT_THEORIES,
            Permissions::DELETE_THEORIES,

            Permissions::VIEW_SKILLS,
            Permissions::CREATE_SKILLS,
            Permissions::EDIT_SKILLS,
            Permissions::DELETE_SKILLS,

            Permissions::VIEW_SKILLCATEGORIES,
            Permissions::CREATE_SKILLCATEGORIES,
            Permissions::EDIT_SKILLCATEGORIES,
            Permissions::DELETE_SKILLCATEGORIES,

            Permissions::VIEW_CONFIGS,
            Permissions::MANAGE_CONFIGS,
        ];

        $adminPermissions = [
            Permissions::VIEW_ADMIN_MENU_HEADING,
        ];

        $allPermissions = array_values(array_unique([
            ...$systemAdminPermissions,
            ...$superAdminPermissions,
            ...$adminPermissions,
        ]));

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => Guards::WEB,
            ]);
        }

        $roles = [
            Roles::SYSTEM_ADMIN => $systemAdminPermissions,
            Roles::SUPER_ADMIN => $superAdminPermissions,
            Roles::ADMIN => $adminPermissions,
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => Guards::WEB,
            ]);

            $role->syncPermissions($permissions);
        }
    }
}