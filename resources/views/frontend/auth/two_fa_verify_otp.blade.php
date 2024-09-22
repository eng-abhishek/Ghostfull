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
            <h1>Two Factot Authentication</h1>
            <p>Enter otp, which receive on your email</p>
        </div>
    </div>
    <div class="row mb-3">
      <div class="col-lg-12">
         <form method="POST" action="{{ route('verify-otp') }}" id="forgotPassword">
           @csrf
           <div class="row mb-3">
              <div class="col-lg-12">
                <label for="" class="form-label">OTP: <span class="text-danger">*</span></label>
                <input type="two_factor_code" name="two_factor_code" id="two_factor_code" placeholder="Enter otp" class="form-control">
          
                @error('two_factor_code')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            
            <div class="row mb-3" style="padding-top:10px;">
                <div class="col-lg-12 text-center">    
                  <input type="submit" name="btnOTP" id="btnOTP" class="btn btn-outline-light" value="Submit">
              </div>
          </div>
          @if(Session()->has('otp-status'))
          <div style="padding-top:10px">Time left = <span id="timer"></span></div>
          <input type="text" name="otpVal" hidden id="otpVal" value="1">
          @else
         <input type="text" name="otpVal" hidden id="otpVal" value="0">
       @endif
      </div>
  
  </form>
</div>
</div>
<div class="row">
    <div class="col-lg-12 text-center" id="resendOTP" style="display:none">              
      <p>If you don`t Receive Email - <a href="{{route('resend-otp')}}" class="color-link" title="resend otp">Resend ?</a></p>
  </div>
</div>
</div>
</div>
</div>
</main>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#resendOTP').on('click',function(){
    $('#resendOTP').css('display','none');
})

  if(($('#otpVal').val()==1)){
    $('#resendOTP').css('display','none');
}else{
    $('#resendOTP').css('display','block');
}

let timerOn = true;

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;
    
    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    if(($('#otpVal').val()==1)){
    document.getElementById('timer').innerHTML = m + ':' + s;
    }
    remaining -= 1;
    
    if(remaining >= 0 && timerOn) {
      setTimeout(function() {
        timer(remaining);
    }, 1000);
      return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
}

  // Do timeout stuff here
 // alert('Timeout for otp');

 $('#resendOTP').css('display','block');
}
timer(180);

</script>
@endsection