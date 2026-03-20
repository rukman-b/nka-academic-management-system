<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\DashboardResolver;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(private readonly DashboardResolver $dashResolver)
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('auth:web')->only('logout');
    }

    public function showLoginForm()
    {
        return view('vendor.adminlte.auth.login');
    }

    protected function redirectTo(): string
    {

        $user = auth('web')->user();

        // Resolve role key (Spatie role name) for web dashboard mapping
        $role = $this->dashResolver->highestPriorityRole('web', $user);

        // redirectTo() must return a URL string
        return $this->dashResolver->url('web', $role);
    }
}
