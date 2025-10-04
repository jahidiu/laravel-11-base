@extends('layouts.admin_auth')
@section('title')
    Forgot Password
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
        <a href=""><b> Forgot Password </b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Are You Forgot Your Password ?</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="text-start mb-3">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Your Email" value="{{ old('email') }}"
                        required />
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
