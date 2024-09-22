@extends('backend.layouts.auth')

@section('styles')
<style type="text/css">
.invalid-feedback{
display: block;
}
.captcha{
padding-top: 20px;
float: right;
padding-right: 22px;
}
.captcha-textbox{
padding-left: 17px !important;    
}
</style>
@endsection

@section('content')
<div class="m-login__container">
    <div class="m-login__logo">
        <a href="#">
            <img src="{{asset('assets/backend/images/logo.png')}}">     
        </a>
    </div>
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">Sign In</h3>
        </div>

        @include('backend.layouts.partials.alert-messages')
        
        {!! Form::open(['route' => 'backend.login', 'class' => 'm-login__form m-form', 'id' => 'login-form']) !!}
        <div class="form-group m-form__group">
            {{ Form::text('email', null, array('class' => 'form-control m-input', 'placeholder' => 'Email', 'autocomplete' => 'off', 'autofocus')) }}
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-form__group">
            {{ Form::password('password', array('class'=>'form-control m-input m-login__form-input--last', 'placeholder' => 'Password' , 'autocomplete'=>'off') ) }}
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row">
       
        <div class="form-group m-form__group col-sm-6 captcha-textbox">
            @error('captcha')
            <div class="error">{{ $message }}</div>
            @enderror
            <input id="captcha" type="text" class="form-control m-input" placeholder="Enter Captcha" name="captcha" required="">
        </div>  

        <div class="form-group m-form__group col-sm-6">
            <div class="captcha">
                <span>{!! captcha_img() !!}

                </span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    ↻
                </button>
            </div>
        </div>
    
        </div>

        <div class="row m-login__form-sub">
            <div class="col m--align-left m-login__form-left">
                <label class="m-checkbox  m-checkbox--light">
                    {{Form::checkbox('remember', true, old('remember') ? 'checked' : '' )}} Remember me
                    <span></span>
                </label>
            </div>
        </div>
        <div class="m-login__form-action">
            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">Sign In</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@section('scripts')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\LoginRequest', '#login-form'); !!}
@endsection
@endsection
