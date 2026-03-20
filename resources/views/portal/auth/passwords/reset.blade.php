@extends('portal.auth.layout')

@section('title', 'Set New Password')
@section('header', 'Set New Password')

@section('content')
    <form method="POST" action="{{ route($guard . '.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="guard" value="{{ $guard ?? Guards::default() }}">

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $email) }}" readonly>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control"
                   placeholder="New password" required>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Confirm password" required>
        </div>

        <button type="submit" class="btn btn-success btn-block">
            Reset Password
        </button>
    </form>
@endsection
