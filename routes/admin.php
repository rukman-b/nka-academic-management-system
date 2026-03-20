<?php

use App\Constants\Guards;
use App\Constants\Permissions;
use App\Constants\Roles;
use App\Exports\BatchAssignmentsExport;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Programmes\ProgrammeManager;
use App\Livewire\Admin\Departments\DepartmentManager;
use App\Livewire\Admin\Levels\LevelManager;
use App\Livewire\Admin\Modules\ModuleManager;
use App\Livewire\Admin\Skills\SkillManager;
use App\Livewire\Admin\SkillCategories\SkillCategoryManager;
use App\Livewire\Admin\Batches\BatchManager;
use App\Livewire\Admin\Configs\ConfigManager;
use App\Livewire\Admin\Practicals\PracticalManager;
use App\Livewire\Admin\Theories\TheoryManager;
use App\Livewire\Admin\Students\StudentManager;
use App\Livewire\Admin\ProgrammeExitAwards\ProgrammeExitAwardManager;
use App\Livewire\Admin\StudentExitAwards\StudentExitAwardManager;
use App\Livewire\Admin\PracticalModuleAssignments\PracticalModuleAssigner;
use App\Livewire\Admin\ModuleSkillAssignments\ModuleSkillAssigner;
use App\Livewire\Admin\ModuleSemesterAssignments\ModuleSemesterAssigner;
use App\Livewire\Admin\AcademicTools\CopyModuleOfferings;
use App\Livewire\Admin\Semesters\SemesterManager;
use App\Livewire\Admin\ModuleTheoryAssignments\ModuleTheoryAssigner;
use App\Livewire\Admin\ConfigModuleAssignments\ConfigModuleManager;
use App\Livewire\Admin\BatchStudentsAssignments\BatchStudentAssigner;
use App\Livewire\Admin\Exitawards\ExitAwardManager;






//Download
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Exports\DepartmentsExport;
use App\Exports\ProgrammesExport;
use App\Exports\LevelsExport;
use App\Exports\ModulesExport;
use App\Exports\ConfigsExport;
use App\Exports\BatchesExport;
use App\Exports\ConfigLevelModulesExport;
use App\Exports\ModulePracticalsExport;
use App\Exports\ModuleSkillsExport;
use App\Exports\ModuleTheoriesExport;
use App\Exports\PracticalsExport;
use App\Exports\SkillCategoriesExport;
use App\Exports\SkillsExport;
use App\Exports\TheoriesExport;
use App\Exports\ConfigModuleExport;
use App\Exports\SemesterExport;
use App\Exports\ModuleSemesterExport;


Route::middleware([
     'auth:' . Guards::WEB,
    'email.verified:'. Guards::WEB,
    'role:' . Roles::ADMIN . '|' . Roles::SUPER_ADMIN,
    ])->prefix('admin') ->as('admin.')->group(function () {

        Route::get('/dashboard', \App\Livewire\Admin\Misc\DashboardManager::class)->name('dashboard');
    });


