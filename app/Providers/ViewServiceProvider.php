<?php

namespace App\Providers;

use App\View\Composers\ErrorViewComposer;
use App\View\Composers\AdminLteLayoutComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Apply to all error pages you use
        View::composer(['errors::*','errors.*'], ErrorViewComposer::class);
        View::composer('components.layouts.app', AdminLteLayoutComposer::class);

    }
}
