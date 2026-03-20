@php
    $skinEntry = config('nka.ui.skins.' . app(\App\Services\Auth\GuardResolver::class)->detect(), '');
@endphp


@extends('components.layouts.adminlte-app')

@section('adminlte_css')
    @if(!empty($adminlteSkinEntry))
        @vite($adminlteSkinEntry)
    @endif
@endsection

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'NKA')

@section('content_body')
    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </div>

        <div class="col-2"></div>
    </div>
@endsection
