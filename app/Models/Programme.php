<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\FlushesCacheByTags;
use Illuminate\Support\Facades\Cache;

class Programme extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $fillable = [
        'name',
        'short_name',
        'department_id',
        'starting_level_id',
        'offered_level_id'
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class); 
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_programme')->withTimestamps();
    }

    public function configs()
    {
        return $this->hasMany(Config::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public static function cachedList()
    {
        return Cache::tags(['programme'])->remember(
            'programme_ordered_by_name',
            config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('name')->get()
        );
    }

    // public static function cachedByDepartment(?int $departmentId)
    // {
    //     return Cache::tags(['programme'])->remember(
    //         "programmes_for_department_{$departmentId}",
    //         config('nka.cacheTTL.long_term'),
    //         fn () => static::where('department_id', $departmentId)->get()
    //     );
    // }

    public static function cachedByDepartment(?int $departmentId)
    {
        return Cache::tags(['programme'])
            ->remember(
                "programmes_for_department_{$departmentId}",
                config('nka.cacheTTL.long_term'),
                fn () => static::where('department_id', $departmentId)
                              ->orderBy('name')
                              ->get()
            );
    }



    // public static function getCacheFlushKeyword(): string|array
    // {
    //     return ['department','level']; // Your exact cache key prefix
    // }
}
