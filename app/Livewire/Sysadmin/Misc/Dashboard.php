<?php

namespace App\Livewire\Sysadmin\Misc;

use App\Constants\Permissions;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

// #[Layout('sysadmin.roles')]
class Dashboard extends Component
{
    public string $header_title = 'Dashboard';
    public string $subtitle = '';

    public function render()
    {
        try {

            $this->authorize(Permissions::VIEW_SYSTEM_ADMIN_DASHBOARD);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to view system admin dashboard.');
        }

        return view('livewire.sysadmin.misc.dashboard');
    }
}
