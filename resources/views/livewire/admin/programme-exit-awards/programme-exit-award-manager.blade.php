{{-- resources/views/livewire/admin/programme-exit-award-manager.blade.php --}}

<div>
    {{-- Top Card: Form --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Mapping' : 'Assign Exit Award to Programme' }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            

            <form wire:submit.prevent="save">
                {{-- Department Dropdown --}}
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select wire:model.live="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="programme_id">Programme</label>
                    <select wire:model.live="programme_id" class="form-control">
                        <option value="">-- Select Programme --</option>
                        @foreach($programmes as $programme)
                            <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                        @endforeach
                    </select>
                    @error('programme_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="exit_award_id">Exit Award</label>
                    <select wire:model="exit_award_id" class="form-control">
                        <option value="">-- Select Exit Award --</option>
                        @foreach($exitAwards as $award)
                            <option value="{{ $award->id }}">
                                {{ $award->title }} (Level {{ $award->level->fheq_level }})
                            </option>
                        @endforeach
                    </select>
                    @error('exit_award_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" wire:model="default_award" class="form-check-input" id="default_award">
                    <label class="form-check-label" for="default_award">Default Award</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $editing ? 'Update' : 'Create' }}
                </button>
                <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancel</button>
            </form>
        </div>
    </div>

    {{-- Bottom Card: Table --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Programme Exit Awards</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Programme</th>
                        <th>Exit Award</th>
                        <th>Level</th>
                        <th>Default</th>
                        <th class="text-center" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $item)
                        <tr>
                            <td>{{ $item->programme->name }}</td>
                            <td>{{ $item->exitAward->title }}</td>
                            <td>{{ $item->level }}</td>
                            <td>
                                @if ($item->default_award)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button wire:click="edit({{ $item->id }})" class="btn btn-xs btn-info">Edit</button>
                                <button wire:click="delete({{ $item->id }})" class="btn btn-xs btn-danger"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No mappings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
