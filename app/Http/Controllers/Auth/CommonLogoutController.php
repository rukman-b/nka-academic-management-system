<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Guards;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// Services
use App\Services\Auth\GuardLogoutService;

class CommonLogoutController extends Controller
{
    public function __invoke()
    {
        
        $loggedOutGuard = GuardLogoutService::logoutAnyAuthenticatedGuard();

        if ($loggedOutGuard) {

            if ($loggedOutGuard !== Guards::WEB) {
                return redirect()->route("{$loggedOutGuard}.login");
            }

            return redirect()->route('login');
        }

        return redirect()->route('portal.hub');
    }
}
