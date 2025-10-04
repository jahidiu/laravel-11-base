@extends('layouts.login_app')

@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="login-main g-0 justify-content-center w-100  m-3">
            <div class="login-form">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    <a href="javscript:;" class="auth-brand">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="dark logo" height="24" class="logo-dark mb-0 mt-0">
                        <!-- {{-- <img src="{{asset('assets/images/logo.png')}}" alt="logo light" height="24" class="logo-light"> --}} -->
                    </a>

                    <h3 class="fw-semibold text-center">{{ __('Are You Forgot Your Password ?') }}</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-reset">
                        <form method="POST" action="{{ route('password.email') }}" class="text-start mb-3">
                            @csrf
                            <div class="form-floating  mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your registered email" required autocomplete="email" autofocus>
                                <label class="form-label" for="email">Email</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
