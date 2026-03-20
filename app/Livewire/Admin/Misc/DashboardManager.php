<?php

namespace App\Livewire\Admin\Misc;

use App\Constants\Permissions;
use App\Models\Level;
use App\Models\Programme;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class DashboardManager extends Component
{
    public string $header_title = 'Dashboard';
    public string $subtitle = '';

    // public function render()
    // {
    //     return view('livewire.admin.misc.dashboard');
    // }

    public $programmeLabels = [], $programmeCounts = [];
    public $levelLabels = [], $levelCounts = [];

    public function mount()
    {
        // $programmeData = Programme::withCount('students')->get();
        // $this->programmeLabels = $programmeData->pluck('name')->toArray();
        // $this->programmeCounts = $programmeData->pluck('students_count')->toArray();

        // $levelData = Level::withCount('students')->get();
        // $this->levelLabels = $levelData->pluck('name')->toArray();
        // $this->levelCounts = $levelData->pluck('students_count')->toArray();
    }

    public function render()
    {
        // try {

        //     $this->authorize(Permissions::VIEW_ADMIN_DASHBOARD);

        // } catch (AuthorizationException $e) {
        //     //This action can be customized as required.
        //     abort(403, 'You do not have permission to view system admin dashboard.');
        // }

        return view('livewire.admin.misc.dashboard');
    }}
