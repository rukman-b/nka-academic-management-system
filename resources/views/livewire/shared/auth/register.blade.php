<div>
    <h4 class="text-center mb-4 text-uppercase">{{ ucfirst($guard) }} Registration</h4>

    <form wire:submit.prevent="register">
        <div class="form-group">
            <input wire:model.lazy="name" type="text" class="form-control" placeholder="Name">
            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <input wire:model.lazy="email" type="email" class="form-control" placeholder="Email">
            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <input wire:model.lazy="password" type="password" class="form-control" placeholder="Password">
            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <input wire:model.lazy="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>

        <div class="text-center mt-2">
            <a href="{{ route($guard . '.login') }}">Already registered? Login</a>
        </div>
    </form>
</div>
