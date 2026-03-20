{{-- resources/views/livewire/admin/exit-award-manager.blade.php --}}

<div>
    {{-- Top card: Form --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Exit Award' : 'Create Exit Award' }}</h3>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form wire:submit.prevent="save">
                <div class="form-group">
                    <label>Title</label>
                    <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Short Code</label>
                    <input wire:model="short_code" type="text" class="form-control @error('short_code') is-invalid @enderror">
                    @error('short_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="level_id">FHEQ Level (Optional)</label>
                    <select wire:model.live="level_id" id="level_id" class="form-control">
                        <option value="">-- Select Level --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" @selected($level_id == $level->id)>{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('level_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Minimum Credits</label>
                    <input wire:model="min_credits" type="number" min="0" max="600" class="form-control @error('min_credits') is-invalid @enderror">
                    @error('min_credits') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">
                    {{ $editing ? 'Update' : 'Create' }}
                </button>
                <button class="btn btn-secondary" type="button" wire:click="resetForm">Cancel</button>
            </form>
        </div>
    </div>

    {{-- Bottom card: List --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">All Exit Awards</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Code</th>
                        <th>FHEQ Level</th>
                        <th>Credits</th>
                        <th>Description</th>
                        <th class="text-center" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exitAwards as $award)
                        <tr>
                            <td>{{ $award->title }}</td>
                            <td>{{ $award->short_code }}</td>
                            <td>{{ $award->level->name }}</td>
                            <td>{{ $award->min_credits }}</td>
                            <td>{{ $award->description }}</td>
                            <td class="text-center">
                                <button wire:click="edit({{ $award->id }})" class="btn btn-xs btn-info">Edit</button>
                                <button wire:click="delete({{ $award->id }})" class="btn btn-xs btn-danger"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No exit awards found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
