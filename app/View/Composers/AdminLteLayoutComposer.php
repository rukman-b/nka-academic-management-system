<?php

namespace App\View\Composers;

use Illuminate\View\View;

final class AdminLteLayoutComposer
{
    public function compose(View $view): void
    {
        $guard = nka_active_session_guard();

        $skinEntry = config(
            'nka.ui.skins.' . ($guard ?? 'web'),
            null
        );

        $view->with('adminlteSkinEntry', $skinEntry);
    }
}
