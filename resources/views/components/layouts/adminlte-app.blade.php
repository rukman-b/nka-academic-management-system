{{-- resources/views/components/layouts/adminlte-app.blade.php --}}
@php $guard = app(\App\Services\Auth\GuardResolver::class)->detect(); @endphp
@extends('adminlte::page')

{{-- Page <title> --}}
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@endsection

@section('content_top_nav_right')
    @include('components.navbar.notification-bell')
@endsection

{{-- Page header title and optional subtitle --}}
@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@endsection



{{--  Main page content area --}}
@section('content')
    {{-- This div is required for Livewire root tag support --}}
    <div>
        @yield('content_body')
    </div>
@endsection

{{-- Footer --}}
@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@endsection

{{-- Global JS --}}
@push('js')
<script>
    // Add custom scripts here if needed
</script>
@endpush

{{-- Global CSS --}}
@push('css')
<style type="text/css">
    /* Example AdminLTE customization */
    /*
    .card-header {
        border-bottom: none;
    }

    .card-title {
        font-weight: 600;
    }
    */
</style>
@endpush
