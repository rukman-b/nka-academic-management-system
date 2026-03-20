<?php

namespace App\Livewire\Admin\AcademicTools;

use App\Models\Semester;
use App\Models\ModuleSemester;
use Livewire\Component;

class CopyModuleOfferings extends Component
{
    public $fromYear;
    public $toYear;
    public $status = '';
    public $availableYears = [];

    public function mount()
    {
        $this->availableYears = Semester::query()
            ->select('academic_year')
            ->distinct()
            ->orderBy('academic_year', 'desc')
            ->pluck('academic_year')
            ->toArray();
            // dd($this->toYear);
    }

    public function copy()
    {
        $this->validate([
            'fromYear' => 'required|string',
            'toYear' => 'required|string|different:fromYear',
        ]);

        $fromSemesters = Semester::where('academic_year', $this->fromYear)->get(); //Do not remove
        $toSemesters = Semester::where('academic_year', $this->toYear)->get(); //Do not remove



        $copied = 0;

        foreach ($fromSemesters as $fromSemester) {
            $toSemester = $toSemesters->firstWhere('name', $fromSemester->name);

            if (!$toSemester) continue;

            $offerings = ModuleSemester::where('semester_id', $fromSemester->id)->get();

            foreach ($offerings as $offering) {
                $exists = ModuleSemester::where([
                    'module_id' => $offering->module_id,
                    'semester_id' => $toSemester->id,
                    'offering_type' => $offering->offering_type,
                ])->exists();

                if (!$exists) {
                    ModuleSemester::create([
                        'module_id' => $offering->module_id,
                        'semester_id' => $toSemester->id,
                        'offering_type' => $offering->offering_type,
                    ]);
                    $copied++;
                }
            }
        }

        $this->status = "Copied {$copied} offerings from {$this->fromYear} to {$this->toYear}.";
    }

    public function render()
    {
        return view('livewire.admin.academic-tools.copy-module-offerings');
    }
}
