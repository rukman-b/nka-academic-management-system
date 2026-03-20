<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\EmployerResetPasswordNotification;



//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AdminLteUserInterface;


class Employer extends Authenticatable implements CanResetPassword,MustVerifyEmail
{
    use HasFactory,FlushesCacheByTags, Notifiable,AdminLteUserInterface;

    protected $fillable = ['name', 'email', 'phone', 'password'];


    public function getProfileImageUrlAttribute(): string
    {
        return $this->image_path && Storage::disk('public')->exists($this->image_path)
            ? asset('storage/' . $this->image_path)
            : asset('images/default-avatar.png');
    }

    public static function cachedOrdered()
    {
        return Cache::tags(['employer'])->remember(
            'all_employers_ordered_by_name',
            config('nka.cacheTTL.short_term'),
            fn () => static::orderBy('name')->get()
        );
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmployerResetPasswordNotification($token));
    }

    public function authGuardName(): string { return 'employer'; }



}
