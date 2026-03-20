<?php

namespace App\Livewire\Employer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $student;
    public $batches = [];

    public function mount()
    {
        // $this->student = Auth::guard('student')->user()->load('studentOptionalModules');
        // $this->batches = $this->student->activeBatches()->with([
        //     'config.programme',
        //     'config.configLevelModules.module',
        //     'config.configLevelModules.level',
        // ])->get();

            // dd($this->student);
    }

    public function render()
    {
        return view('livewire.employer.dashboard');
    }
}
