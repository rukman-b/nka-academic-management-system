<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\FlushesCacheByTags;

class SkillCategory extends Model
{

    use HasFactory,FlushesCacheByTags;

    protected $fillable = ['name'];

    public function skills()
    {
        return $this->hasMany(\App\Models\Skill::class);
    }

    public static function cachedOrdered()
    {
        return Cache::tags(['skill_categories'])->remember(
            'all_skill_categories_ordered',
           config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('name')->get()
        );
    }


    public static function getCacheTagsToFlush(): string
    {
        return 'skill_category';
    }
}
