<?php

namespace Database\Seeders;

use App\Constants\Guards;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Constants\Permissions;
use App\Constants\Roles;

class RolePermissionSeeder extends Seeder 
{
    public function run(): void
    {
        // Clear cached roles/permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // All permissions (add or remove based on your system)
        $permissions = [
            ############################ ALL SPATIE PERMISSIONS #########################################
            #############################################################################################


            ////////////////////////////////////// System Admin ////////////////////////////////////////
            //Basic permissions
            Permissions::VIEW_SYSTEM_ADMIN_MENU_HEADING,
            Permissions::VIEW_SYSTEM_ADMIN_DASHBOARD,


            //Permissions on users
            Permissions::VIEW_USERS,
            Permissions::CREATE_USERS,
            Permissions::EDIT_USERS,
            Permissions::DELETE_USERS,

            //Permissions on roles
            Permissions::VIEW_ROLES,
            Permissions::CREATE_ROLES,
            Permissions::EDIT_ROLES,
            Permissions::DELETE_ROLES,

            //Permisssions on permissions
            Permissions::VIEW_PERMISSIONS,
            Permissions::CREATE_PERMISSIONS,
            Permissions::EDIT_PERMISSIONS,
            Permissions::DELETE_PERMISSIONS,


            ////////////////////////////////////// Super Admin ////////////////////////////////////////

            //Basic
            Permissions::VIEW_SUPER_ADMIN_MENU_HEADING,
            Permissions::VIEW_ADMIN_DASHBOARD,

            //Departments
            Permissions::VIEW_DEPARTMENTS,
            Permissions::CREATE_DEPARTMENTS,
            Permissions::EDIT_DEPARTMENTS,
            Permissions::DELETE_DEPARTMENTS,


            //Programmes
            Permissions::VIEW_PROGRAMMES,
            Permissions::CREATE_PROGRAMMES,
            Permissions::EDIT_PROGRAMMES,
            Permissions::DELETE_PROGRAMMES,
            Permissions::VIEW_STUDENTS_IN_PROGRAMMES,
            Permissions::ASSIGN_STUDENTS_TO_PROGRAMMES,
            Permissions::REMOVE_STUDENTS_FROM_PROGRAMMES,

            //Levels
            Permissions::VIEW_LEVELS,
            Permissions::CREATE_LEVELS,
            Permissions::EDIT_LEVELS,
            Permissions::DELETE_LEVELS,
            Permissions::VIEW_STUDENTS_IN_LEVELS,
            Permissions::ASSIGN_STUDENTS_TO_LEVELS,
            Permissions::REMOVE_STUDENTS_FROM_LEVELS,

            //Modules
            Permissions::VIEW_MODULES,
            Permissions::CREATE_MODULES,
            Permissions::EDIT_MODULES,
            Permissions::DELETE_MODULES,

            //Module_level_batch
            Permissions::ASSIGN_MODULES_TO_BATCHES,

            //Batches
            Permissions::VIEW_BATCHES,
            Permissions::CREATE_BATCHES,
            Permissions::EDIT_BATCHES,
            Permissions::DELETE_BATCHES,

            //Practicals
            Permissions::VIEW_PRACTICALS,
            Permissions::CREATE_PRACTICALS,
            Permissions::EDIT_PRACTICALS,
            Permissions::DELETE_PRACTICALS,


            //Theories
            Permissions::VIEW_THEORIES,
            Permissions::CREATE_THEORIES,
            Permissions::EDIT_THEORIES,
            Permissions::DELETE_THEORIES,

            //Skills
            Permissions::VIEW_SKILLS,
            Permissions::CREATE_SKILLS,
            Permissions::EDIT_SKILLS,
            Permissions::DELETE_SKILLS,

            //SkillCategories
            Permissions::VIEW_SKILLCATEGORIES,
            Permissions::CREATE_SKILLCATEGORIES,
            Permissions::EDIT_SKILLCATEGORIES,
            Permissions::DELETE_SKILLCATEGORIES,

            //Config
            Permissions::VIEW_CONFIGS,
            Permissions::MANAGE_CONFIGS,

           
            ////////////////////////////////////// Admin ////////////////////////////////////////
            Permissions::VIEW_ADMIN_MENU_HEADING,


            // Permissions::ASSIGN_SKILLS_TO_MODULES,
            // Permissions::ASSIGN_SKILLS_TO_CATEGORIES,
            // Permissions::ACCESS_DASHBOARD,
            // Permissions::ACCESS_STUDENT_DASHBOARD,
            // Permissions::ACCESS_EMPLOYER_DASHBOARD,
            // Permissions::VIEW_ALERTS,
            // Permissions::SEND_ALERTS_TO_STUDENTS,
            // Permissions::SEND_ALERTS_TO_EMPLOYERS,
        ];

        // Create all permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => Guards::WEB]);
        }

        // Assign permissions to roles
        $roles = [
            // Roles::SYSTEM_ADMIN => $permissions,
            Roles::SYSTEM_ADMIN => [

                //Basic permissions
                Permissions::VIEW_SYSTEM_ADMIN_MENU_HEADING,
                Permissions::VIEW_SYSTEM_ADMIN_DASHBOARD,


                //Permissions on users
                Permissions::VIEW_USERS,
                Permissions::CREATE_USERS,
                Permissions::EDIT_USERS,
                Permissions::DELETE_USERS,

                //Permissions on roles
                Permissions::VIEW_ROLES,
                Permissions::CREATE_ROLES,
                Permissions::EDIT_ROLES,
                Permissions::DELETE_ROLES,

                //Permisssions on permissions
                Permissions::VIEW_PERMISSIONS,
                Permissions::CREATE_PERMISSIONS,
                Permissions::EDIT_PERMISSIONS,
                Permissions::DELETE_PERMISSIONS,

            ],

            Roles::SUPER_ADMIN => [
                Permissions::VIEW_SUPER_ADMIN_MENU_HEADING,

                Permissions::VIEW_ADMIN_DASHBOARD,
                Permissions::VIEW_PROGRAMMES,

                Permissions::VIEW_DEPARTMENTS,
                Permissions::CREATE_DEPARTMENTS,
                Permissions::EDIT_DEPARTMENTS,
                Permissions::DELETE_DEPARTMENTS,

                
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



            ],

            Roles::ADMIN => [
                Permissions::VIEW_ADMIN_MENU_HEADING,
                // Permissions::MANAGE_EMPLOYERS,
                // Permissions::ACCESS_DASHBOARD,
            ],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => Guards::WEB]);
            $role->syncPermissions($perms);
        }
    }
}
