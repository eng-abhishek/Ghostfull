@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
	.logo{
		width: 165px;
		height: 90px;
		padding-top: 5px;
		margin-left: 20px;
	}
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">General Setting</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
					<i class="m-nav__link-icon la la-home"></i>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.general')}}" class="m-nav__link">
					<span class="m-nav__link-text">Setting
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.general')}}" class="m-nav__link">
					<span class="m-nav__link-text">General</span>
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
								General Setting
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="generalSetting" method="POST" enctype="multipart/form-data" action="{{route('backend.setting.general.update')}}">
					@csrf
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label for="website_name">Site Name</label>
							<input type="text" class="form-control m-input m-input--square" name="website_name" value="{{$website_name['value'] ?? ''}}" placeholder="Enter website name">
							@error('website_name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="website_url">Site URL</label>
							<input type="text" class="form-control m-input m-input--square" name="website_url" value="{{$website_url['value'] ?? ''}}" placeholder="Enter website URL">
							@error('website_url')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="contact_person_name">Contact Person Name</label>
							<input type="text" class="form-control m-input m-input--square"name="contact_person_name" value="{{$contact_person_name['value'] ?? ''}}" placeholder="Enter Contact Person Name">
							@error('contact_person_name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="Emailid">Contact Person Email</label>
							<input type="text" class="form-control m-input m-input--square" name="contact_person_email" value="{{$contact_person_email['value'] ?? ''}}" placeholder="Contact Email Id">
							@error('email')
							<span class="m-form__help error">{{$message}}</span>
							@enderror 
						</div>

						<div class="form-group m-form__group">
							<label for="website_timezone">Timezone</label>
							<input type="text" hidden="" value="{{$website_timezone['value'] ?? ''}}" id="website_timezone_hidden">
							<select class="form-control m-input m-input--square" id="website_timezone" name="website_timezone">         

								@foreach (timezonesArray() as $timezoneKey => $timezoneValue)
								<option value="{{ $timezoneKey }}" @if(!empty($website_timezone['value'])) @if ($timezoneKey == $website_timezone['value']) selected @endif @endif>
									{{ $timezoneValue }}
								</option>
								@endforeach
							</select>


							@error('website_timezone')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="address">Expired subscription file delete after</label>
							<select class="form-control m-input m-input--square" name="expired_subscription_file_delete_after" class="form-select">
								<option value="">--Select--</option>
								<option {{ ( $remove_file =='7') ? 'selected':''}} value="7">7 days</option>
								<option {{ ( $remove_file =='30') ? 'selected':''}} value="30">1 Month</option>
								<option {{ ( $remove_file =='180') ? 'selected':''}} value="180">6 Months</option>
								<option {{ ( $remove_file =='364') ? 'selected':''}} value="364">1 Year</option>
							</select>

							@error('address')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group row">
							<h3>Logo & Fevicon</h3>
						</div>

						<div class="form-group m-form__group row">
							<div class="col-sm-4">
								<label for="state">Dark Logo (required size 112*50px)</label>
								<input type="file" class="form-control m-input m-input--square" name="website_dark_logo" onchange="loadDarkFile(event)">
								@error('website_dark_logo')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
								@if(!empty($website_dark_logo))
								<img class="logo" src="{{asset('storage/logo/'.$website_dark_logo)}}" id="darklogo">
								@else
								<img class="logo" src="{{asset('assets/backend/images/default-avatar.jpg')}}" id="darklogo">
								@endif

							</div>

							<div class="col-sm-4">
								<label for="state">Light Logo</label>
								<input type="file" class="form-control m-input m-input--square" name="website_light_logo" onchange="loadLightFile(event)">
								@error('website_light_logo')
								<span class="m-form__help error">{{$message}}</span>
								@enderror

								@if(!empty($website_light_logo))
								<img class="logo" src="{{asset('storage/logo/'.$website_light_logo)}}" id="lightlogo">
								@else
								<img class="logo" src="{{asset('assets/backend/images/default-avatar.jpg')}}" id="lightlogo">
								@endif
							</div>

							<div class="col-sm-4">
								<label for="state">Fevicon Icon</label>
								<input type="file" class="form-control m-input m-input--square" name="website_fevicon_icon" onchange="loadFeviconIcon(event)">
								@error('website_fevicon_icon')
								<span class="m-form__help error">{{$message}}</span>
								@enderror

								@if(!empty($website_fevicon_icon))
								<img class="logo" src="{{asset('storage/logo/'.$website_fevicon_icon)}}" id="feviconIcon">
								@else
								<img class="logo" src="{{asset('assets/backend/images/default-avatar.jpg')}}" id="feviconIcon">
								@endif

							</div>

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
<script>

	var loadDarkFile = function(event) {
		var output = document.getElementById('darklogo');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};

var loadLightFile = function(event) {
	var output = document.getElementById('lightlogo');
	output.src = URL.createObjectURL(event.target.files[0]);
	output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};

var loadFeviconIcon = function(event) {
	var output = document.getElementById('feviconIcon');
	output.src = URL.createObjectURL(event.target.files[0]);
	output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};

$('#website_timezone').select2();
</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\Setting\GeneralSettingRequest', '#generalSetting'); !!}
@endsection
