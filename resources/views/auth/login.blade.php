@extends('layouts.admin_auth')
@section('title')
    Login
@endsection
@section('body-class')
    login-page
@endsection
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin </b>{{ $siteData['site_short_name'] }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form method="POST" action="{{ route('login') }}" class="text-start mb-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" placeholder="Email Or Username" value="{{ old('login') }}"
                            required />
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        @error('login')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password"
                            required />
                        <div class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                            <span id="toggleIcon" class="bi bi-lock-fill"></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
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
                <p class="mb-1"><a href="{{ route('password.request') }}">I forgot my password</a></p>
                {{-- <p class="mb-0">
                    <a href="register.html" class="text-center"> Register a new membership </a>
                </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
<script>
    function togglePassword() {
        const password = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("bi-lock-fill");
            icon.classList.add("bi-unlock-fill");
        } else {
            password.type = "password";
            icon.classList.remove("bi-unlock-fill");
            icon.classList.add("bi-lock-fill");
        }
    }
</script>
