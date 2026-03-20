<?php

namespace App\Livewire\Admin\Students;

use App\Models\Student;
use App\Models\Programme;
use App\Models\Batch;
use Livewire\Component;
use App\Livewire\Traits\InteractsWithAddress;


//traits
use App\Livewire\Traits\HandlesDeleteExceptions;


class StudentManager extends Component
{

    use HandlesDeleteExceptions, InteractsWithAddress;

    // Form state
    public $name;
    public $email;
    public $phone;
    public $dob;
    public $programme_id;
    public $batch_id;
    public $password;
    public $password_confirmation;
    public $address = [];


    // Editing state
    public $editingId = null;
    public $filteredBatches = [];

    // Reactive update trigger
    public $refreshKey = 0;

    public function mount(): void
    {
       $this->address = $this->defaultAddress();
    }

    public function edit(int $id): void
    {
        $student = Student::with('activeBatch')->findOrFail($id);
        $activeBatch = $student->active_batch;

        $this->editingId = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->dob = $student->dob;

        $this->programme_id = $activeBatch?->programme_id ?? null;

        // 🔄 Call filterBatches *after* programme_id is set
        $this->filterBatches();

        $this->batch_id = $activeBatch?->id ?? null; // Set this AFTER filteredBatches

        $this->password = null;
        $this->password_confirmation = null;

        $this->address = $student->address?->toArray() ?? $this->defaultAddress();
    }



    public function save(): void
    {
        $this->validate($this->rules());

        $studentData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' => $this->dob,
            // 'programme_id' => $this-> programme_id,
            // 'batch_id' => $this->batch_id,
        ];

        if (!empty($this->password)) {
            $studentData['password'] = bcrypt($this->password);
        }

        $student = Student::updateOrCreate(['id' => $this->editingId], $studentData);

        $student->batches()->sync($this->batch_id);

        $student->address()->create($this->address);

        

        session()->flash('success', 'Student saved successfully.');

        $this->resetForm();
        $this->refreshKey++;
    }

    public function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->dob = '';
        $this->programme_id = null;
        $this->batch_id = null;
        $this->password = '';
        $this->password_confirmation = '';
        $this->filteredBatches = [];

        $this->address = $this->defaultAddress();

    }

    public function delete(int $id): void
    {

        $this->safeDelete(
            fn() => Student::findOrFail($id)->delete(),
            'Student deleted successfully.',
            'Cannot delete this Student because it is referenced by other records.'
        );

        $this->refreshKey++;
        $this->resetForm();
    }

    public function updatedProgrammeId($field)
    {

       $this->filterBatches();

    }
 
    protected function filterBatches(): void
    {
        if ($this->programme_id) {
            $this->filteredBatches = Batch::where([
                'programme_id' => $this->programme_id,
                'status' => 1,
            ])->get();
        } else {
            $this->filteredBatches = [];
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $this->editingId,
            'dob'   => 'required|date',
            'password' => $this->editingId
                ? 'nullable|min:6|confirmed'
                : 'required|min:6|confirmed',
        ];
    }

    public function render()
    {
        // print_r($this->filteredBatches);
        return view('livewire.admin.students.student-manager', [
            // 'programmes' => Programme::all(), //Do not remove
            'programmes' => Programme::cachedList(),
            'batches' => $this->filteredBatches,
        ]);
    }
}
