
@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{ $user ? 'Edit User' : 'Create User' }}
        </h3>
    </div>

    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="save">

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input wire:model.live="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name">
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input wire:model.live="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">
                    Password
                    @if($user)
                        <small>(Leave blank to keep current password)</small>
                    @endif
                </label>
                <input wire:model.live="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- Roles -->
            <div class="form-group">
                <label for="roles">Roles</label>
                <select wire:model.live="roles" id="roles" class="form-control @error('roles') is-invalid @enderror" multiple>
                    @foreach($allRoles as $roleId => $roleName)
                        <option value="{{ $roleName }}">{{ $roleName }}</option>
                    @endforeach
                </select>
                @error('roles') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">
                {{ $user ? 'Update' : 'Create' }} User
            </button>

        </form>
    </div>
</div>
