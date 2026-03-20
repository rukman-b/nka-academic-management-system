<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleSkill extends Model
{
    use HasFactory,FlushesCacheByTags;

    protected $table = 'module_skill'; // explicitly define pivot table name

    protected $fillable = [
        'module_id',
        'skill_id',
        'created_at',
        'updated_at',
    ];

    // Relationships (optional for context)
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public static function cachedWithRelations()
    {
        return Cache::tags(['module_skills'])->remember(
            'all_module_skills_with_relations',
            config('nka.cacheTTL.long_term'),
            fn () => static::with(['module', 'skill'])->get()
        );
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'module_skills';
    }
}
