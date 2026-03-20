<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Support\Facades\Cache;

class ModuleTheory extends Model
{
     use FlushesCacheByTags;

    protected $table = 'module_theory';

    protected $fillable = [
        'module_id',
        'theory_id',
        'teaching_notes',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function theory()
    {
        return $this->belongsTo(Theory::class);
    }

    public static function cachedAllWithRelations()
    {
        return Cache::tags(['module_theories'])->remember(
            'all_module_theories_with_relations',
            config('nka.cacheTTL.long_term'),
            fn () => static::with(['module', 'theory'])->get()
        );
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'module_theories';
    }
}
