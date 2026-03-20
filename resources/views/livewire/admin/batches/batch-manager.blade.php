<div>
    {{-- Top Card: Create / Edit Form --}}
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Batch' : 'Add New Batch' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">

                 {{-- Department Dropdown --}}
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select wire:model.live="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" @selected($department_id == $dept->id)>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="programme_id">Programme</label>
                    <select wire:model.live="programme_id" class="form-control @error('programme_id') is-invalid @enderror">
                        <option value="">-- Select Programme --</option>
                        @foreach($programmes as $programme)
                            <option value="{{ $programme->id }}" @selected($programme_id == $programme->id)>{{ $programme->name }}</option>
                        @endforeach
                    </select>
                    @error('programme_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="config_id">Config</label>
                    <select wire:model.live="config_id" class="form-control @error('config_id') is-invalid @enderror">
                        <option value="">-- Select Config --</option>
                        @foreach($configs as $config)
                            <option value="{{ $config->id }}" @selected($config_id == $config->id)>{{ $config->code }}</option>
                        @endforeach
                    </select>
                    @error('config_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                <label for="code">Batch Code</label>
                <div class="input-group">
                    <input type="text" wire:model.live="code" class="form-control @error('code') is-invalid @enderror">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" wire:click="generateBatchCode">Auto-Generate</button>
                    </div>
                </div> 
                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
            </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_date">Start Date</label>
                        <input type="date" wire:model.live="start_date" class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date">Expected End Date (tentative)</label>
                        <input type="date" wire:model.live="end_date" class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" wire:model="status" class="form-check-input" id="status">
                    <label class="form-check-label" for="status">Active</label>
                </div>

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

    {{-- Bottom Card: Batch List --}}
    @include('livewire.admin.batches.partials.batch-list')

</div>
