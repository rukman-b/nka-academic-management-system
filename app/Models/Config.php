<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Trait
use App\Traits\FlushesCacheByTags;


class Config extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $fillable = [
        'programme_id',
        'code',
        'description',
        'pass_marks',
        'status',
    ];

    // Relationships
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    } 

    public static function cachedByProgramme(?int $programmeId)
    {
        return Cache::tags(['config'])->remember(
            "configs_for_programme_{$programmeId}",
            config('nka.cacheTTL.long_term'),
            fn () => static::where('programme_id', $programmeId)->get()
        );
    }

    // public function deliveryType() {
    //     return $this->belongsTo(DeliveryType::class);
    // }

    // public function experienceType() {
    //     return $this->belongsTo(ExperienceType::class)->withDefault([
    //         'code' => '—',
    //     ]);
    // }

}
