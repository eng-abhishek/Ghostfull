@extends('frontend.layouts.app')
@section('content')
<main class="d-flex">
    <div class="container-fluid align-self-center">
        <div class="row justify-content-around align-items-center">
            <div class="col-xxl-3 col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 align-self-center d-xl-block d-none text-center">
                <img src="{{asset('assets/frontend/images/login.png')}}" class="img-fluid login-image" alt="">
            </div>
            <div class="col-xxl-3 col-xl-5 col-lg-6 col-md-12 my-lg-0 my-5 py-5 login-wrap">
                @include('frontend.layouts.partials.alert-messages-two')
                <div class="row mb-3">
                    <div class="col-lg-12 text-center">
                        <h1>Login</h1>
                        <p>Enter email id & password to access your account</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <form action="{{ route('login') }}" method="POST" id="login-form">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Email Id: <span class="text-danger">*</span></label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email Id" class="form-control">
                                    @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Password: <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="remember" id="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <p class="m-0"><a href="{{ route('password.request') }}" class="color-link text-light" title="Forgot password?">Forgot password?</a></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 text-center">
                                    <input type="submit" name="btnlogin" id="btnlogin" class="btn btn-outline-light" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Don't have an account? <a href="{{url('register')}}" class="color-link" title="Sign Up">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\LoginRequest', '#login-form'); !!}
@endsection