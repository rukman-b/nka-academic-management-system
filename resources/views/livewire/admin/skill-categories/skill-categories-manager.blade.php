<div>
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Skill Category' : 'Add New Skill Category' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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

    {{-- Skill Categories Table --}}
    @include('livewire.admin.skill-categories.partials.skill-categories-list')


</div>
