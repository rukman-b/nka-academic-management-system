{{-- <div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionModalLabel">
                            {{ $mode === 'edit' ? 'Edit' : 'Create' }} Permission
                        </h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input wire:model.live="name" type="text" class="form-control" id="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard</label>
                            <input wire:model.live="guard_name" type="text" class="form-control" id="guard_name">
                            @error('guard_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $mode === 'edit' ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        Livewire.on('showModal', modalId => {
            $('#' + modalId).modal('show');
        });

        Livewire.on('hideModal', modalId => {
            $('#' + modalId).modal('hide');
        });
    </script>
    @endpush
</div> --}}


<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="save">
                <div class="modal-content border-0 p-0">
                    <div class="card card-primary mb-0">
                        <!-- Card Header -->
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ $mode === 'edit' ? 'Edit' : 'Create' }} Permission
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" wire:click="closeModal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model.live="name" type="text" class="form-control" id="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="guard_name">Guard</label>
                                <input wire:model.live="guard_name" type="text" class="form-control" id="guard_name">
                                @error('guard_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" wire:click="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                {{ $mode === 'edit' ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        Livewire.on('showModal', modalId => {
            $('#' + modalId).modal('show');
        });

        Livewire.on('hideModal', modalId => {
            $('#' + modalId).modal('hide');
        });
    </script>
    @endpush
</div>

