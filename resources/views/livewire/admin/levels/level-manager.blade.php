
<div>
    <div class="card card-primary">
               <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Level' : 'Add New Level' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                <div class="form-group">
                    <label for="fheq_level">FHEQ  Level</label>
                    <input type="number" wire:model.live="fheq_level" id="fheq_level" class="form-control @error('fheq_level') is-invalid @enderror">
                    @error('fheq_level') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="name">Level Name</label>
                    <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model.live="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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

                {{-- <button class="btn btn-success" type="submit">{{ $editing ? 'Update' : 'Create' }}</button>
                @if($editing)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                @endif --}}
            </form>
        </div>
    </div>

    {{-- Level Table --}}
    @include('livewire.admin.levels.partials.levels-list')

</div>
