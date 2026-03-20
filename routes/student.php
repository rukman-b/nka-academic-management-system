<?php

use App\Constants\Guards;
use Illuminate\Support\Facades\Route;
use App\Livewire\Student\Dashboard;

//Student login

// Student Dashboard Routes
Route::middleware([
    'auth:' . Guards::STUDENT,
    'email.verified:' . Guards::STUDENT,
    ])->prefix('student')->as('student.')->group(function () {

    // Route::get('/dashboard', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

