<?php

namespace App\Livewire\Admin\DashboardContent\Charts;

use Livewire\Component;

class ComplaintsEscalatedChart extends Component
{
    public array $labels = [];
    public array $escalatedCounts = [];

    public function mount()
    {
        // 🔧 Fake data for now (X = months, Y = escalated complaints)
        $this->labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $this->escalatedCounts = [5, 10, 7, 12, 15, 6];
    }

    public function render()
    {
        return view('livewire.admin.dashboard-content.charts.complaints-escalated-chart');
    }
}
