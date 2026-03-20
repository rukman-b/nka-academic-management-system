@extends('portal.auth.layout')

@section('title', ucfirst($guard) . ' Register')
@section('header', 'Create Account')

@section('content')
<form method="POST" action="{{ route($guard . '.register') }}">
    @csrf

    {{-- Name --}}
    <div class="input-group mb-3">
        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Full name"
            value="{{ old('name') }}"
            required
            autofocus
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    {{-- Email --}}
    <div class="input-group mb-3">
        <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Email address"
            value="{{ old('email') }}"
            required
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="input-group mb-3">
        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Password"
            required
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="input-group mb-3">
        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Confirm password"
            required
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">
        Create Account
    </button>
</form>

<div class="text-center mt-3">
    <a href="{{ route($guard . '.login') }}">
        Already have an account? Sign in
    </a>
</div>
@endsection
