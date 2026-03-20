<?php

use App\Constants\Guards;
use App\Constants\Roles;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:' . Guards::WEB ,'role:'. Roles::SYSTEM_ADMIN .'|'. Roles::ADMIN . '|' . Roles::SUPER_ADMIN])->prefix('admin') ->as('admin.')->group(function () {



});