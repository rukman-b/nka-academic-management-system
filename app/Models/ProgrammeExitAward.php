<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammeExitAward extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $fillable = [
        'programme_id',
        'exit_award_id',
        'default_award', 
    ];

    //  Define relationship to Programme
    public function programme()
    {
        return $this->belongsTo(Programme::class); 
    }

    // Define relationship to Level
    // public function level()
    // {
    //     return $this->belongsTo(Level::class);
    // }

    public function exitAward()
    {
        return $this->belongsTo(ExitAward::class);
    }

    public function studentExitAwards()
    {
        return $this->belongToMany(StudentExitAward::class);
    }

    public static function cachedExitAwardIdsByProgramme(int $programmeId)
    {
        return Cache::tags(['programme_exit_awards'])->remember(
            "exit_awards_for_programme_{$programmeId}",
            config('nka.cacheTTL.long_term'),
            fn () => static::where('programme_id', $programmeId)
                ->pluck('exit_award_id')
        );
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'programme_exit_awards';
    }
}
