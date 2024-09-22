@extends('frontend.layouts.app')
@section('content')
<main class="d-flex">
    <div class="container-fluid align-self-center">
        <div class="row justify-content-around align-items-center">
            <div class="col-xxl-3 col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 align-self-center d-xl-block d-none text-center">
                <img src="{{asset('assets/frontend/images/login.png')}}" class="img-fluid login-image" alt="">
            </div>
            <div class="col-xxl-3 col-xl-5 col-lg-6 col-md-12 my-lg-0 my-5 py-5 login-wrap">
             
                <div class="row mb-3">
                    <div class="col-lg-12 text-center">
                      @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif
                    
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</div>
</main>
@endsection