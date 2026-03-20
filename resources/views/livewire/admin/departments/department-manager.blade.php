<div>
    {{-- Department Form --}}
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Department' : 'Add New Department' }}</h3>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Department Name</label>
                    <input type="text"
                           wire:model.live="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model.live="description"
                              id="description"
                              class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Address Component --}}
                @include('components.address-fields', ['modelPrefix' => 'address.'])

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
    @include('livewire.admin.departments.partials.departments-list')


   
</div>
