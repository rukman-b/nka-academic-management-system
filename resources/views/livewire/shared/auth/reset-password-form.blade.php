<div>
    <h5 class="mb-4 text-center">Reset Your Employer Password</h5>

    @if ($status)
        <div class="alert alert-success">{{ $status }}</div>
    @endif

    <form wire:submit.prevent="resetPassword">
        <input type="hidden" wire:model="token">

        <div class="input-group mb-3">
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>
        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror

        <div class="input-group mb-3">
            <input type="password" wire:model.lazy="password" class="form-control" placeholder="New Password">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror

        <div class="input-group mb-3">
            <input type="password" wire:model.lazy="password_confirmation" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
    </form>
</div>
