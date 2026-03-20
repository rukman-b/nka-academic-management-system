<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\FlushesCacheByTags;
use Illuminate\Support\Facades\Cache;

class Level extends Model
{
    use HasFactory,FlushesCacheByTags;
    
    protected $fillable = ['fheq_level', 'name', 'description'];


    public function batches()
    {
        return $this->hasMany(\App\Models\Batch::class);
    }

    public static function cachedList()
    {
        return Cache::tags(['level'])->remember(
            'levels_ordered_by_fheq_level',
            config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('fheq_level')->get()
        );
    }

}
