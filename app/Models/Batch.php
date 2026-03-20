<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Batch extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $fillable = [
        'programme_id',
        'config_id',
        'code',
        'start_date',
        'active',
    ];

    // Relationships
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function batchStudents()
    {
        return $this->hasMany(BatchStudent::class);
    }



    /**
     * Accessor to retrieve the department of the batch indirectly through its associated programme.
     * Allows access via $batch->department even though no direct foreign key exists in the batches table.
     * $batch->department
     */

    public function getDepartmentAttribute()
    {
        return $this->programme?->department;
    }



    public function config()
    {
        return $this->belongsTo(Config::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'batch_level_module')
                    ->withPivot(['level_id', 'start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }

    public static function cachedActiveWithProgramme()
    {
        return Cache::tags(['batch'])->remember(
            'active_batches_with_programme',
            now()->addHours(2),
            fn () => static::with('programme')
                ->where('status', config('nka.status.active'))
                ->latest()
                ->get()
        );
    }
}
