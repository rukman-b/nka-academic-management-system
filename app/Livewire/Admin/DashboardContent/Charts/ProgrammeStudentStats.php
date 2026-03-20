<?php

namespace App\Livewire\Admin\DashboardContent\Charts;

use Livewire\Component;
use App\Models\Programme;

class ProgrammeStudentStats extends Component
{
    public $programmeStats = [];

    public function mount()
    {
        $this->loadFakeStats(); // temporary, later you can use real()
    }

    protected function loadFakeStats()
    {
        // Fake data (replace this with real logic later)
        $this->programmeStats = [
            ['name' => 'Computer Science', 'student_count' => 120],
            ['name' => 'Business Management', 'student_count' => 95],
            ['name' => 'Hospitality Management', 'student_count' => 60],
            ['name' => 'Software Engineering', 'student_count' => 85],
            ['name' => 'Cyber Security', 'student_count' => 40],
            ['name' => 'Data Science', 'student_count' => 55],
            ['name' => 'Accounting & Finance', 'student_count' => 72],
            ['name' => 'Marketing & Advertising', 'student_count' => 48],
            ['name' => 'Tourism & Events', 'student_count' => 33],
            ['name' => 'Culinary Arts', 'student_count' => 28],
            ['name' => 'Mechanical Engineering', 'student_count' => 66],
            ['name' => 'Nursing & Healthcare', 'student_count' => 89],
        ];
       
    }

    // Later this can be used to hook up to real data flow:
    // protected function loadRealStats()
    // {
    //     $this->programmeStats = Programme::withCount([
    //         'configs.batches.students as student_count'
    //     ])->get()->map(function($programme) {
    //         return [
    //             'name' => $programme->name,
    //             'student_count' => $programme->student_count
    //         ];
    //     });
    // }

    public function render()
    {
        return view('livewire.admin.dashboard-content.charts.programme-student-stats', [
            'labels' => collect($this->programmeStats)->pluck('name'),
            'data' => collect($this->programmeStats)->pluck('student_count'),
        ]);
    }

}
