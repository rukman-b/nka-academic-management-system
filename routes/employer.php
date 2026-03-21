<?php

use App\Constants\Guards;
use App\Livewire\Employer\Dashboard;
use Illuminate\Support\Facades\Route;


// Employer Dashboard Routes
Route::middleware([
    'auth:' . Guards::EMPLOYER,
    'email.verified:' . Guards::EMPLOYER,
])->prefix(Guards::EMPLOYER)->as(Guards::EMPLOYER.'.')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

