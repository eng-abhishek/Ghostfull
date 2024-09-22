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
                        <h1>Recover Account</h1>
                        <p>Enter email id to reset your account</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                     <form method="POST" action="{{ route('password.email') }}" id="forgotPassword">
                         @csrf
                         <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label">Email Id: <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control">
                                @error('email')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12 text-center">                                        
                                <input type="submit" name="sendEmail" id="sendEmail" class="btn btn-outline-light" value="Recover">
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
{!! JsValidator::formRequest('App\Http\Requests\Frontend\ForgotPasswordRequest', '#forgotPassword'); !!}
@endsection