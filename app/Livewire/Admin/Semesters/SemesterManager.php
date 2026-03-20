<?php

namespace App\Livewire\Admin\Semesters;

use App\Models\Semester;
use App\Services\ModuleSemesterService;
use Livewire\Component;


//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class SemesterManager extends Component
{
    use HandlesDeleteExceptions;
    
    // Reactive update trigger
    public $refreshKey = 0;

    public $semesterId;
    public $name;
    public $academic_year;
    public $start_date;
    public $end_date;

    public $editing = false;

    protected function rules()
    {
        return [
            'name' => 'required|in:Semester 1,Semester 2,Semester 3,Full Year',
            'academic_year' => 'required|regex:/^\d{4}\/\d{4}$/',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }

    public function updatedName()
    {
        $this->academic_year = getDefaultAcademicYear();
    }

    public function mount() 
    {
        $this->academic_year = getDefaultAcademicYear();
    }

    public function save()
    {
        $this->validate();
        
        // if($this->name !== 'Semester 3') ensureMinimumSemesterDuration($this->start_date, $this->end_date);
        app(ModuleSemesterService::class)->ensureSemesterDurationWithinRange($this->start_date, $this->end_date,$this->name);

        
        // Only check for uniqueness if it's a new record or the name has changed
        if (
            ! $this->semesterId ||
            strcasecmp(
                Semester::findOrFail($this->semesterId)->name,
                $this->name
            ) !== 0
        ) {
            app(ModuleSemesterService::class)->ensureUniqueSemesterPerAcademicYear(
                $this->name,
                $this->academic_year
            );
        }


        Semester::updateOrCreate(
            ['id' => $this->semesterId],
            [
                'name' => $this->name,
                'academic_year' => $this->academic_year,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]
        );

        $this->resetForm();
        $this->academic_year = getDefaultAcademicYear();
        $this->dispatch('toast', 'Semester saved successfully.');
        $this->refreshKey ++;

    }


    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        $this->semesterId = $semester->id;
        $this->name = $semester->name;
        $this->academic_year = $semester->academic_year;
        $this->start_date = $semester->start_date->format('Y-m-d'); 
        $this->end_date = $semester->end_date->format('Y-m-d');
        $this->editing = true;
    }

    public function delete($id)
    {
        $semester = Semester::findOrFail($id);
        // $this->dispatch('toast', 'Semester deleted.');

            $this->safeDelete(
            fn() => $semester->delete(),
            'Department deleted successfully.',
            'Cannot delete this department because it is referenced by other records.'
        );

        $this->resetForm();
        $this->refreshKey ++;


    }

    public function resetForm()
    {
        $this->reset(['semesterId', 'name', 'academic_year', 'start_date', 'end_date', 'editing']);
    }

    public function render()
    {
        return view('livewire.admin.semesters.semester-manager', [
            // 'semesters' => Semester::orderBy('academic_year')->orderBy('name')->get(),
        ]);
    }
}
