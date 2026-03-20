<div class="row justify-content-center">
    <div class="col-md-8">
        @if (session()->has('success'))
            <x-adminlte-alert theme="success" title="Success" dismissable>
                {{ session('success') }}
            </x-adminlte-alert>
        @endif

        <div class="card card-widget widget-user">
            <!-- Header -->
            <div class="widget-user-header bg-gradient-primary">
                <h3 class="widget-user-username">{{ $name }}</h3>
                <h5 class="widget-user-desc">{{ ucfirst($guard) }} User</h5>
            </div>

            <!-- Image -->
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{ $profile_image_url }}"
                     alt="User Avatar"
                     style="object-fit: cover; width:90px; height:90px;">
            </div>

            <!-- Footer Form -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <form wire:submit.prevent="updateProfile">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" wire:model.live="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" wire:model.live="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ensure same width and alignment --}}
    <div class="col-md-8 mt-3">
        <livewire:shared.profile-photo-uploader />
    </div>
</div>
