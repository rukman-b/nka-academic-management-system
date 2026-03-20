<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache; 

class Department extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $fillable = [
        'name',
        'description'
    ];

    // Relationships
    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_department')->withTimestamps();
    }

    public function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function practicals()
    {
        return $this->hasMany(Practical::class);
    }

    public static function cachedList()
    {
        return Cache::tags(['department'])->remember(
            'departments_ordered_by_name',
            config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('name')->get()
        );
    }
}
