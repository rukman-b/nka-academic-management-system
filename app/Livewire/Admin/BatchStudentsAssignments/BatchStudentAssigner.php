<?php

namespace App\Livewire\Admin\BatchStudentsAssignments;

use App\Models\Student;
use App\Models\Batch;
use App\Models\BatchStudent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BatchStudentAssigner extends Component
{

    // Reactive update trigger
    public $refreshKey = 0;

    public $student_id = '';
    public $batch_id = '';
    public $status = '';

    public $students = [];
    public $batches = [];
    public $statusOptions = [];

    public $editingId = null;

    public function mount()
    {
        // $this->students = Student::orderBy('name')->get(); //Do not remove
        // $this->batches = Batch::with('programme')->where('status',config('nka.status.active'))->latest()->get(); //Do not remove

        $this->students = Student::cachedOrdered();
        $this->batches = Batch::cachedActiveWithProgramme();

        
    }

    public function assign()
    {
        $this->validate([
            'student_id' => 'required|integer|exists:students,id',
            'batch_id' => 'required|integer|exists:batches,id',
            'status' => 'required|string|in:active,paused,exit',
        ]);

        // Prevent duplicate active assignment and do not cache this one as it checks real time status.
        $hasActive = DB::table('batch_student')
            ->where('student_id', $this->student_id)
            ->where('status', 'active')
            ->when($this->editingId, fn ($q) => $q->where('id', '!=', $this->editingId))
            ->exists();

        if ($hasActive && $this->status === 'active') {
            session()->flash('error', 'The selected student already has an active batch.');
            return;
        }


        if ($this->editingId) {
            // dd($this->status);
            BatchStudent::findOrFail($this->editingId)->update([
                'student_id' => $this->student_id,
                'batch_id'   => $this->batch_id,
                'status'     => $this->status,
            ]);
            session()->flash('success', 'Assignment updated successfully.');
        } else {
            BatchStudent::create([
                'student_id' => $this->student_id,
                'batch_id'   => $this->batch_id,
                'status'     => $this->status,
            ]);
            session()->flash('success', 'Student assigned to batch successfully.');
        }

        $this->resetForm();
        $this->refreshKey ++;

    }


    // public function edit($id)
    // {
    //     $record = BatchStudent::findOrFail($id);

    //     // dd($record);

    //     $this->editingId = $record->id;
    //     $this->student_id = $record->student_id;
    //     $this->batch_id = $record->batch_id;
    //     $this->status = $record->status;
    //     $this->refreshKey ++;


    //     // dd($this->status);
    //     // dd(config('nka.batch_student_statuses'));
    //     //  $allTransitions = config('nka.batch_student_statuses');
    //     // dd($allTransitions[$this->status]);
    // }

    public function edit($id)
    {
        $record = BatchStudent::findOrFail($id);

        $this->editingId = $record->id;
        $this->student_id = $record->student_id;
        $this->batch_id = $record->batch_id;
        $this->status = $record->status;

        $this->statusOptions = config('nka.batch_student_statuses')[$record->status] ?? [];
    }


    public function delete($id)
    {
        BatchStudent::findOrFail($id)->delete();
        session()->flash('success', 'Assignment deleted successfully.');
        $this->resetForm();
        $this->refreshKey ++;

    }

    public function resetForm()
    {
        $this->reset(['student_id', 'batch_id', 'status', 'editingId']);
        $this->statusOptions = config('nka.batch_student_statuses')[''] ?? [];
    }

    // public function getAvailableStatusesProperty()
    // {
    //     $allTransitions = config('nka.batch_student_statuses');

    //    $transision =$allTransitions[$this->status] ?? [];
    // //    $this->status = '';
    //     return $transision;
    // }

    public function getAvailableStatusesProperty()
    {
        $allTransitions = config('nka.batch_student_statuses');
        // dd($allTransitions);

        $transition = $allTransitions[$this->status] ?? [];
    //    dd($transition);

        return $transition;
    }



    public function render()
    {
        // dd( $this->getAvailableStatusesProperty());

        return view('livewire.admin.batch-students-assignments.batch-student-assigner');
    }
}
