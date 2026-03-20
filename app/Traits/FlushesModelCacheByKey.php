<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

trait FlushesModelCacheByKey
{
    /**
     * Automatically hook into model lifecycle events.
     */
    public static function bootFlushesModelCacheByKey(): void
    {
        static::created(fn () => static::flushModelCaches('created'));
        static::updated(fn () => static::flushModelCaches('updated'));
        static::deleted(fn () => static::flushModelCaches('deleted'));
    }

    /**
     * Override in the model to add extra keywords.
     * @return string|array|null
     */
    public static function getCacheFlushKeyword(): string|array|null
    {
        return null;
    }

    /**
     * Flush all Redis cache keys that match the model name or custom keywords.
     */
    protected static function flushModelCaches(string $event = 'event'): void
    {
        if (!Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
            logger()->warning("[FlushesModelCache] Redis cache store required. Skipping for: " . static::class);
            return;
        }

        try {
            $redis = Cache::getRedis();

            // Get Redis DB index used for cache from config/cache.php → config/database.php
            $connection = config('cache.stores.redis.connection', 'default');
            // $dbIndex = config("database.redis.{$connection}.database", 1);
            $dbIndex = 1;

            $redis->select($dbIndex);
            // dd($redis->keys('*'));
            logger()->info("[FlushesModelCache] {$event} triggered for: " . static::class);
            logger()->debug("[FlushesModelCache] Using Redis DB index: {$dbIndex}");

            $keywords = static::resolveFlushKeywords();
            logger()->debug("[FlushesModelCache] Search keywords: " . implode(', ', $keywords));

            $cursor = '0';

            do {
                [$cursor, $keys] = $redis->scan($cursor ?? 0, ['MATCH' => '*', 'COUNT' => 1000]);

                foreach ($keys ?? [] as $key) {
                    $key = (string) $key; 
                      if (static::keyMatchesAnyKeyword($key, $keywords)) {
                            $deleted = $redis->del($key);
                            logger()->debug("[FlushesModelCache] Flushed cache key: {$key}, Deleted: {$deleted}");
                        }
                }
            } while ($cursor != 0);

        } catch (\Throwable $e) {
            logger()->error("[FlushesModelCache] Exception while flushing: {$e->getMessage()}");
        }
    }

    /**
     * Combine model name + custom keywords into array.
     */
    protected static function resolveFlushKeywords(): array
    {
        $keywords = [strtolower(class_basename(static::class))];

        $custom = static::getCacheFlushKeyword();
        if (is_string($custom)) {
            $keywords[] = strtolower($custom);
        }
        if (is_array($custom)) {
            foreach ($custom as $word) {
                if (is_string($word)) {
                    $keywords[] = strtolower($word);
                }
            }
        }

        return array_unique($keywords);
    }

    /**
     * Check if a key contains any of the given keywords.
     */
    protected static function keyMatchesAnyKeyword(string $key, array $keywords): bool
    {
        $key = strtolower($key);
        foreach ($keywords as $keyword) {
            if (Str::contains($key, $keyword)) {
                return true;
            }
        }
        return false;
    }
}
