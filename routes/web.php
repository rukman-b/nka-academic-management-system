<?php

use App\Livewire\Admin\Modules\ModuleManager;
use Illuminate\Support\Facades\Route;



Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

