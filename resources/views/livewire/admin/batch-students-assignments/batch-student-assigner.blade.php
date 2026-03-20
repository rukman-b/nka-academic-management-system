<div>
    {{-- Top Card: Assignment Form --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assign Student to Batch</h3>
        </div>

        <div class="card-body">
            <x-flash-message />

            <form wire:submit.prevent="assign">
                <div class="form-group">
                    <label for="student_id">Student</label>
                    <select wire:model="student_id" class="form-control">
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    @error('student_id') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="batch_id">Batch</label>
                    <select wire:model="batch_id" class="form-control">
                        <option value="">-- Select Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">
                                {{ $batch->code }} ({{ $batch->programme->name ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        Note: All student batch assignments will be added with <strong>active</strong> status.
                    </small>
                    @error('batch_id') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select wire:model="status" class="form-control" :key="'status-select-' . $refreshKey">
                        <option value="">-- Select Status --</option> 
                        @foreach($this->availableStatuses as $statusOption)
                            <option value="{{ $statusOption }}">{{ ucfirst($statusOption) }}</option>
                        @endforeach
                    </select>
                    @error('status') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                </div>



                <button type="submit" class="btn btn-success">Assign</button>
            </form>
        </div>
    </div>

    {{-- Bottom Card: List of Assignments --}}
    {{-- <div class="card card-secondary mt-3">
        <div class="card-header">
            <h3 class="card-title">Existing Batch Assignments</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Batch</th>
                        <th>Programme</th>
                        <th>Status</th>
                        <th>Assigned At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $record)
                        <tr>
                            <td>{{ $record->student->name }}</td>
                            <td>{{ $record->batch->code }}</td>
                            <td>{{ $record->batch->programme->name }}</td>
                            <td>
                                <span class="badge badge-{{ $record->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($record->created_at)->toFormattedDateString() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No assignments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> --}}


     {{-- Bottom Card: Batch Assignment List --}}
    @include('livewire.admin.batch-students-assignments.partials.batch-students-assignments-list')


</div>
