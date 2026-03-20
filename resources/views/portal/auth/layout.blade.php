<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title', 'Authentication') | NKA Hub
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Core styles (Vite or compiled CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AdminLTE / FontAwesome (if you still rely on them) --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    {{-- Allow child views to inject extra CSS --}}
    @stack('styles')
</head>

@php
    /**
     * Guard is always passed explicitly from controllers.
     * Fallback is safe.
     */
    $guard = $guard ?? 'web';
@endphp

<body
    class="
        hold-transition
        login-page
        nka-auth
        nka-auth-{{ $guard }}
    "
>

<div class="login-box">

    {{-- Brand / Logo --}}
    <div class="login-logo mb-3">
        <a href="{{ route('portal.hub') }}">
            <strong>NKA</strong> Hub
        </a>
    </div>

    {{-- Auth Card --}}
    <div class="card card-outline card-primary shadow">

        {{-- Header --}}
        <div class="card-header text-center">
            <h3 class="card-title w-100">
                @yield('header', 'Welcome')
            </h3>

            @isset($guard)
                <small class="text-muted d-block mt-1">
                    {{ ucfirst($guard) }} Portal
                </small>
            @endisset
        </div>

        {{-- Body --}}
        <div class="card-body">
            {{-- Flash messages --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main content --}}
            @yield('content')
        </div>

        {{-- Footer --}}
        <div class="card-footer text-center text-muted small">
            &copy; {{ now()->year }} Negombo Knowledge Academy
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

{{-- Allow child views to inject JS --}}
@stack('scripts')

</body>
</html>
