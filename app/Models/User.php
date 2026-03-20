<?php

namespace App\Models;

use App\Constants\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;


//Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\AdminLteUserInterface;

//Reset Password
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class User extends Authenticatable implements CanResetPassword,MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, CanResetPasswordTrait, AdminLteUserInterface;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    
    public function getProfileImageUrlAttribute(): string
    {
        return $this->image_path && Storage::disk('public')->exists($this->image_path)
            ? asset('storage/' . $this->image_path)
            : asset('images/default-avatar.png');
    }

    public function authGuardName(): string { return 'web'; }


    // public function getPrimaryRoleName(): ?string
    // {
    //     return $this->roles->first()?->name;
    // }


    // public function adminlte_profile_url()
    // {
    //     return route('profile'); 
    // }

    // public function adminlte_image()
    // {
    //     return asset($this->getProfileImageUrlAttribute()); 
    // }

    // public function adminlte_desc()
    // {
    //     return ucfirst(Roles::label($this->getPrimaryRoleName()) ?? 'User');
    // }
    
}
