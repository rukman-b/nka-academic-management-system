<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Traits
use App\Traits\FlushesCacheByTags;


class Semester extends Model
{
    use FlushesCacheByTags;
    protected $fillable = ['name', 'start_date','academic_year', 'end_date'];

    // Automatically convert start_date and end_date to Carbon instances for date manipulation
    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class)->withTimestamps(); 
    }

    public static function cachedStandardSemesters()
    {
        return Cache::tags(['semester'])->remember(
            'standard_semesters',
            config('nka.cacheTTL.long_term'), // or addWeeks(4)
            function () {
                return Semester::whereIn('name', ['Semester 1', 'Semester 2', 'Full Year'])
                    ->orderBy('start_date')
                    ->get();
            }
        );
    }

    // public function modules()
    // {
    //     return $this->belongsToMany(Module::class, 'module_semester');
    // }

}
