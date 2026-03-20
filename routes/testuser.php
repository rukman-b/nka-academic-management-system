<?php

use App\Constants\Guards;
use App\Livewire\Testuser\Dashboard;
use Illuminate\Support\Facades\Route;


// Employer Dashboard Routes
Route::middleware([
    'auth:' . Guards::TESTUSER,
    'email.verified:' . Guards::TESTUSER,
])->prefix(Guards::TESTUSER)->as(Guards::TESTUSER.'.')->group(function () {

    // Route::get('/dashboard', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

