{{-- resources/views/livewire/shared/change-password-form.blade.php --}}
<div>
    @if (session()->has('success'))
        <x-adminlte-alert theme="success" title="Success" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <x-adminlte-card title="Change Password" icon="fas fa-lock" theme="primary">
        <form wire:submit.prevent="changePassword">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" wire:model.live="current_password" class="form-control @error('current_password') is-invalid @enderror">
                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" wire:model.live="new_password" class="form-control @error('new_password') is-invalid @enderror">
                @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" wire:model.live="new_password_confirmation" class="form-control">
            </div>

            <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
        </form>
    </x-adminlte-card>
</div>
