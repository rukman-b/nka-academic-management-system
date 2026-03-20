<?php

namespace App\Livewire\Sysadmin\DashboardContent\Charts;

use Livewire\Component;
use App\Models\LoginAttempt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LoginActivityChart extends Component
{
    public array $labels = [];
    public array $successData = [];
    public array $failureData = [];

    public function mount()
    {
        $start = Carbon::now()->subDays(29)->startOfDay();

        // Generate empty structure for the last 30 days
        $days = collect(range(0, 29))->map(function ($i) use ($start) {
            return $start->copy()->addDays($i)->format('Y-m-d');
        });

        $this->labels = $days->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();

        $raw = LoginAttempt::select(
                DB::raw("DATE(attempted_at) as date"),
                DB::raw("SUM(successful = 1) as success_count"),
                DB::raw("SUM(successful = 0) as failure_count")
            )
            ->where('attempted_at', '>=', $start)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Fill success and failure arrays
        $this->successData = $days->map(fn($d) => (int) ($raw[$d]->success_count ?? 0))->toArray();
        $this->failureData = $days->map(fn($d) => (int) ($raw[$d]->failure_count ?? 0))->toArray();
    }

    public function render()
    {
        return view('livewire.sysadmin.dashboard-content.charts.login-activity-chart');
    }
}
