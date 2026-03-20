<?php

namespace App\Livewire\Shared;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordForm extends Component
{
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public string $guard = 'web'; // Will be updated dynamically

    public function mount()
    {
        $guardResolver = app(\App\Services\Auth\GuardResolver::class);
        $this->guard = $guardResolver->detect();;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'current_password:' . $this->guard],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    public function changePassword()
    {
        $this->validate();

        $user = Auth::guard($this->guard)->user();
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('success', 'Password updated successfully!');
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function render()
    {
        return view('livewire.shared.change-password-form');
    }
}
