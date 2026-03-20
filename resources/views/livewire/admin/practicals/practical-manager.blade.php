<div>
    <div class="card card-primary">
    <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Practical' : 'Add New Practical' }}</h3>
        </div>
        <div class="card-body">
            {{-- <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}"> --}}
            <form>
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select wire:model.live="department_id" id="department_id" class="form-control">
                        <option value="">-- Select Module --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" wire:model.live="title" id="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model.live="description" id="description" class="form-control"></textarea>
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
                        'confirm'     => $editing,
                    ],
                ]" />


            </form>
        </div>
    </div>

    {{-- Department Table --}}
    @include('livewire.admin.practicals.partials.practicals-list')


</div>
