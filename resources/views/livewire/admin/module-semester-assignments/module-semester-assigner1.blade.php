<div class="row justify-content-center">
    <div class="col-md-8">

        {{-- Top Card - Assign Semester --}}
        <div class="card card-primary">
            <div class="card-header">Assign Semester to Module</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="module_id">Module</label>
                    <select wire:model="module_id" class="form-control">
                        <option value="">Select Module</option>
                        @foreach($availableModules as $mod)
                            <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester_id">Semester</label>
                    <select wire:model="semester_id" class="form-control">
                        <option value="">Select Semester</option>
                        @foreach($availableSemesters as $sem)
                            <option value="{{ $sem->id }}">{{ $sem->name }} ({{ $sem->start_date }} - {{ $sem->end_date }})</option>
                        @endforeach
                    </select>
                </div>

                <button wire:click="assign" class="btn btn-primary">Assign</button>
            </div>
        </div>

        {{-- Bottom Card - Assigned Semesters --}}
        <div class="card card-secondary">
            <div class="card-header">Assigned Semesters</div>
            <div class="card-body">
                @if($assignedSemesters)
                    <ul class="list-group">
                        @foreach($assignedSemesters as $row)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $row->semester->name }} ({{ $row->semester->start_date }} - {{ $row->semester->end_date }})
                                <button wire:click="remove({{ $row->id }})" class="btn btn-sm btn-danger">Remove</button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No semesters assigned to this module.</p>
                @endif
            </div>
        </div>

    </div>
</div>
