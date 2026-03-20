<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | NKA-HUB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AdminLTE 3 CSS (or custom styles) -->
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Vite -->
    @livewireStyles
</head>
<body class="hold-transition login-page" style="background: #f4f6f9">

<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>NKA</b> Hub</a>
    </div>

    <!-- Card -->
    <div class="card card-outline card-primary shadow">
        <div class="card-header text-center">
            <h3 class="card-title w-100">Welcome Back</h3>
        </div>
        <div class="card-body">
            <!-- Slot for Livewire login form -->
            {{ $slot }}
        </div>

        <div class="card-footer text-center small text-muted">
            &copy; {{ now()->year }} Negombo Knowledge Academy. All rights reserved.
        </div>
    </div>
</div>

<!-- AdminLTE + Livewire Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@livewireScripts
</body>
</html>
