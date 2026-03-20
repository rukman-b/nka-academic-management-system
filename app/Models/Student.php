<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;

// use the correct trait
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;




//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable; 
// use App\Traits\SendsCustomPasswordResetNotification;
use App\Traits\AdminLteUserInterface;
use App\Notifications\StudentResetPasswordNotification;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;



class Student extends Authenticatable implements CanResetPassword,MustVerifyEmail
{
    // use HasFactory,FlushesCacheByTags, Notifiable,SendsCustomPasswordResetNotification,AdminLteUserInterface;
    use HasFactory,FlushesCacheByTags, Notifiable,AdminLteUserInterface, CanResetPasswordTrait, MustVerifyEmailTrait;

    protected $fillable = ['name', 'email', 'phone', 'dob', 'password'];

    // public function programme()
    // {
    //     return $this->belongsTo(Programme::class);
    // }


    public function batches()
    {
        return $this->belongsToMany(Batch::class)->withPivot('status')->withTimestamps();
    }

    public function activeBatch()
    {
        return $this->batches()->wherePivot('status', 'active');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    // Add this method in Student model
    public function activeBatchAssignment()
    {
        return $this->hasOne(BatchStudent::class)
            ->where('status', 'active')
            ->with('batch.programme'); // preload batch + programme if needed
    }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->image_path && Storage::disk('public')->exists($this->image_path)
            ? asset('storage/' . $this->image_path)
            : asset('images/default-avatar.png');
    }

    public static function cachedOrdered()
    {
        return Cache::tags(['student'])->remember(
            'all_students_ordered_by_name',
            config('nka.cacheTTL.short_term'),
            fn () => static::orderBy('name')->get()
        );
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPasswordNotification($token));
    }

    public function authGuardName(): string { return 'student'; }


}
