<?php

use App\Constants\Guards;

use Illuminate\Support\Facades\Route;
use App\Livewire\Shared\ChangePasswordForm;
use App\Livewire\Shared\UserProfile;





// Route::middleware(['multiguard'])->group(function () {
//     Route::get('/change-password', ChangePasswordForm::class)->name('change-password');
//     Route::get('/profile', UserProfile::class)->name('profile');

// });

Route::middleware([
    'web',
    'auth:' . implode(',', Guards::session()), // which returns auth:web,student,...
    'email.verified:' . implode(',', Guards::session()),
])->group(function () {
    Route::get('/change-password', ChangePasswordForm::class)->name('change-password');
    Route::get('/profile', UserProfile::class)->name('profile');
});
