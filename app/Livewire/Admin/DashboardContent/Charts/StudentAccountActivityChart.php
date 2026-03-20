<?php

namespace App\Livewire\Admin\DashboardContent\Charts;

use Livewire\Component;

class StudentAccountActivityChart extends Component
{
    public array $labels = [];
    public array $added = [];
    public array $updated = [];
    public array $deleted = [];

    public function mount()
    {
        // 🔧 Fake seed data for now
        $this->labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $this->added = [10, 15, 8, 12, 9, 14];
        $this->updated = [5, 8, 4, 6, 7, 5];
        $this->deleted = [1, 2, 1, 3, 0, 1];
    }

    public function render()
    {
        return view('livewire.admin.dashboard-content.charts.student-account-activity-chart');
    }
}
