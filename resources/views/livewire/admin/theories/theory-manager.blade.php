<div>
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Theory' : 'Add New Theory' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select wire:model.live="department_id" id="department_id"
                        class="form-control @error('department_id') is-invalid @enderror">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" wire:model.live="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model.live="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                {{-- <button class="btn btn-success" type="submit">{{ $editing ? 'Update' : 'Create' }}</button>
                @if($editing)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                @endif --}}
                {{-- Action Buttons --}}
                <x-action-button-group :buttons="[
                    ...($editing ? [['method' => 'resetForm', 'buttonType' => 'cancel']] : []),
                    [
                        'method'      => $editing ? 'update' : 'create',
                        'buttonType'  => $editing ? 'Update' : 'Create',
                        // 'confirm'     => $editing,
                    ],
                ]" />
            </form>
        </div>
    </div>

    {{-- <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Existing Theories</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($theories as $index => $theory)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $theory->title }}</td>
                            <td>{{ $theory->module->name ?? 'N/A' }}</td>
                            <td>{{ $theory->description }}</td>
                            <td>
                                <button wire:click="edit({{ $theory->id }})" class="btn btn-sm btn-warning">Edit</button>
                                <button wire:click="delete({{ $theory->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No theories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> --}}

    {{-- Theories Table --}}
    @include('livewire.admin.theories.partials.theories-list')

</div>
