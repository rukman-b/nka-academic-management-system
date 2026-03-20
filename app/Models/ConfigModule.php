<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

/**
 * Represents a module assigned to a specific programme configuration.
 * Each config-module record can be marked as optional or core.
 */
class ConfigModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'config_id',
        'module_id',
        'is_optional',
    ];

    /**
     * Get the associated config (programme delivery configuration).
     */
    public function config()
    {
        return $this->belongsTo(Config::class);
    }

    /**
     * Get the associated module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public static function cachedWithRelations()
    {
        return Cache::tags(['config_modules'])->remember(
            'config_modules_with_config_and_module',
            now()->addHours(2), // or longer if it rarely changes
            fn () => static::with(['config', 'module'])
                ->orderByDesc('id')
                ->get()
        );
    }

     public static function getCacheTagsToFlush(): string
    {
        return 'config_modules';
    }
}
