<?php

namespace App\Livewire\Sysadmin\DashboardContent\Charts;

use Illuminate\Support\Facades\Redis;
use Livewire\Component;



class CacheUsageChart extends Component
{
    public array $usage = [];

    public function mount(): void
    {
        $this->usage = $this->collectTaggedUsage();
    }

    protected function collectTaggedUsage(): array
    {
        $usage = [];

        $redis = Redis::connection('cache');

        // Laravel cache keys may include the CACHE_PREFIX value.
        // Example: nka_hub_cache_tag:programme:entries
        $tagKeys = $redis->keys('*tag:*:entries');

        foreach ($tagKeys as $key) {
            if (preg_match('/tag:([^:]+):entries$/', $key, $matches)) {
                $tag = $matches[1];

                try {
                    $typeCode = $redis->type($key);

                    $type = match ($typeCode) {
                        1, 'string' => 'string',
                        2, 'set'    => 'set',
                        3, 'list'   => 'list',
                        4, 'zset'   => 'zset',
                        5, 'hash'   => 'hash',
                        default     => 'unknown',
                    };

                    $count = match ($type) {
                        'zset' => $redis->zcard($key),
                        'set'  => $redis->scard($key),
                        default => 0,
                    };

                    $usage[$tag] = $count;
                } catch (\Throwable $e) {
                    $usage[$tag] = 0;
                }
            }
        }

        return $usage;
    }
    public function render()
    {
        logger('Cache usage data:', $this->usage);
        return view('livewire.sysadmin.dashboard-content.charts.cache-usage-chart');
    }
}
