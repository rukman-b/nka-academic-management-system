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
    $tagKeys = $redis->keys('tag:*:entries');

    foreach ($tagKeys as $key) {
        if (preg_match('/^tag:([^:]+):entries$/', $key, $matches)) {
            $tag = $matches[1];

            try {
                $typeCode = $redis->type($key); // integer
                $type = match ($typeCode) {
                    1 => 'string',
                    2 => 'set',
                    3 => 'list',
                    4 => 'zset',
                    5 => 'hash',
                    default => 'unknown',
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
