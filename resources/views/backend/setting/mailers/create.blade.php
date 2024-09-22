@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
	.logo{
		width: 165px;
		height: 90px;
		padding-top: 5px;
		margin-left: 60px;
	}
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">Mailer Setting</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
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
				<a href="{{route('backend.setting.mailers.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Mailers
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.mailers.create')}}" class="m-nav__link">
					<span class="m-nav__link-text">Create</span>
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
								Create Mailer
							</h3>
						</div>
					</div>

				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="mailerSetting" method="POST" action="{{route('backend.setting.mailers.store')}}">
					@csrf
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label for="website_name">Driver Name</label>
							<input type="text" class="form-control m-input m-input--square" name="driver" value="{{$mailer->driver ?? ''}}" placeholder="Enter driver name">
							@error('driver')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="website_url">Host Name</label>
							<input type="text" class="form-control m-input m-input--square" name="host" value="{{$mailer->host ?? ''}}" placeholder="Enter host name">
							@error('host')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="port">Port No</label>
							<input type="text" class="form-control m-input m-input--square"name="port" value="{{$mailer->port ?? ''}}" placeholder="Enter port no">
							@error('port')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="Emailid">Encryption</label>
							<select class="form-control" name="encryption">
								<option value="">--Select--</option>
								<option value="tls">TLS</option>
								<option value="ssl">SSL</option>
							</select>
							@error('encryption')
							<span class="m-form__help error">{{$message}}</span>
							@enderror 
						</div>

						<div class="form-group m-form__group">
							<label for="port">Password</label>
							<input type="text" class="form-control m-input m-input--square" name="password" value="{{$mailer->password ?? ''}}" placeholder="Enter password">
							@error('password')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="port">From Name</label>
							<input type="text" class="form-control m-input m-input--square" name="from_name" value="{{$mailer->from_name ?? ''}}" placeholder="Enter from name">
							@error('from_name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>


						<div class="form-group m-form__group">
							<label for="port">From Email</label>
							<input type="text" class="form-control m-input m-input--square" name="from_email" value="{{$mailer->from_email ?? ''}}" placeholder="Enter from email">
							@error('from_email')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\Setting\MailerSettingRequest', '#mailerSetting'); !!}
@endsection