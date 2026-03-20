@extends('portal.auth.layout')

@section('title', 'Reset Password')
@section('header', 'Reset Password')

@section('content')
    <form method="POST" action="{{ route($guard . '.password.email') }}">
        @csrf

        <div class="input-group mb-3">
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email address"
                required
                autofocus
            >

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Send Password Reset Link
        </button>
    </form>
@endsection
