<?php

use App\Constants\Guards;

use Illuminate\Support\Facades\Route;
use App\Livewire\Shared\ChangePasswordForm;
use App\Livewire\Shared\UserProfile;
use Illuminate\Http\Request;


Route::middleware([
    'web',
    'auth:' . implode(',', Guards::session()), // which returns auth:web,student,...
    'email.verified:' . implode(',', Guards::session()),
])->group(function () {
    Route::get('/change-password', ChangePasswordForm::class)->name('change-password');
    Route::get('/profile', UserProfile::class)->name('profile');
    Route::post('/notifications/mark-all-read', function (Request $request) {
        $request->user()?->unreadNotifications->markAsRead();

        return back();
    })->name('notifications.markAllRead');
});
