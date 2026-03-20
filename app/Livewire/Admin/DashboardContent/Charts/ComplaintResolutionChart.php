<?php

namespace App\Livewire\Admin\DashboardContent\Charts;

use Livewire\Component;

class ComplaintResolutionChart extends Component
{
    public array $categories = [];
    public array $averageTimes = [];

    public function mount()
    {
        // 🔧 Fake data for now — replace this with real database logic
        $this->categories = ['Academic', 'Facility', 'IT Support', 'Finance', 'HR'];
        $this->averageTimes = [4.2, 6.8, 2.5, 5.1, 3.7]; // hours
    }

    public function render()
    {
        return view('livewire.admin.dashboard-content.charts.complaint-resolution-chart');
    }
}
