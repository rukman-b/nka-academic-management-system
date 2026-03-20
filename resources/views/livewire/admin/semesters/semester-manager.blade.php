<div>
    <div class="row mt-4">
         <div class="col-12">
            <!-- Top Card: Form -->
            <div class="card card-primary">
                <x-flash-message /> {{-- Flash message --}}
                <div class="card-header">
                    <h3 class="card-title">{{ $editing ? 'Edit Semester' : 'Create Semester' }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Semester Name</label>
                        <select wire:model.live="name" class="form-control">
                            <option value="">-- select --</option>
                            <option value="Semester 1">Semester 1</option>
                            <option value="Semester 2">Semester 2</option>
                            <option value="Semester 3">Semester 3</option>
                            <option value="Full Year">Full Year (Semester 1 & 2) </option>
                        </select>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Academic Year</label>
                        <input type="text" wire:model.lazy="academic_year" class="form-control" />
                        @error('academic_year') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" wire:model.lazy="start_date" class="form-control" />
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" wire:model.lazy="end_date" class="form-control" />
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button wire:click="save" class="btn btn-primary">Save</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            <!-- Bottom Card: Table -->
            {{-- <div class="card card-secondary">
                <div class="card-header"><h3 class="card-title">Existing Semesters</h3></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Academic Year</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semesters as $s)
                                <tr>
                                    <td>{{ $s->name }}</td>
                                    <td>{{ $s->academic_year }}</td>
                                    <td>{{ $s->start_date->format('Y-m-d') }}</td>
                                    <td>{{ $s->end_date->format('Y-m-d') }}</td>
                                    <td>
                                        <button wire:click="edit({{ $s->id }})" class="btn btn-warning btn-sm">Edit</button>
                                        <button wire:click="delete({{ $s->id }})" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            @if($semesters->isEmpty())
                                <tr><td colspan="5" class="text-center">No semesters found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Semesters Table --}}
    @include('livewire.admin.semesters.partials.semesters-list')


</div>
