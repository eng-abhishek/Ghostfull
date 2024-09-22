@extends('backend.layouts.app')

@section('styles')
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">User Management</h3>           
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
                 <i class="m-nav__link-icon la la-home"></i>
             </a>
         </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
           <a href="{{route('backend.users.index')}}" class="m-nav__link">
                <span class="m-nav__link-text">Users
                </span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{route('backend.users.create')}}" class="m-nav__link">
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
						Create User
						</h3>
					</div>
				</div>
			</div>
			<!--begin::Form-->
			<form class="m-form m-form--fit m-form--label-align-right" id="createUser" method="POST" action="{{route('backend.users.store')}}">
				@csrf
				<div class="m-portlet__body">
					<div class="form-group m-form__group">
						<label for="firstname">First Name</label>
						<input type="text" class="form-control m-input m-input--square" id="firstname" name="firstname" placeholder="Enter firstname">
						@error('firstname')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="lastname">Last Name</label>
						<input type="text" class="form-control m-input m-input--square" id="lastname" name="lastname" placeholder="Enter lastname">
						@error('lastname')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="Username">Username</label>
						<input type="text" class="form-control m-input m-input--square" id="Username" name="username" placeholder="Enter Username">
						@error('username')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="Emailid">Email Id</label>
						<input type="text" class="form-control m-input m-input--square" id="Emailid" name="email" placeholder="Enter Email Id">
						@error('email')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror 
					</div>

					<div class="form-group m-form__group">
						<label for="phone_number">Phone Number</label>
						<input type="text" class="form-control m-input m-input--square" id="phone_number" name="phone_number" placeholder="Enter phone number">
						@error('phone_number')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="address">Address</label>
						<input type="text" class="form-control m-input m-input--square" id="address" name="address" placeholder="Enter address">
						@error('address')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="city">City</label>
						<input type="text" class="form-control m-input m-input--square" id="city" name="city" placeholder="Enter city">
						@error('city')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="state">State</label>
						<input type="text" class="form-control m-input m-input--square" id="state" name="state" placeholder="Enter state">
						@error('state')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

                    <div class="form-group m-form__group">
						<label for="country">Country</label>
						<select class="form-control m-input m-input--square" id="country" name="country">
						<option value=''>--Select--</option>
                        @foreach($country as $countryVal)
						<option value="{{$countryVal->id}}">{{$countryVal->country_name}}</option>
						@endforeach
						</select>
						@error('country')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="zipcode">Postal code</label>
						<input type="text" class="form-control m-input m-input--square" id="zipcode" name="zipcode" placeholder="Enter postal code">
					    @error('zipcode')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>

					<div class="form-group m-form__group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control m-input m-input--square" id="password" name="password" placeholder="Password">
				        @error('password')
						<span class="m-form__help error">{{$message}}</span>
					    @enderror
					</div>
				
	                <div class="form-group m-form__group">
						<label for="confirm_password">Confirm Password</label>
						<input type="password" class="form-control m-input m-input--square" id="confirm_password" name="confirm_password" placeholder="Password">
						@error('confirm_password')
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
<script>
	var loadFile = function(event) {
		var output = document.getElementById('defaultProfile');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
  }
};
$('#country').select2();
</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\UserRequest', '#createUser'); !!}
@endsection