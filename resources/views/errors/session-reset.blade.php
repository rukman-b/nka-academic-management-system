@extends('adminlte::page')

@section('title', 'Session Reset')

@section('content_header')
    <h1>We couldn’t open your dashboard</h1>
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Session needs attention
            </h3>
        </div>

        <div class="card-body">
            <p class="mb-2">
                 You’re signed in, but we couldn’t open the right dashboard for your account.
            </p>

            <p class="mb-3">
               This can happen if your sign-in gets confused or interrupted.
            </p>

            <p class="mb-0">
                
                {{ $identity_roles->isNotEmpty() ? '' : 'Please log out and sign in again from the Portal Hub to continue.' }}
            </p>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">
                If this keeps happening, please contact the system administrator.
            </small>
            
            <a href="{{ $dashboard_url }}" class="btn btn-danger">
                <i class="fas {{ $identity_roles->isNotEmpty() ? 'fa-tachometer-alt' : 'fa-redo' }} mr-1"></i>
                {{ $identity_roles->isNotEmpty() ? 'Go to my dashboard' : 'Reset session' }}
            </a>

        </div>
    </div>
@endsection
