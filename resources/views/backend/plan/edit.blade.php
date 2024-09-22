@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
	.list-group-item{
		border: none !important;
	}
	.padding-right-4{
		padding-right:4px;
	}
	.padding-top-20{
		padding-top:20px;	
	}
	.m-checkbox-custom{
		margin-top: 35px !important;
		margin-left: 100px !important;
	}
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">Plan Management</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a  href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
					<i class="m-nav__link-icon la la-home"></i>
				</a>
			</li>

			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.plan.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Plan
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.plan.edit',$planData->id)}}" class="m-nav__link">
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
								Edit Plan
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="editPlan" method="POST" action="{{route('backend.plan.update',$planData->id)}}" autocomplete="off">
					@csrf
					@method('PUT')
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label for="name">Name</label>
							<span class="red">*</span>
							<input type="text" class="form-control m-input m-input--square" id="plan_name" name="name" value="{{$planData->name ?? ''}}" placeholder="Enter name">
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="m-form__group form-group">
							<label class="m-checkbox">
								<input type="checkbox" name="is_featured_plan" {{ ($planData->is_featured_plan=='Y') ? 'checked' : '' }}> Featured plan
								<span></span>
							</label>
							@error('is_featured_plan')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="name">Slug</label>
							<span class="red">*</span>
							<div class="input-group">
								<input type="text" name="slug" id="slug" value="{{$planData->slug ?? ''}}" class="form-control" placeholder="Enter slug">
							</div>
							@error('slug')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="short_description">Short Description</label>
							<span class="red">*</span>
							<textarea class="form-control m-input m-input--square" id="short_description" name="short_description" placeholder="Max 150 Character">{!! $planData->short_description ?? '' !!}</textarea>
							@error('short_description')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="interval">Plan Interval</label>
							<span class="red">*</span>
							<select name="interval" class="form-control m-input m-input--square" id="interval" name="interval" required="">
								<option {{ ($planData->interval=='Monthly') ? 'selected' : '' }} value="Monthly">Monthly</option>
								<option {{ ($planData->interval=='Yearly') ? 'selected' : '' }} value="Yearly">Yearly</option>
								<option {{ ($planData->interval=='Lifetime') ? 'selected' : '' }} value="Lifetime">Lifetime</option>
							</select>
							@error('interval')
							<span class="m-form__help error">{{$message}}</span>
							@enderror 
						</div>

						<div class="form-group m-form__group">
							<label for="price">Plan Price</label>
							<span class="red">*</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<span>Free Plan &nbsp;</span>
										<label class="m-checkbox m-checkbox--single">
											<input type="checkbox" name="is_free_plan" {{ ($planData->is_free_plan=='Y') ? 'checked' : '' }}  class="isFreePlan">
											<span></span>
										</label>
									</span>	
									
								</div>
								<input type="text" hidden="" id="priceVal" value="{{$planData->price ?? ''}}">
								<input type="number" name="price" id="price" class="form-control" placeholder="0" value="{{$planData->price ?? ''}}" {{ ($planData->is_free_plan=='Y') ? 'disabled' : '' }} aria-label="Text input with checkbox">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2"><i class="{{Config::get('constants.CURRENCY')}}"></i></span>
								</div>								      	
							</div>
							@error('price')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						@if($planData->is_free_plan=='Y')
						<div class="form-group m-form__group row" id="isLoginRequiredDiv">
							@else
							<div class="form-group m-form__group row" id="isLoginRequiredDiv" style="display: none">
								@endif
								<label class="col-form-label col-lg-2 col-sm-12">Require Login</label>
								<div class="col-lg-4 col-md-9 col-sm-12">
									<input data-switch="true" data-on-text="Yes" data-handle-width="30" data-off-text="No" type="checkbox" name="is_login_required" {{ ($planData->is_login_required=='Y') ? 'checked' : '' }} data-on-color="brand" id="is_login_required">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<div class="col-sm-6">	
									<label for="storage_space">Storage space</label>
									<span class="red">*</span>
									<div class="input-group">
										<input type="number" name="storage_space" class="form-control m-input" placeholder="0" value="{{$storage_space}}" aria-describedby="basic-addon2" id="storageTextBox" {{ !$storage_space ? 'disabled' : '' }}>
										<input type="text" hidden="" value="{{$storage_space}}" id="storageSpaceID">
										<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
									</div>

									@error('storage_space')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
								</div>

								<div class="col-sm-6" id="is_unlimitem_storage">
									<label class="m-checkbox m-checkbox-custom">
										<input type="checkbox" name="is_unlimitem_storage" id="is_unlimitem_storage_id" {{ !$storage_space ? 'checked' : '' }}>Unlimited Storage
										<span></span>
									</label>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<div class="col-sm-6">
									<label for="size_per_file">Size of each file</label>
									<span class="red">*</span>
									<div class="input-group">
										<input type="number" name="size_per_file" value="{{$size_per_file}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2" id="sizeOfFileTextBox" {{ !$size_per_file ? 'disabled' : '' }}>

										<input type="text" hidden="" value="{{$size_per_file}}" id="sizePerFileID">

										<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
									</div>
									@error('size_per_file')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
								</div>

								<div class="col-sm-6" id="is_unlimitem_file_size">
									<label class="m-checkbox m-checkbox-custom">
										<input type="checkbox" name="is_unlimitem_file_size" id="is_unlimitem_file_size_id" {{ !$size_per_file ? 'checked' : '' }}>Unlimited File Size
										<span></span>
									</label>
								</div>

							</div>

							<div class="form-group m-form__group row">
								<div class="col-sm-6">	
									<label for="file_expired_in">Files duration</label>
									<span class="red">*</span>
									<div class="input-group">

										<input type="number" name="file_expired_in" value="{{$planData->file_expired_in ?? ''}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2" id="durationOfFileText" {{ !$planData->file_expired_in ? 'disabled' : '' }}>

										<input type="text" hidden="" value="{{$planData->file_expired_in ?? ''}}" id="fileDurationID">

										<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt me-2 padding-right-4"></i> Days</span></div>
									</div>

									@error('file_expired_in')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
								</div>

								<div class="col-sm-6" id="is_unlimitem_duration">
									<label class="m-checkbox m-checkbox-custom">
										<input type="checkbox" name="is_unlimitem_duration" id="is_unlimitem_duration_id" {{ !$planData->file_expired_in ? 'checked' : '' }}>Unlimited file duration
										<span></span>
									</label>
								</div>
							</div>


							<div class="form-group m-form__group">
								<label for="upload_at_once">Uploaded files at once</label>
								<span class="red">*</span>
								<div class="input-group">
									<input type="number" name="upload_at_once" value="{{$planData->upload_at_once}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2">
									<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-file-alt me-2 padding-right-4"></i> Files</span></div>
								</div>

								@error('upload_at_once')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
							</div>

							<div class="form-group m-form__group row">
								<label class="col-form-label col-sm-3">Allow protect files by password</label>
								<div class="col-sm-3">
									<input data-switch="true" data-on-text="Yes" data-handle-width="30" data-off-text="No" type="checkbox" {{ ($planData->password_protection=='Y') ? 'checked' : '' }} data-on-color="brand" id="password_protection" name="password_protection" data-on-color="brand">
								</div>

								<label class="col-form-label col-sm-3">Show advertisements</label>
								<div class="col-sm-3">
									<input data-switch="true" data-on-text="Yes" data-handle-width="30" data-off-text="No" type="checkbox" {{ ($planData->advertisements=='Y') ? 'checked' : '' }} data-on-color="brand" name="advertisements" id="advertisements">
								</div>
							</div>

							<div id="m_repeater_3" class="padding-top-20"> 
								<div class="form-group  m-form__group row">

									<div data-repeater-list="other_features" class="col-lg-9">
										@if(!empty($planOtherFeature))
										
										@foreach($planOtherFeature as $key => $otherFeatureVal)
										<div data-repeater-item class="row m--margin-bottom-10">
											<div class="col-sm-5">
												<div class="input-group">

													<select name="other_features[{{ $key }}][key]" class="form-control form-select">
														<option value="">--Select--</option>
														<option {{($otherFeatureVal->key=='0') ? 'selected' : '' }} value="0">Not Included</option> 
														<option {{($otherFeatureVal->key=='1') ? 'selected' : '' }} value="1">Included</option>
													</select>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input type="text" class="form-control form-control-danger" value="{{$otherFeatureVal->value}}" name="other_features[{{ $key }}][value]" placeholder="Enter feature name" required="">
												</div>
											</div>        
											<div class="col-sm-2">
												<a href="javascript:void(0)" data-repeater-delete="" style="float:right;"  class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
													<i class="la la-remove"></i>
												</a>
											</div>
										</div> 
										@endforeach     
										@else
										
										<div data-repeater-item class="row m--margin-bottom-10">
											<div class="col-sm-5">
												<div class="input-group">
													<select name="key" class="form-control form-select">
														<option value="">--Select--</option>
														<option value="0">Not Included</option> 
														<option value="1">Included</option>
													</select>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<input type="text" class="form-control form-control-danger" name="value" placeholder="Enter feature name" required="">
												</div>
											</div>        
											<div class="col-sm-2">
												<a href="javascript:void(0)" data-repeater-delete="" style="float:right;"  class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
													<i class="la la-remove"></i>
												</a>
											</div>
										</div> 

										@endif                                   
									</div>  

									<div class="col-sm-3">
										<div data-repeater-create="" class="btn btn btn-primary m-btn m-btn--icon">
											<span>
												<i class="la la-plus"></i>
												<span>Add other feature</span>
											</span>
										</div>
									</div>
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

		$('.isFreePlan').on('change',function(){
			if($('.isFreePlan').is(':checked')){
				$('#isLoginRequiredDiv').show();
				$('#price').attr('disabled','disabled');
				$('#price').val('0');

			}else{
				$('#isLoginRequiredDiv').hide();
				$('#price').removeAttr('disabled');
				$('#price').val($('#priceVal').val());
			}

		})


		$('#is_unlimitem_storage_id').on('change',function(){

			if($('#is_unlimitem_storage_id').is(':checked')){
				$('#storageTextBox').attr('disabled','disabled');
				$('#storageTextBox').val('');
			}else{

				$('#storageTextBox').removeAttr('disabled');
				$('#storageTextBox').val($('#storageSpaceID').val());
			}

		})



		$('#is_unlimitem_file_size_id').on('change',function(){
			if($('#is_unlimitem_file_size_id').is(':checked')){

				$('#sizeOfFileTextBox').attr('disabled','disabled');
				$('#sizeOfFileTextBox').val('');

			}else{

				$('#sizeOfFileTextBox').removeAttr('disabled');
				$('#sizeOfFileTextBox').val($('#sizePerFileID').val());
			}

		})



		$('#is_unlimitem_duration_id').on('change',function(){
			if($('#is_unlimitem_duration_id').is(':checked')){

				$('#durationOfFileText').attr('disabled','disabled');
				$('#durationOfFileText').val('');
			}else{

				$('#durationOfFileText').removeAttr('disabled');
				$('#durationOfFileText').val($('#fileDurationID').val());

			}

		})


		$('#password_protection').bootstrapSwitch();
		$('#advertisements').bootstrapSwitch();
		$('#is_login_required').bootstrapSwitch();


		$('#plan_name').keyup(function(){
			var plan_name=$('#plan_name').val();
			var replace_special_char=plan_name.replace(/[^a-z0-9\s]/gi, '');
			var slug=replace_special_char.replace(/\s/g, '-').toLowerCase();
			$('#slug').val(slug);
		})


		$('#m_repeater_3').repeater({
			//initEmpty:false,
			initEmpty:{{empty($planOtherFeature)?'true':'false'}},
			show: function() {
				$(this).slideDown();                               
			}
		});
	</script>
	{!! JsValidator::formRequest('App\Http\Requests\Backend\PlanRequest', '#editPlan'); !!}
	@endsection