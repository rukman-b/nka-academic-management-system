<?php

// app/Models/ExitAward.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExitAward extends Model
{
    use HasFactory,FlushesCacheByTags;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'level_id',
        'title',
        'short_code',
        'min_credits',
        'description',
    ];

    /**
     * Programmes that can offer this exit award.
     */
    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'programme_exit_award')
            ->withTimestamps()
            ->withPivot(['awarded_by_default']);
    }

    /**
     * Students who have received this exit award.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_exit_awards')
            ->withTimestamps()
            ->withPivot(['awarded_on', 'reason']);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public static function cachedOrdered()
    {
        return Cache::tags(['exit_awards'])->remember(
            'all_exit_awards_ordered_by_level',
            config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('level_id')->get()
        );
    }

    public static function cachedIds()
    {
        return Cache::tags(['exit_awards'])->remember(
            'all_exit_award_ids',
             config('nka.cacheTTL.long_term'),
            fn () => static::pluck('id')
        );
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'exit_awards';
    }
} 
