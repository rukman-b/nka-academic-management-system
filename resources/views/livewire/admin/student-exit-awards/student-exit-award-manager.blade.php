<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $editingId ? 'Edit Award' : 'Assign Exit Award' }}</h3>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form wire:submit.prevent="save">

                <div class="form-group">
                    <label>Student</label>
                    <select class="form-control" wire:model.live="student_id" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                 <div class="form-group">
                    <label>Active Programme</label>
                    <input type="text" class="form-control" value="{{ $active_programme }}" readonly>
                </div>
                <div class="form-group">
                    <label>Exit Award</label>
                    <select wire:model="programme_exit_award_id" class="form-control">
                        <option value="">-- Select Exit Award --</option>
                                @foreach ($awards as $award)
                                    <option value="{{ $award->id }}">
                                        Level {{ $award->exitAward->level->fheq_level ?? 'N/A' }}:
                                        {{ $award->exitAward->title ?? '-' }}
                                    </option>
                                @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Awarded At</label>
                    <input type="date" class="form-control" wire:model="awarded_at" required>
                    @error('awarded_at') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ $editingId ? 'Update' : 'Assign' }}</button>
                <button type="button" class="btn btn-secondary ml-2" wire:click="resetForm">Reset</button>  
            </form>
        </div>
    </div>

    <div class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Assigned Exit Awards</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Programme</th>
                        <th>FHEQ Level</th>
                        <th>Award</th>
                        <th>Awarded At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->student->name }}</td>
                            <td>{{ $record->programmeExitAward->programme->name ?? '-' }}</td>
                            <td>Level {{ $record->programmeExitAward->exitAward->level->fheq_level ?? '-' }}</td>
                            <td>{{ $record->programmeExitAward->exitAward->short_code }}</td>
                            <td>{{ $record->awarded_at }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $record->id }})">Edit</button>
                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $record->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
