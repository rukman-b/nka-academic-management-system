<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\TestuserResetPasswordNotification;



//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AdminLteUserInterface;


class Testuser extends Authenticatable implements CanResetPassword,MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, CanResetPasswordTrait, AdminLteUserInterface;


    protected $fillable = ['name', 'email', 'phone', 'password'];

    // public function programme()
    // {
    //     return $this->belongsTo(Programme::class);
    // }


    protected function getGuardName(): string
    {
        return 'testusr';
    }

    // public function address()
    // {
    //     return $this->morphOne(Address::class, 'addressable');
    // }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->image_path && Storage::disk('public')->exists($this->image_path)
            ? asset('storage/' . $this->image_path)
            : asset('images/default-avatar.png');
    }

    public static function cachedOrdered()
    {
        return Cache::tags(['testusr'])->remember(
            'all_testusrs_ordered_by_name',
            config('nka.cacheTTL.short_term'),
            fn () => static::orderBy('name')->get()
        );
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TestuserResetPasswordNotification($token));
    }

    public function authGuardName(): string { return 'testuser'; }


}
