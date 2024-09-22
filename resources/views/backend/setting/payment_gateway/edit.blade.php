@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
.logo{
        width: 165px;
		height: 90px;
		padding-top: 5px;
	  }
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">Payment Gateway Setting</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a  href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
					<i class="m-nav__link-icon la la-home"></i>
				</a>
			</li>

			<li class="m-nav__separator">-</li>

			<li class="m-nav__item">
				<a href="javascript:void(0)" class="m-nav__link">
					<span class="m-nav__link-text">Setting
					</span>
				</a>
			</li>
            <li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.payment-gateway.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Payment Gateway
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.payment-gateway.edit',$gateway->id)}}" class="m-nav__link">
					<span class="m-nav__link-text">Edit</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">

	@include('frontend.layouts.partials.alert-messages')
	<div class="row">
		<div class="col-md-12">
			<div class="m-portlet m-portlet--tab">
				<!------ Breadcrumb --------->
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Edit Payment Gateway
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="paymentGatewaySetting" method="POST" enctype="multipart/form-data" action="{{route('backend.setting.payment-gateway.update',$gateway->id)}}">
					@csrf
					@method('PUT')
					<div class="m-portlet__body">
					
						<div class="form-group m-form__group">
							<label for="name">Name</label>
							<input type="text" class="form-control m-input m-input--square" name="name" id="gateway_name" value="{{$gateway->name ?? ''}}" placeholder="Enter storage name">
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

	                	<div class="form-group m-form__group">
							<label for="credentials">Credential</label>
							<input type="text" class="form-control m-input m-input--square" name="credentials" value="{{$gateway->credentials ?? ''}}" placeholder="Enter credential">
							@error('credentials')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="fees">Gateway Fees</label>
							<input type="number" class="form-control m-input m-input--square" name="fees" value="{{$gateway->fees ?? ''}}" placeholder="Enter Gateway Fees">
							@error('fees')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

					    <div class="form-group m-form__group">
							<label for="fees">Min</label>
							<input type="number" class="form-control m-input m-input--square" name="min" value="{{$gateway->min ?? ''}}" placeholder="Enter Gateway Min Fees">
							@error('min')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

                       <div class="form-group m-form__group">
							<label for="logo">Logo</label>
						    <input type="file" name="logo" class="form-control" onchange="LogoFile(event)">
							@error('logo')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
                            @if(!empty($gateway->logo))
                            
                            <img class="logo" src="{{asset('storage/gateway_logo/'.$gateway->logo)}}" id="logo">

                            @else
                            <img class="logo" src="{{asset('assets/backend/images/default-avatar.jpg')}}" id="logo">
                            @endif
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</form>
				<!--end::Form-->			
			</div>
		</div>
	</div>		       
</div>
@endsection

@section('scripts')
<script type="text/javascript">

	var LogoFile = function(event) {
		var output = document.getElementById('logo');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};	

</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\Setting\PaymentGatewayRequest','#paymentGatewaySetting'); !!}
@endsection