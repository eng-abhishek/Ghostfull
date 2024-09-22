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
                        <h1>Reset your password</h1>
                        <p>Enter new password to reset your account</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <form action="{{ route('password.update') }}" method="POST" id="reset-password">

                         <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="email" class="form-label">Email Id: <span class="text-danger">*</span></label>
                                
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required readonly autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="password" class="form-label">New Password: <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" placeholder="Enter new password" class="form-control">
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @csrf
                        <input type="text" name="token" value="{{$token}}" hidden="">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="password-confirm" class="form-label">Confirm Password: <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password-confirm" placeholder="Enter new password again" 
                                class="form-control" autocomplete="new-password">

                                @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12 text-center">    
                                <input type="submit" name="btnreset" id="btnreset" class="btn btn-outline-light" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">                            
                    <p>Already have an account? <a href="{{url('login')}}" class="color-link" title="Login">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\ResetPasswordRequest','#reset-password'); !!}
@endsection