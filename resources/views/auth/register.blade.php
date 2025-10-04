@extends('layouts.admin_auth')
@section('body-class')
    register-page
@endsection
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href=""><b>Admin </b>{{ $siteData['site_name'] }}</a>
        </div>
        <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form method="POST" action="{{ route('register') }}" class="text-start mb-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" />
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" />
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                            placeholder="Confirm Password" />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>
                {{-- <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-danger">
                        <i class="bi bi-google me-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->
                <p class="mb-0">
                    <a href="{{ route('login') }}" class="text-center"> I already have a membership </a>
                </p>
            </div>
            <!-- /.register-card-body -->
        </div>
    </div>
@endsection
