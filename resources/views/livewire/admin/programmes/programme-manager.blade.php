@php use Illuminate\Support\Str; @endphp
<div>
    <div class="card card-primary">
       <x-flash-message /> {{-- Flash message --}}
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Programme' : 'Add New Programme' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                {{-- Programme Name --}}
                <div class="form-group">
                    <label for="name">Programme Name</label>
                    <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Short Name --}}
                <div class="form-group">
                    <label for="short_name">Short Name <small>(auto-generated from title, but editable)</small></label>
                    <div class="input-group">
                        <input type="text" wire:model.live="short_name" id="short_name" class="form-control @error('short_name') is-invalid @enderror">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" wire:click="generateShortNameFromName">
                                Regenerate
                            </button>
                        </div>
                    </div>
                    @error('short_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Level to Start --}}
                 <div class="form-group">
                    <label for="starting_level_id">Level to Start</label>
                    <select wire:model.live="starting_level_id" id="starting_level_id" class="form-control">
                        <option value="">-- Select Level --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" @selected($level->id == $starting_level_id)>{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('starting_level_id') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                {{-- Level to be offered --}}
                 <div class="form-group">
                    <label for="offered_level_id">Level to be offered</label>
                    <select wire:model.live="offered_level_id" id="offered_level_id" class="form-control">
                        <option value="">-- Select Level --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" @selected($level->id == $offered_level_id)>{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('offered_level_id') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

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

    {{-- Programmes Table --}}
    @include('livewire.admin.programmes.partials.programmes-list')

</div>
