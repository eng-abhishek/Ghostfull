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
                        <h1>Sign Up</h1>
                        <!--     <p>Enter username & password to create your new account</p> -->
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <form action="{{ route('register') }}" method="POST" id="register-form">
                         
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="firstname" class="form-label">First Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" id="firstname" placeholder="Enter firstname" class="form-control">
                                    @error('first_name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="lastname" class="form-label">Last Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" id="lastname" placeholder="Enter lastname" class="form-control">
                                    @error('last_name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="username" class="form-label">Useramne: <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username" placeholder="Enter username" class="form-control">
                                    @error('username')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="email" class="form-label">Email Id: <span class="text-danger">*</span></label>
                                    <input type="text" name="email" id="email" placeholder="Enter email" class="form-control">
                                    @error('email')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="phone_no" class="form-label">Phone no: <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" id="phone_no" placeholder=" Enter phone no" class="form-control">
                                    @error('phone_number')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="password" class="form-label">Password: <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password: <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter password again" class="form-control">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12 text-center">
                                    <input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-outline-light" value="Sign Up">
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
{!! JsValidator::formRequest('App\Http\Requests\Frontend\RegisterRequest', '#register-form'); !!}
@endsection