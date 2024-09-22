@extends('backend.layouts.app')

@section('styles')
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Change Password</h3>
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
							<div class="m-card-profile__pic-wrapper">
								<img src="{{auth()->user()->avatar_url}}" alt="">
							</div>
						</div>
						<div class="m-card-profile__details">
							<span class="m-card-profile__name"></span>
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
							<a href="{{route('backend.account.profile')}}" class="m-nav__link">
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
									Change Password
								</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="tab-content">
					<div class="tab-pane active show" id="m_user_profile_tab_1">
						<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{route('backend.account.postChangePassword')}}" id="changePassword">
							<div class="m-portlet__body">
								<div class="form-group m-form__group m--margin-top-10 m--hide">
									<div class="alert m-alert m-alert--default" role="alert">
										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
									</div>
								</div>
								
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Current Password</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter current password" type="password" name="current_password">
									</div>
								</div>
								
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">New Password</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter new password" type="password" name="password">
									</div>
								</div>
								@csrf
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">Confirm Password</label>
									<div class="col-7">
										<input class="form-control m-input" placeholder="Enter confirm password" type="password" name="confirm_password">
									</div>
								</div>
								
							</div>
							<div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-2">
										</div>
										<div class="col-7">
											<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom" name="btnsubmit">Save changes</button>&nbsp;&nbsp;
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

@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Backend\ChangePassword', '#changePassword'); !!}
@endsection