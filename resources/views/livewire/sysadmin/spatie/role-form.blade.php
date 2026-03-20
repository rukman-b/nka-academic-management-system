
{{-- @section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle) --}}

<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="save">
                <div class="modal-content border-0 p-0">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ $mode === 'edit' ? 'Edit Role' : 'Create Role' }}
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" wire:click="closeModal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input wire:model.live="name" type="text" class="form-control" id="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="guard_name">Guard Name</label>
                                <input wire:model.live="guard_name" type="text" class="form-control" id="guard_name">
                                @error('guard_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Permissions</label>
                                @foreach($allPermissions as $perm)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model.live="permissions"
                                               value="{{ $perm->name }}"
                                               id="perm_{{ $perm->id }}">
                                        <label class="form-check-label" for="perm_{{ $perm->id }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

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
          document.addEventListener('livewire:init', () => {
            Livewire.on('showModal', ({ modalId }) => {
              if (!modalId) return;
              $('#' + modalId).modal('show');
            });

            Livewire.on('hideModal', ({ modalId }) => {
              if (!modalId) return;
              $('#' + modalId).modal('hide');
            });
          });
        </script>
    @endpush

</div>
