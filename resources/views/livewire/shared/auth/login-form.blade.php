<form wire:submit.prevent="login">
    <!-- email input -->
    <div class="input-group mb-3">
        <input type="email" wire:model.lazy="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
        </div>
    </div>
    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror

    <!-- password input -->
    <div class="input-group mb-3">
        <input type="password" wire:model.lazy="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text"><i class="fas fa-lock"></i></div>
        </div>
    </div>
    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror

    <!-- remember me -->
    <div class="form-group form-check">
        <input type="checkbox" wire:model="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember Me</label>
    </div>

    <!-- login button -->
    <button type="submit" class="btn btn-primary btn-block">Login</button>

    <!-- links -->
    <div class="mt-3 text-center">
        <a href="{{ route($guard . '.password.request') }}">Forgot Your Password?</a>
    </div>
    <div class="mt-2 text-center">
        <a href="{{ route($guard . '.register') }}">Don't have an account? Register here</a>
    </div>
    <div class="mt-2 text-center">
        {{ ucfirst($guard) }} 
    </div>
</form>
