<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//Traits
use App\Traits\FlushesCacheByTags;

class ModulePractical extends Model
{
    use FlushesCacheByTags;

    protected $table = 'module_practical';

    protected $fillable = [
        'module_id',
        'practical_id',
        'lab_room',
        'instructor_notes',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function practical(): BelongsTo
    { 
        return $this->belongsTo(Practical::class);
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'module_practicals';
    }
}
