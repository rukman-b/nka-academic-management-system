<?php

namespace App\Livewire\Sysadmin\DashboardContent\Charts;

use App\Models\Student;
use App\Models\Employer;
use Livewire\Component;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsersByRoleChart extends Component
{
    public array $labels = [];
    public array $data = [];
    public array $colors = [];

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $this->labels = [];
        $this->data = [];
        $this->colors = [];

        $roles = Role::withCount('users')->get();

        foreach ($roles as $role) {
            $this->labels[] = "{$role->name} ({$role->guard_name})";
            $this->data[] = $role->users_count;
        }

        $this->labels[] = 'Employer (employer)';
        $this->data[] = \App\Models\Employer::count();

        $this->labels[] = 'Student (student)';
        $this->data[] = \App\Models\Student::count();

        $this->colors = collect(range(1, count($this->labels)))->map(function () {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            return "rgba($r, $g, $b, 0.7)";
        })->toArray();
    }

    public function exportCsv(): StreamedResponse
    {

         $this->skipRender(); // Add this

        $filename = 'users-by-role-' . now()->format('Y-m-d_H-i') . '.csv';

        return Response::streamDownload(function () {
            $handle = fopen('php://output', 'w');

            // Header
            fputcsv($handle, ['Role (Guard)', 'User Count']);

            // Data rows
            foreach ($this->labels as $index => $label) {
                fputcsv($handle, [$label, $this->data[$index]]);
            }

            fclose($handle);
        }, $filename);
    }

    public function render()
    {
        return view('livewire.sysadmin.dashboard-content.charts.users-by-role-chart');
    }
}
