{{-- resources/views/errors/403.blade.php --}}
@extends('components.layouts.app')

@section('subtitle', '403 Forbidden')
@section('content_header_title', 'Access Denied')
@section('content_header_subtitle', 'You are signed in but not authorised')

@section('content')
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-ban mr-1"></i>
                403 — Forbidden
            </h3>
        </div>

        <div class="card-body">
            @php $message = trim($exception?->getMessage() ?? '') @endphp

            @if($message !== '')
                <p class="mb-2">{{ $message }}</p>
            @else
                <p class="mb-2">
                    You’re signed in, but you don’t have permission to access this page.
                </p>
            @endif

            <div class="mb-3">
                <div class="mb-1">
                    <strong>Signed in as:</strong>
                    <span class="badge badge-secondary">{{ $identity_user_name }}</span>
                </div>

                @if($identity_guard)
                    <div class="mb-1">
                        <strong>Guard:</strong>
                        <span class="badge badge-info">{{ $identity_guard }}</span>
                    </div>
                @endif

                @if($identity_roles->isNotEmpty())
                    <div class="mb-1">
                        <strong>Role(s):</strong>
                        @foreach($identity_roles as $role)
                            <span class="badge badge-primary">{{ $role }}</span>
                        @endforeach
                    </div>
                @else
                    <div class="callout callout-warning mt-3 mb-1">
                        <p class="mb-0 text-center">
                            <strong>
                                If you believe this is a mistake, please contact your system administrator.
                            </strong>
                        </p>
                    </div>
                @endif
            </div>

            @if(session('error'))
                <div class="alert alert-danger mb-0">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back();">
                <i class="fas fa-arrow-left mr-1"></i> Go Back
            </button>
            
            <a href="{{ $dashboard_url }}" class="btn btn-danger">
                <i class="fas {{ $identity_roles->isNotEmpty() ? 'fa-tachometer-alt' : 'fa-redo' }} mr-1"></i>
                {{ $identity_roles->isNotEmpty() ? 'Go to my dashboard' : 'Reset session' }}
            </a>
        </div>
    </div>
@endsection