Route::middleware([
    'auth:' . Guards::WEB,
    'verified:verification.notice', // pass the correct route name here. This has been configure in (D:\BCS\Project\nka-hub\vendor\laravel\framework\src\Illuminate\Auth\Middleware\EnsureEmailIsVerified.php). Line 38
    'role:' . Roles::ADMIN . '|' . Roles::SUPER_ADMIN,
])->prefix('admin') ->as('admin.')->group(function () {


    Route::get('/programmes', ProgrammeManager::class)->name('programmes');

    Route::get('/departments', DepartmentManager::class)->name('departments');

    Route::get('/levels', LevelManager::class)->name('levels');

    Route::get('/modules', ModuleManager::class)->name('modules');

    Route::get('/skills', SkillManager::class)->name('skills');

    Route::get('/skill-categories', SkillCategoryManager::class) ->name('skillcategories');

    Route::get('/configs', ConfigManager::class)->name('configs');

    Route::get('/batches', BatchManager::class)->name('batches');

    Route::get('/practicals', PracticalManager::class)->name('practicals');
    
    Route::get('/theories', TheoryManager::class)->name('theories');

    Route::get('/students', StudentManager::class)->name('students');

    Route::get('/programme-exit-awards', ProgrammeExitAwardManager::class)->name('programme-exit-awards');
    
    Route::get('/student-exit-awards', StudentExitAwardManager::class)->name('student-exit-awards');

    Route::get('/practical-module-assignments', PracticalModuleAssigner::class)->name('practical-module-assignments');

    Route::get('/module-theory-assignments', ModuleTheoryAssigner::class)->name('module-theory-assignments');

    Route::get('/module-skill-assignments', ModuleSkillAssigner::class)->name('module-skill-assigner');

    Route::get('/module-semester-assign', ModuleSemesterAssigner::class)->name('module-semester-assign');

    Route::get('/copy-module-offerings', CopyModuleOfferings::class)->name('module-offerings.copy');

    Route::get('/semesters', SemesterManager::class)->name('semesters');
    
    Route::get('/config-modules', ConfigModuleManager::class)->name('config-modules.index');

    Route::get('/assign-student-batch',BatchStudentAssigner::class)->name('batch-student.assign');

    Route::get('/exit-awards', ExitAwardManager::class)->name('exit-awards');








    
    Route::get('/export/students', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'students_export');

            return Excel::download(new StudentsExport, "$filename.$format");
    })->name('export.students');

    Route::get('/export/departments', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'departments_export');

            return Excel::download(new DepartmentsExport, "$filename.$format");
    })->name('export.departments');

    Route::get('/export/programmes', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'programmes_export');

            return Excel::download(new ProgrammesExport, "$filename.$format");
    })->name('export.programmes');

    Route::get('/export/levels', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'levels_export');

            return Excel::download(new LevelsExport, "$filename.$format");
    })->name('export.levels');

    Route::get('/export/modules', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'modules_export');

            return Excel::download(new ModulesExport, "$filename.$format");
    })->name('export.modules');

    Route::get('/export/configs', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'config_export');

            return Excel::download(new ConfigsExport, "$filename.$format");
    })->name('export.configs');

    Route::get('/export/batches', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'batch_export');

            return Excel::download(new BatchesExport, "$filename.$format");
    })->name('export.batches');

    Route::get('/export/config_level_modules', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'config_level_modules_export');

            return Excel::download(new ConfigLevelModulesExport, "$filename.$format");
    })->name('export.config_level_modules');

    Route::get('/export/practicals', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'practicals_export');

            return Excel::download(new PracticalsExport, "$filename.$format");
    })->name('export.practicals');

    Route::get('/export/theories', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'theories_export');

            return Excel::download(new TheoriesExport, "$filename.$format");
    })->name('export.theories');

    Route::get('/export/skill-categories', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'skill_categories_export');

            return Excel::download(new SkillCategoriesExport, "$filename.$format");
    })->name('export.skill-categories');

    Route::get('/export/skills', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'skills_export');

            return Excel::download(new SkillsExport, "$filename.$format");
    })->name('export.skills');


    Route::get('/export/module-practicals', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'module_practicals_export');

            return Excel::download(new ModulePracticalsExport, "$filename.$format");
    })->name('export.module_practicals');

    Route::get('/export/module-thories', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'module_theories_export');

            return Excel::download(new ModuleTheoriesExport, "$filename.$format");
    })->name('export.module_theories');

    Route::get('/export/module-skills', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'module_skills_export');

            return Excel::download(new ModuleSkillsExport, "$filename.$format");
    })->name('export.module_skills');

    Route::get('/export/batch-assignments', function () {
            $format = request('format', 'xlsx'); // default to xlsx
            $filename = request('filename', 'batch_assignments_export');

            return Excel::download(new BatchAssignmentsExport, "$filename.$format");
    })->name('export.batch-assignments');


    Route::get('/export/config-modules', function () {
            $format = request('format', 'xlsx'); // Default export format
            $filename = request('filename', 'config_module_export'); // Default filename

            return Excel::download(new ConfigModuleExport, "$filename.$format");
     })->name('export.config-modules');
    
   Route::get('/export/semesters', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'semester_export');

            return Excel::download(new SemesterExport, "$filename.$format");
   })->name('export.semesters');

   Route::get('/export/module-semesters', function () {
            $format = request('format', 'xlsx');
            $filename = request('filename', 'module_semester_export');

            return Excel::download(new ModuleSemesterExport, "$filename.$format");
   })->name('export.module-semesters');

});
