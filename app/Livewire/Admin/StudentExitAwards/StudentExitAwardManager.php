<?php

namespace App\Livewire\Admin\StudentExitAwards;

use App\Models\ExitAward;
use App\Models\Programme;
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\StudentExitAward;
use App\Models\ProgrammeExitAward;
use App\Models\BatchStudent;
use Carbon\Carbon;


class StudentExitAwardManager extends Component
{
    public $student_id, $programme_exit_award_id;
    public $editingId = null;
    public $records = [];
    public $awarded_at;

    public function mount()
    {
        // dd( ProgrammeExitAward::with(['programme', 'exitAward.level'])->get());
        $this->records = StudentExitAward::with(['student', 'programmeExitAward'])->latest()->get();
        $this->awarded_at = now()->toDateString();    
    }

    public function save()
    {
        $this->validate([
            'student_id' => 'required|exists:students,id',
            'programme_exit_award_id' => 'required|exists:programme_exit_awards,id',
            'awarded_at' => 'required|date',
        ]);

        StudentExitAward::updateOrCreate([
            'id' => $this->editingId,
        ], [
            'student_id' => $this->student_id,
            'programme_exit_award_id' => $this->programme_exit_award_id,
            'awarded_at' => $this->awarded_at,
        ]);

        session()->flash('success', 'Student Exit Award saved successfully.');
        $this->resetForm();
        $this->mount();
    }

    public function edit($id)
    {
        $record = StudentExitAward::findOrFail($id);
        $this->editingId = $record->id;
        $this->student_id = $record->student_id;
        $this->programme_exit_award_id = $record->programme_exit_award_id;
        $this->awarded_at = Carbon::parse($record->awarded_at)->format('Y-m-d');
        
    } 

    public function delete($id)
    {
        StudentExitAward::findOrFail($id)->delete();
        session()->flash('success', 'Student Exit Award deleted.');
        $this->mount();
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->student_id = $this->programme_exit_award_id = $this->awarded_at = null;
    }

    public function filterAwards(): Collection
    {
        // Step 1: Get already assigned award IDs for this student
        $alreadyAssigned = StudentExitAward::where('student_id', $this->student_id)
            ->pluck('programme_exit_award_id')
            ->toArray();

        // Step 2: Get max awarded level per programme
        $awardedLevels = StudentExitAward::where('student_id', $this->student_id)
            ->join('programme_exit_awards', 'student_exit_awards.programme_exit_award_id', '=', 'programme_exit_awards.id')
            ->join('exit_awards', 'programme_exit_awards.exit_award_id', '=', 'exit_awards.id')
            ->select('programme_exit_awards.programme_id', DB::raw('MAX(exit_awards.level_id) as max_level'))
            ->groupBy('programme_exit_awards.programme_id')
            ->pluck('max_level', 'programme_exit_awards.programme_id');

        // Step 3: Get active batch
        $activeBatch = BatchStudent::with('batch.config')
            ->where('student_id', $this->student_id)
            ->where('status', 'active')
            ->first();

        if (! $activeBatch || ! $activeBatch->batch || ! $activeBatch->batch->config) {
            return collect();
        }

        $programmeId = $activeBatch->batch->config->programme_id;
        $awardedLevel = $awardedLevels[$programmeId] ?? null;

        // Step 4: Load all potential awards for this programme
        return ProgrammeExitAward::with(['programme', 'exitAward.level'])
            ->where('programme_id', $programmeId)
            ->get()
            ->filter(function ($award) use ($alreadyAssigned, $awardedLevel) {
                if ($award->default_award) return false;
                if (in_array($award->id, $alreadyAssigned)) return false;
                if ($awardedLevel && $award->exitAward->level_id <= $awardedLevel) return false;
                return true;
            });
    }

    public function render()
    {
        $student = $this->student_id
            ? Student::with('activeBatchAssignment.batch.config.programme')->find($this->student_id)
            : null;

        return view('livewire.admin.student-exit-awards.student-exit-award-manager', [
            'students' => Student::with('activeBatchAssignment')->whereHas('activeBatchAssignment')->get(),
            'awards' => $this->student_id ? $this->filterAwards() : [],
            'active_programme' => $student?->activeBatchAssignment?->batch?->config?->programme?->name,
        ]);
    }
}
