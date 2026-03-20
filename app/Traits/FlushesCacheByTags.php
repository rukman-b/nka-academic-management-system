<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait FlushesCacheByTags
 *
 * Automatically flushes tagged Redis cache entries when the model is
 * created, updated, or deleted.
 *
 * Supports:
 * - Default tag using the model's class basename (e.g., 'programme')
 * - Optional custom tags via getCacheTagsToFlush() method
 *
 * Requires Redis or another taggable cache driver
 */
trait FlushesCacheByTags
{
    public static function bootFlushesCacheByTags(): void
    {
        static::created(fn() => static::flushTaggedCaches());
        static::updated(fn() => static::flushTaggedCaches());
        static::deleted(fn() => static::flushTaggedCaches());
    }

    /**
     * Flush all Redis tags resolved for this model.
     */
    protected static function flushTaggedCaches(): void
    {
        if (!Cache::getStore() instanceof \Illuminate\Cache\TaggableStore) {
            logger()->warning('[FlushesCacheByTags] Your cache driver does not support tags.');
            return;
        }

        $tags = static::resolveCacheTags();

        foreach ($tags as $tag) {
            Cache::tags($tag)->flush();
            logger()->debug("[FlushesCacheByTags] Flushed tag: {$tag}");
        }
    }

    /**
     * Determine the cache tags to flush.
     * If the model defines getCacheTagsToFlush(), use its return value.
     * Otherwise default to using the model's class basename.
     */
    protected static function resolveCacheTags(): array
    {
        $defaultTag = strtolower(class_basename(static::class));

        if (!method_exists(static::class, 'getCacheTagsToFlush')) {
            return [$defaultTag];
        }

        $custom = static::getCacheTagsToFlush();

        return match (true) {
            is_string($custom) => [$custom],
            is_array($custom) => array_map('strtolower', array_filter($custom, 'is_string')),
            default => [$defaultTag],
        };
    }
}
