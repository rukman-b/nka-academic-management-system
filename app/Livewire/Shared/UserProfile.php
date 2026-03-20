<?php

namespace App\Livewire\Shared;

use App\Services\Auth\GuardResolver;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{
    public string $name = '';
    public string $email = '';
    public string $profile_image_url = '';
    public string $guard = 'web';

    public function mount(GuardResolver $guardResolver): void
    {
        ['guard' => $guard, 'user' => $user] = $guardResolver->identity();

        // If unauthenticated, keep guard default and leave fields empty (or redirect if you prefer)
        $this->guard = $guard ?? $this->guard;

        $this->name = $user?->name ?? '';
        $this->email = $user?->email ?? '';
        $this->profile_image_url = $user?->profile_image_url
            ?? asset('images/default-avatar.png');
    }

    public function updateProfile(): void
    {
        $user = Auth::guard($this->guard)->user();

        if (! $user) {
            // If someone hits the action after session expiry
            $this->addError('auth', 'Your session has expired. Please sign in again.');
            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.shared.user-profile');
    }
}
