@extends('portal.auth.layout')

@section('title', 'Login')
@section('header', 'Sign In')

@section('content')
<form method="POST" action="{{ route($guard . '.login') }}">
    @csrf

    {{-- Email --}}
    <div class="input-group mb-3">
        <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Email address"
            value="{{ old('email') }}"
            required
            autofocus
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    {{-- Password --}}
    <div class="input-group mb-3">
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required
        >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    {{-- Remember me --}}
    <div class="icheck-primary mb-3">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">
            Remember me
        </label>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary btn-block">
        Sign In
    </button>
</form>

{{-- Password reset --}}
<div class="text-center mt-3">
    <a href="{{ route($guard . '.password.request') }}">
        Forgot your password?
    </a>
</div>
{{-- Register --}}
<div class="text-center mt-3">
    <a href="{{ route($guard . '.register') }}">
        Create Account?
    </a>
</div>
@endsection
