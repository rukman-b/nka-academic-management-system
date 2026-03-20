<?php

// app/Livewire/Admin/ProgrammeExitAwardManager.php

namespace App\Livewire\Admin\ProgrammeExitAwards;

use App\Models\Department;
use App\Models\Programme;
use App\Models\ExitAward;
use App\Models\ProgrammeExitAward;
use Livewire\Component;

class ProgrammeExitAwardManager extends Component
{
    public $department_id;
    public $programme_id;
    public $exit_award_id;
    public $default_award = false;
    public $record_id;

    public $editing = false;

    public function rules()
    {
        return [
            'programme_id'   => 'required|exists:programmes,id',
            'exit_award_id'  => 'required|exists:exit_awards,id',
            'default_award'  => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        ProgrammeExitAward::updateOrCreate(
            ['id' => $this->record_id],
            [
                'programme_id'  => $this->programme_id,
                'exit_award_id' => $this->exit_award_id,
                'default_award' => $this->default_award,
            ]
        );

        session()->flash('success', $this->editing ? 'Updated successfully.' : 'Created successfully.');

        $this->resetForm();
    }

    public function edit($id)
    {
        $record = ProgrammeExitAward::findOrFail($id);

        $this->record_id     = $record->id;
        $this->programme_id  = $record->programme_id;
        $this->exit_award_id = $record->exit_award_id;
        $this->default_award = $record->default_award;
        $this->department_id = $record->programme->department->id;
        $this->editing       = true;
    }

    public function delete($id)
    {
        ProgrammeExitAward::findOrFail($id)->delete();
        session()->flash('success', 'Deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset(['programme_id', 'exit_award_id','default_award', 'editing', 'record_id']);
        $this->resetValidation();
    }

//    public function updatedProgrammeId()
//    {
//         dd("I am here");
//    }

   public function filterExitAwards()
    {
        
        // $allExitAwardIds = ExitAward::pluck('id'); //Do not remove
        // $assignedAwardIds = ProgrammeExitAward::where('programme_id',$this->programme_id)->pluck('exit_award_id'); //Do not remove
        $allExitAwardIds = ExitAward::cachedIds();
        $assignedAwardIds = ProgrammeExitAward::cachedExitAwardIdsByProgramme($this->programme_id);

        
        // Get the difference between all awards and assigned awards
        $remainingAwardIds = $allExitAwardIds->diff($assignedAwardIds);

        $filteredExitAwards = ExitAward::with('level')
                            ->whereIn('id', $remainingAwardIds)
                            ->get()
                            ->sortBy(fn($award) => $award->level->fheq_level ?? 0);
        // dd($filteredExitAwards);
                                
        return $filteredExitAwards;
    }

    //Do not remove this
    // public function render()
    // {
    //     return view('livewire.admin.programme-exit-awards.programme-exit-award-manager', [
    //         'programmes'    => Programme::where('department_id',$this->department_id)->orderBy('name')->get(),
    //         'exitAwards'    => $this->programme_id ? $this->filterExitAwards() : [],
    //         'departments'   => Department::all(),
    //         'records' => ProgrammeExitAward::with(['programme', 'exitAward'])
    //                     ->get()
    //                     ->sortBy(fn($record) => $record->exitAward->title ?? ''),


    //                         ]);
    // }

    public function render()
    {
        return view('livewire.admin.programme-exit-awards.programme-exit-award-manager', [
            'programmes'    => Programme::cachedByDepartment($this->department_id),
            'exitAwards'    => $this->programme_id ? $this->filterExitAwards() : [],
            'departments'   => Department::cachedList(),
            'records' => ProgrammeExitAward::with(['programme', 'exitAward'])
                        ->get()
                        ->sortBy(fn($record) => $record->exitAward->title ?? ''),


                            ]);
    }
}
