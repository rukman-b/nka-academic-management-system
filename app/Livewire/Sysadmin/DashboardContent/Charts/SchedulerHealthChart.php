<?php

namespace App\Livewire\Sysadmin\DashboardContent\Charts;


use Livewire\Component;
use App\Models\SchedulerLog;

class SchedulerHealthChart extends Component
{
    public array $chartData = [];
    public string $lastRunTime = 'N/A';

    public function mount(): void
    {
        $logs = SchedulerLog::latest()
            ->whereNotNull('finished_at')
            ->take(30)
            ->get()
            ->reverse();

        $this->chartData = [
            'labels' => $logs->map(fn($log) => $log->started_at->format('d M H:i'))->values()->all(),
            'durations' => $logs->map(fn($log) => $log->started_at->diffInSeconds($log->finished_at))->values()->all(),
            'statuses' => $logs->map(fn($log) => $log->status)->values()->all(),
        ];

        $latestLog = $logs->last();
        $this->lastRunTime = $latestLog
            ? $latestLog->finished_at->format('Y-m-d h:i A')
            : 'N/A';
    }

    public function render()
    {
        return view('livewire.sysadmin.dashboard-content.charts.scheduler-health-chart');
    }
}
