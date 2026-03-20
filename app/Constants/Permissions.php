<?php

namespace App\Constants;

/**
 * Permissions (Spatie)
 *
 * IMPORTANT:
 * - Do NOT change permission string values unless you also migrate existing DB records.
 * - Some values contain legacy typos (e.g., "assgin"). These are kept as-is for compatibility.
 *
 * This class is intentionally "constants-only" and should not be extended.
 */
final class Permissions
{
    // =====================================================================
    // SYSADMIN (System Admin)
    // =====================================================================

    /** Menu heading visibility (AdminLTE sidebar grouping) */
    public const VIEW_SYSTEM_ADMIN_MENU_HEADING = 'view sysadmin menu heading';

    /** Sysadmin dashboard access */
    public const VIEW_SYSTEM_ADMIN_DASHBOARD = 'view sysadmin dashboard';

    // Users
    public const VIEW_USERS   = 'view users';
    public const CREATE_USERS = 'create users';
    public const EDIT_USERS   = 'edit users';
    public const DELETE_USERS = 'delete users';

    // Roles
    public const VIEW_ROLES   = 'view roles';
    public const CREATE_ROLES = 'create roles';
    public const EDIT_ROLES   = 'edit roles';
    public const DELETE_ROLES = 'delete roles';

    // Permissions
    public const VIEW_PERMISSIONS   = 'view permissions';
    public const CREATE_PERMISSIONS = 'create permissions';
    public const EDIT_PERMISSIONS   = 'edit permissions';
    public const DELETE_PERMISSIONS = 'delete permissions';

    // =====================================================================
    // NKA STAFF (Academic/Admin back-office)
    // =====================================================================

    // Dashboard
    public const VIEW_ADMIN_DASHBOARD = 'view admin dashboard';

    // Departments
    public const VIEW_DEPARTMENTS   = 'view departments';
    public const CREATE_DEPARTMENTS = 'create departments';
    public const EDIT_DEPARTMENTS   = 'edit departments';
    public const DELETE_DEPARTMENTS = 'delete departments';

    // Programmes
    public const VIEW_PROGRAMMES                 = 'view programmes';
    public const CREATE_PROGRAMMES               = 'create programmes';
    public const EDIT_PROGRAMMES                 = 'edit programmes';
    public const DELETE_PROGRAMMES               = 'delete programmes';
    public const VIEW_STUDENTS_IN_PROGRAMMES     = 'view students in programmes';
    public const ASSIGN_STUDENTS_TO_PROGRAMMES   = 'assign students to programmes';
    public const REMOVE_STUDENTS_FROM_PROGRAMMES = 'remove students from programmes';

    // Levels
    public const VIEW_LEVELS             = 'view levels';
    public const CREATE_LEVELS           = 'create levels';
    public const EDIT_LEVELS             = 'edit levels';
    public const DELETE_LEVELS           = 'delete levels';
    public const VIEW_STUDENTS_IN_LEVELS = 'view students in levels';

    /**
     * Legacy value contains a typo ("assgin") — keep as-is.
     */
    public const ASSIGN_STUDENTS_TO_LEVELS   = 'assgin students to levels';
    public const REMOVE_STUDENTS_FROM_LEVELS = 'remove students from levels';

    // Modules
    public const VIEW_MODULES   = 'view modules';
    public const CREATE_MODULES = 'create modules';
    public const EDIT_MODULES   = 'edit modules';
    public const DELETE_MODULES = 'delete modules';

    public const VIEW_STUDENTS_IN_MODULES = 'view students in modules';

    /**
     * Legacy value contains a typo ("assgin") — keep as-is.
     */
    public const ASSIGN_STUDENTS_TO_MODULES   = 'assgin students to modules';
    public const REMOVE_STUDENTS_FROM_MODULES = 'remove students from modules';

    // Module assignment (batch-level)
    public const ASSIGN_MODULES_TO_BATCHES = 'assign modules to batches';

    // Batches
    public const VIEW_BATCHES   = 'view batches';
    public const CREATE_BATCHES = 'create batches';
    public const EDIT_BATCHES   = 'edit batches';
    public const DELETE_BATCHES = 'delete batches';

    // Practicals
    public const VIEW_PRACTICALS   = 'view practicals';
    public const CREATE_PRACTICALS = 'create practicals';
    public const EDIT_PRACTICALS   = 'edit practicals';
    public const DELETE_PRACTICALS = 'delete practicals';

    // Theories
    public const VIEW_THEORIES   = 'view theories';
    public const CREATE_THEORIES = 'create theories';
    public const EDIT_THEORIES   = 'edit theories';
    public const DELETE_THEORIES = 'delete theories';

    // Skills
    public const VIEW_SKILLS   = 'view skills';
    public const CREATE_SKILLS = 'create skills';
    public const EDIT_SKILLS   = 'edit skills';
    public const DELETE_SKILLS = 'delete skills';

    // Skill Categories
    public const VIEW_SKILLCATEGORIES   = 'view skillcategories';
    public const CREATE_SKILLCATEGORIES = 'create skillcategories';
    public const EDIT_SKILLCATEGORIES   = 'edit skillcategories';
    public const DELETE_SKILLCATEGORIES = 'delete skillcategories';

    // Students (management)
    public const VIEW_STUDENTS = 'view students';

    // Configs
    public const VIEW_CONFIGS   = 'view configs';
    public const MANAGE_CONFIGS = 'manage configs';

    // =====================================================================
    // MENU HEADINGS (visibility control)
    // =====================================================================

    public const VIEW_SUPER_ADMIN_MENU_HEADING = 'view superadmin menu heading';

    /**
     * Note: current value is "view admin menu" (not "...heading").
     * Keep as-is to avoid breaking existing assignments.
     */
    public const VIEW_ADMIN_MENU_HEADING = 'view admin menu';

    // =====================================================================
    // Future permissions (kept as comments for now)
    // =====================================================================
    // Keep these commented items if you still want them as a roadmap.
}
