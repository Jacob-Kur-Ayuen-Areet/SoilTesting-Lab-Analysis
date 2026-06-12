@extends('layouts.login_master')

@section('content')
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="index-2.html" class="logo-dark">
                        SOILI
                    </a>
                    <a href="index-2.html" class="logo-light">
                       SOILI
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-styled-left alert-dismissible">
                            {{-- <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button> --}}
                            <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                        </div>
                    @endif
                    <!-- form -->

                    <form class="" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Login ID or Email">
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('password.request') }}" class="text-muted float-end"><small>Forgot your
                                    password?</small></a>
                            <label for="password" class="form-label">Password</label>
                            <input required name="password" type="password" class="form-control"
                                placeholder="{{ __('Password') }}">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
                        </div>
                        <!-- social-->

                    </form>
                    <!-- end form-->
                </div>

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                            class="text-muted ms-1"><b>Sign Up</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

  
@endsection
