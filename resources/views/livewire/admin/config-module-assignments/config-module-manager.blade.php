<div> {{-- Single root element required by Livewire --}}

    {{-- Top Card: Config Module Form --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Config Module Form</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select wire:model.live="department_id" class="form-control">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                            @error('programme_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="config_id">Programme Config</label>
                            <select wire:model.live="config_id" class="form-control">
                                <option value="">-- Select Config --</option>
                                @foreach($configs as $config)
                                    <option value="{{ $config->id }}">{{ $config->code }}</option>
                                @endforeach
                            </select>
                            @error('config_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="module_id">Module</label>
                            <select wire:model.live="module_id" class="form-control">
                                <option value="">-- Select Module --</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            @error('module_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" wire:model.live="is_optional" class="form-check-input" id="is_optional">
                            <label class="form-check-label" for="is_optional">Optional Module</label>
                        </div>

                        <button class="btn btn-primary" wire:click="save">
                            {{ $editing ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
        </div>
    </div>

    {{-- Bottom Card: Config Module List --}}
    <div class="row mt-4">
        <div class="col-12">
            @include('livewire.admin.config-module-assignments.partials.config-module-list')
        </div>
    </div>

</div>
