@extends('backend.layouts.app')

@section('styles')
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Edit Profile</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	@include('frontend.layouts.partials.alert-messages')
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<div class="m-card-profile__title m--hide">
							Your Profile
						</div>
						<div class="m-card-profile__pic">
							<div class="m-car d-profile__pic-wrapper">	
								<img src="{{auth()->user()->avatar_url}}" alt="">
							</div>
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changeProfileImg">Change Profile</button>
						</div>

						<div class="m-card-profile__details">
							<span class="m-card-profile__name">{{auth()->user()->firstname}}</span>
							<a href="" class="m-card-profile__email m-link">{{auth()->user()->email}}</a>
						</div>
					</div>	
					<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
						<li class="m-nav__separator m-nav__separator--fit"></li>
						<li class="m-nav__section m--hide">
							<span class="m-nav__section-text">Section</span>
						</li>
						<li class="m-nav__item">
							<a href="{{route('backend.account.profile')}}" class="m-nav__link">
								<i class="m-nav__link-icon flaticon-profile-1"></i>
								<span class="m-nav__link-title">  
									<span class="m-nav__link-wrap">      
										<span class="m-nav__link-text">My Profile</span>      
										<span class="m-nav__link-badge"></span>  
									</span>
								</span>
							</a>
						</li>
						<li class="m-nav__item">
							<a href="{{route('backend.account.change-password')}}" class="m-nav__link">
								<i class="m-nav__link-icon flaticon-lock"></i>
								<span class="m-nav__link-text">Chnage Password</span>
							</a>
						</li>
					</ul>

					<div class="m-portlet__body-separator"></div>
				</div>			
			</div>	
		</div>
		<div class="col-xl-9 col-lg-8">
			<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-tools">
						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_user_profile_tab_1" role="tab" aria-selected="true">
									<i class="flaticon-share m--hide"></i>
									Update Profile
								</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="tab-content">
					<div class="tab-pane active show" id="m_user_profile_tab_1">
						<form class="m-form m-form--fit m-form--label-align-right" method="post" id="editProfile" action="{{route('backend.account.postEditProfile')}}">
							<div class="m-portlet__body">
								<input type="text" name="editID" hidden value="{{$udata->id ?? ''}}">
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">First Name</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter firstname" type="text" value="{{$udata->firstname ?? ''}}" name="firstname">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Last Name</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter lastname" type="text" value="{{$udata->lastname ?? ''}}" name="lastname">
									</div>
								</div>
								@csrf

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Username</label>
									<div class="col-7">
										<input class="form-control m-input" type="text" placeholder="Enter username" value="{{$udata->username ?? ''}}" name="username">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Email</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter email id" name="email" value="{{$udata->email ?? ''}}" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Phone No</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter phone number" name="phone_number" value="{{$udata->phone_number ?? ''}}" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Address</label>
									<div class="col-7">
										<input class="form-control m-input" value="{{$address->address ?? ''}}" placeholder ="Enter users Address" name="address" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">City</label>
									<div class="col-7">
										<input class="form-control m-input" value="{{$address->city ?? ''}}" placeholder ="Enter users city" name="city" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">State</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter users state" name="state" value="{{$address->state ?? ''}}" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Postal code</label>
									<div class="col-7">
										<input class="form-control m-input" value="{{$address->zipcode ?? ''}}" placeholder ="Enter users zipcode" name="zipcode" type="text">
									</div>
								</div>

								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Country</label>
									<div class="col-7">
										<select name="country" id="countryList" class="form-select form-control" required="">
											<option value=''>--Select--</option>
											@foreach($country as $countryVal)
											@if(!empty($address->country))
											@if($countryVal->id == $address->country)
											<option value="{{$countryVal->id}}" selected>{{$countryVal->country_name}}</option>
											@else
											<option value="{{$countryVal->id}}">{{$countryVal->country_name}}</option>
											@endif
											@else
											<option value="{{$countryVal->id}}">{{$countryVal->country_name}}</option>
											@endif
											@endforeach
										</select>


									</div>
								</div>


							</div>
							<div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-2">
										</div>
										<div class="col-7">
											<button type="submit" name="btnSubmit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>&nbsp;&nbsp;
											<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="m_user_profile_tab_2">
						
					</div>
					<div class="tab-pane" id="m_user_profile_tab_3">
						
					</div>
				</div>
			</div>
		</div>
	</div>		       
</div>


<!-- change profile image profile Modal -->
<div class="modal fade" id="changeProfileImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="m-login__form m-form" enctype="multipart/form-data" method="post" action="{{route('backend.account.postUpdateProfilePic')}}">
				<div class="modal-body">
					<div class="m-card-profile">
						<div class="m-card-profile__pic">
							<div class="m-card-profile__pic-wrapper">	
								<img src="{{auth()->user()->avatar_url}}" id="defaultProfile" alt="">
							</div>
							@csrf
							<div class="form-group m-form__group">
								<input type="file" accept="image/png,image/jpeg,image/jpg" name="avatar" onchange="loadFile(event)">
							</div>
							@error('password_confirmation')
							<div class="validate_err">{{$message}}</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
	
	var loadFile = function(event) {
		var output = document.getElementById('defaultProfile');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};
$('#countryList').select2();
</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\EditProfile', '#editProfile'); !!}
@endsection