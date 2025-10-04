@extends('layouts.admin_auth')
@section('title')
    Reset Password
@endsection
@push('css')
    <style>
        .card-body.login-card-body {
            min-width: 340px;
        }
    </style>
@endpush
@section('body-class')
    login-page
@endsection
@section('content')
    <div class="login-logo">
        <a href=""><b>Password Reset </b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p class="login-box-msg">Reset Your Password</p>
            <form method="POST" action="{{ route('password.update') }}" class="text-start mb-3">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Enter your registered email"
                        required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        value="{{ old('password') }}" placeholder="Enter new password" required
                        autocomplete="password" autofocus>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" value="{{ old('password_confirmation') }}"
                        placeholder="Enter confirm password" required autocomplete="new-password" autofocus>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
