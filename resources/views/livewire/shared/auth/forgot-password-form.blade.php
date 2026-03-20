<div>

    <h3>{{ ucfirst($guard) }} Password Reset</h3>

    @if ($status)
        <div class="alert alert-success">{{ $status }}</div>
    @endif

    <form wire:submit.prevent="sendResetLink">
        <input type="email" wire:model.lazy="email" placeholder="Enter your email">
        <button type="submit">Send Reset Link12</button>
        <div>

            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </form>
</div>
