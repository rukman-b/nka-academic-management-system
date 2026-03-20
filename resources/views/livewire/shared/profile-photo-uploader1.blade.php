{{-- resources/views/livewire/shared/profile-photo-uploader.blade.php --}}
<div>
    @if (session()->has('success'))
        <x-adminlte-alert theme="success" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <x-adminlte-card title="Upload Profile Photo" icon="fas fa-camera" theme="info">

        <div wire:ignore.self>
            <form wire:submit.prevent="upload" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="photo">Select Profile Image</label>
                    <input type="file"
                        wire:model.live="photo"
                        class="form-control"
                        accept="image/*" />

                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @if ($photo)
                    <div class="mb-3">
                        <label>Preview:</label><br />
                        <img src="{{ $photo->temporaryUrl() }}"
                            class="img-thumbnail"
                            style="max-height: 200px;" />
                    </div>
                @endif

                @if ($photo)
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                @endif
            </form>
        </div>

    </x-adminlte-card>
</div>
