<?php

namespace App\Livewire\Shared;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhotoUploader extends Component
{
    use WithFileUploads;

    public $photo;
    public string $guard = 'web';

    public function mount()
    {
        $guardResolver = app(\App\Services\Auth\GuardResolver::class);
        $this->guard = $guardResolver->detect();
    }

    public function photoUpload()
    {
        $this->validate([
            'photo' => [
                'required',
                File::image()->max(1024), // Max 1MB
            ],
        ]);

        $user = Auth::guard($this->guard)->user();

        // Optional: delete old image
        if ($user->image_path && Storage::disk('public')->exists($user->image_path)) {
            Storage::disk('public')->delete($user->image_path);
        }

        // Save new photo
        $path = $this->photo->store('avatars', 'public');

        $user->image_path = $path;
        $user->save();

        session()->flash('success', 'Profile photo updated!');
    }

    public function render()
    {
        return view('livewire.shared.profile-photo-uploader');
    }
}
