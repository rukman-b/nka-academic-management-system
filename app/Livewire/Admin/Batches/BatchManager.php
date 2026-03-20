<?php

namespace App\Livewire\Admin\Batches;

use App\Models\Batch;
use App\Models\Programme;
use App\Models\Config;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Support\DateHelper;
use Illuminate\Support\Carbon;

//traits
use App\Livewire\Traits\HandlesDeleteExceptions;
use App\Models\Department;
use App\Support\NkaHelper;
use App\Support\SemesterHelper;

class BatchManager extends Component
{
    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;

    public $filteredConfigs = [];


    public $programme_id = '';
    public $config_id = '';
    public $code = '';
    public $start_date = '';
    public $end_date = '';
    public $status = true;
    public $editing;
    public $department_id;

    public function rules()
    {
        return [
            'programme_id' => ['required', 'exists:programmes,id'],
            'config_id'    => ['required', 'exists:configs,id','exists:config_modules,config_id'],
            'code'         => ['required', Rule::unique('batches', 'code')->ignore($this->editing?->id)],
            'start_date'   => ['required', 'date'],
            'end_date'     => ['required', 'date', 'after:start_date'],
            'status'       => ['boolean'],
        ];
    }




    public function messages()
    {
        return [
            'config_id.exists'      => 'The selected config is invalid or not linked to any module.',
        ];
    }


    public function updatedDepartmentId()
    {
        $this->resetExcept('department_id');
    }

    public function updatedConfigId()
    {
            $this->code = NkaHelper::generateBatchCode($this->config_id);
            $semester = SemesterHelper::findFirstSemesterOfAcademicYear(DateHelper::nextAcademicYear());
            
           if(!$semester)
           {
                return;
           }  
        
        $this->start_date = $semester->start_date->toDateString();
        $this->end_date = DateHelper::calculateProgrammeEndDate(
            $semester->start_date,
            NkaHelper::findStartingLevelOfProgramme($this->programme_id),
            NkaHelper::findOfferingLevelOfProgramme($this->programme_id)
        );

    }


    public function updatedProgrammeId()
    {
        $this->filterConfigs();
    }

    public function create()
    {
         
        $semesters = SemesterHelper::findSemestersByAcademicYear(DateHelper::nextAcademicYear());
        if(!$semesters)
        {
           
                session()->flash('error','There are no semesters for next academic year yet.');

        }

        $this->validate();


        Batch::create($this->only([
            'programme_id',
            'config_id',
            'code',
            'start_date',
            'status'
        ]));

        $this->resetForm();
        $this->refreshKey ++;
        
    }

    public function edit($id)
    {
        $this->editing       = Batch::findOrFail($id);
        // dd($this->editing->programme_id);
        $this->department_id = $this->editing->department->id; // Accessor
        $this->programme_id  = $this->editing->programme_id;
        $this->config_id     = $this->editing->config_id;
        $this->code          = $this->editing->code;
        $this->start_date    = $this->editing->start_date;
        $this->status        = (bool)$this->editing->status;

        $this->end_date      = DateHelper::calculateProgrammeEndDate(
                                Carbon::parse($this->editing->start_date),
                                NkaHelper::findStartingLevelOfProgramme($this->programme_id),
                                NkaHelper::findOfferingLevelOfProgramme($this->programme_id)
                            );

        $this->filterConfigs();

        // dd($this->config_id);
    }

    public function update()
    {
        $this->validate();

        $batch = Batch::findOrFail($this->editing->id);

        $batch->programme_id = $this->programme_id;
        $batch->config_id    = $this->config_id;
        $batch->code         = $this->code;
        $batch->start_date   = $this->start_date;
        $batch->status       = $this->status;

        $batch->save();

        $this->resetForm();
        $this->refreshKey ++;

    }

    // public function updated($field)
    // {
    //    if($field === 'programme_id'){
            
    //    }
    // }


    private function filterConfigs()
    {
        // $this->filteredConfigs = Config::where('programme_id', $this->programme_id)->get();
        $this->filteredConfigs = Config::cachedByProgramme($this->programme_id);
        // $this->config_id = null;

    }

    public function delete($id)
    {

        // $this->authorize('delete', $module);
       
         $this->safeDelete(
            fn() => Batch::findOrFail($id)->delete(),
            'Batch deleted successfully.',
            'Cannot delete this batch because it is referenced by other records.'
        );

            $this->refreshKey++;
            $this->resetForm();



    }

    public function resetForm()
    {
        $this->reset([
            'programme_id',
            'config_id',
            'code',
            'start_date',
            'end_date',
            'status',
            'editing'
        ]);
    }

    //Do not remove this
    // public function render()
    // {
    //     return view('livewire.admin.batches.batch-manager', [
    //         'batches'    => Batch::with(['programme', 'config'])->latest()->get(),
    //         'programmes' => $this->department_id ? Programme::where('department_id',$this->department_id)->get() : collect(),
    //         'configs'    => $this->filteredConfigs,
    //         'departments' => Department::OrderBy('name')->get(),
    //     ]);
    // }


    public function render()
    {
        return view('livewire.admin.batches.batch-manager', [
            // 'batches'    => Batch::with(['programme', 'config'])->latest()->get(), //Do not remove this
            'programmes' => $this->department_id ? Programme::cachedByDepartment($this->department_id) : collect(),
            'configs'    => $this->filteredConfigs,
            'departments' => Department::cachedList(),
        ]);
    }


    
}
