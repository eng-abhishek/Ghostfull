@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
	.list-group-item{
		border: none !important;
	}
	.padding-right-4{
		padding-right:4px !important;
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
		<h3 class="m-subheader__title m-subheader__title--separator">Pricing Plan</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
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
				<a href="{{route('backend.plan.create')}}" class="m-nav__link">
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
								Create Plan
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="createPlan" method="POST" action="{{route('backend.plan.store')}}">
					@csrf
					<div class="m-portlet__body">
						
						<div class="form-group m-form__group">
							<label for="name">Plan Name</label>
							<span class="red">*</span>
							<div class="input-group">
								<input type="text" name="name" id="plan_name" class="form-control" placeholder="Enter name" value="{{ old('name') }}" aria-label="Text input with checkbox"/>

							</div>
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="m-form__group form-group">
							<label class="m-checkbox">
								<input type="checkbox" {{ !old('is_featured_plan')?'':'checked' }} name="is_featured_plan"/> Featured plan
								<span></span>
							</label>
						</div>

						<div class="form-group m-form__group">
							<label for="name">Slug</label>
							<span class="red">*</span>
							<div class="input-group">
								<input type="text" name="slug" value="{{ old('slug') }}" id="slug" class="form-control" placeholder="Enter slug"/>
							</div>
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="short_description">Short Description</label>
							<span class="red">*</span>
							<textarea class="form-control m-input m-input--square" id="short_description" name="short_description" placeholder="Max 150 Character">{!! old('short_description') !!}</textarea>
							@error('short_description')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="interval">Plan Interval</label>
							<span class="red">*</span>
							<select name="interval" value="{{ old('interval') }}" class="form-control m-input m-input--square" id="interval" name="interval" required="">
								<option {{(old('interval')=='Monthly') ? 'selected':'' }} value="Monthly">Monthly</option>
								<option {{(old('interval')=='Yearly') ? 'selected':'' }} value="Yearly">Yearly</option>
								<option {{(old('interval')=='Lifetime') ? 'selected':'' }} value="Lifetime">Lifetime</option>
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
											<input type="checkbox" {{ !old('is_free_plan') ?'':'checked' }} name="is_free_plan" class="isFreePlan"/>
											<span></span>
										</label>
									</span>	
								</div>
								<input type="number" name="price" id="price" value="{{ old('price') }}" {{ !old('is_login_required') ?'':'disabled'}} class="form-control" placeholder="0" aria-label="Text input with checkbox"/>
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2"><i class="{{Config::get('constants.CURRENCY')}}"></i></span>
								</div>								      	
							</div>
							@error('price')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group row" id="isLoginRequiredDiv" style="display:{{ !old('is_login_required') ? 'none':''}}">
							<label class="col-form-label col-sm-3">Require Login</label>
							<div class="col-sm-3">
								<input data-switch="true" data-on-color="brand" type="checkbox" checked="checked" {{ !old('is_login_required') ?'':'checked'}} data-on-text="Yes" data-handle-width="30" data-off-text="No" name="is_login_required" id="is_login_required"/>
							</div>
						</div>

						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label for="storage_space">Storage space</label>
								<span class="red">*</span> 
								<div class="input-group">
									<input type="number" name="storage_space" class="form-control" placeholder="0" value="{{ old('storage_space') }}" id="storageTextBox" {{ !old('is_unlimitem_storage')?'':'disabled' }}/>
									<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
								</div>
								@error('storage_space')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
							</div>
							<div class="col-lg-6">

								<label class="m-checkbox m-checkbox-custom">
									<input type="checkbox" {{ !old('is_unlimitem_storage')?'':'checked' }} name="is_unlimitem_storage" id="is_unlimitem_storage_id"/>Unlimited Storage
									<span></span>
								</label>

							</div>
						</div>

						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label for="size_per_file">Size of each file</label>
								<span class="red">*</span>
								<div class="input-group">
									<input type="number" name="size_per_file" class="form-control m-input" placeholder="0" value="{{ old('size_per_file') }}" aria-describedby="basic-addon2" id="sizeOfFileTextBox" {{ !old('is_unlimitem_file_size')?'':'disabled' }}/>
									<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
								</div>
								@error('size_per_file')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
							</div>
							<div class="col-lg-6">
								<label class="m-checkbox m-checkbox-custom">
									<input type="checkbox" {{ !old('is_unlimitem_file_size') ? '':'checked'}} name="is_unlimitem_file_size" id="is_unlimitem_file_size_id"/>Unlimited File Size
									<span></span>
								</label>
							</div>
						</div>


						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label for="file_expired_in">Files duration</label>
								<span class="red">*</span>
								<div class="input-group">
									<input type="number" name="file_expired_in" class="form-control m-input" placeholder="0" value="{{ old('file_expired_in') }}" aria-describedby="basic-addon2" id="durationOfFileText" {{ !old('is_unlimitem_duration')?'':'disabled' }}/>
									<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt me-2 padding-right-4"></i> Days</span></div>
								</div>

								@error('file_expired_in')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
							</div>
							<div class="col-lg-6" id="is_unlimitem_duration">
								<label class="m-checkbox m-checkbox-custom">
									<input type="checkbox" name="is_unlimitem_duration" {{ !old('is_unlimitem_duration') ?'':'checked' }} id="is_unlimitem_duration_id"/>Unlimited file duration
									<span></span>
								</label>
							</div>
						</div>


						<div class="form-group m-form__group">
							<label for="upload_at_once">Uploaded files at once</label>
							<span class="red">*</span>
							<div class="input-group">
								<input type="number" name="upload_at_once" class="form-control m-input" placeholder="0" value="{{ old('upload_at_once') }}" aria-describedby="basic-addon2"/>
								<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-file-alt me-2 padding-right-4"></i> Files</span></div>
							</div>
							@error('upload_at_once')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group row">
							<label class="col-form-label col-sm-3">Allow protect files by password</label>
							<div class="col-sm-3">
								<input data-switch="true" data-on-color="brand" type="checkbox" data-on-text="Yes" data-handle-width="30" data-off-text="No" name="password_protection" {{ !old('password_protection')?'':'checked' }} id="password_protection"/>
							</div>
							<label class="col-form-label col-lg-3">Show advertisements</label>
							<div class="col-lg-3">
								<input data-switch="true" data-on-color="brand" type="checkbox" data-on-text="Yes" {{ !old('advertisements') ? '':'checked' }} data-handle-width="30" data-off-text="No" name="advertisements" id="advertisements"/>
							</div>
						</div>

						<div id="m_repeater_3" class="padding-top-20"> 
							<div class="form-group  m-form__group row">
								
								<div data-repeater-list="other_features" class="col-lg-9">         
									@if(!empty(old('other_features')))

									@foreach(old('other_features') as $key => $otherFeatureVal)
									<div data-repeater-item class="row m--margin-bottom-10">
										<div class="col-sm-5">
											<div class="input-group">

												<select name="other_features[{{ $key }}][key]" class="form-control form-select">
													<option {{($otherFeatureVal['key']=='0') ? 'selected' : '' }} value="0">Not Included</option> 
													<option {{($otherFeatureVal['key']=='1') ? 'selected' : '' }} value="1">Included</option>
												</select>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control form-control-danger" value="{{$otherFeatureVal['value']}}" name="other_features[{{ $key }}][value]" placeholder="Enter feature name" required="">
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
												
												<select name="key" class="form-control form-select" required="">
													<option value="">--Select--</option> 
													<option value="0">Not Included</option> 
													<option value="1">Included</option>
												</select>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
												
												<input type="text" class="form-control form-control-danger" name="value" placeholder="Enter feature name" required=""/>
											</div>
										</div>        
										<div class="col-sm-2">
											<a href="javascript:void(0)" style="" data-repeater-delete="" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
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
			$('#price').val('0');
		}

	})

	$('#is_unlimitem_storage_id').on('change',function(){

		if($('#is_unlimitem_storage_id').is(':checked')){
			$('#storageTextBox').attr('disabled','disabled');
			$('#storageTextBox').val('');
		}else{

			$('#storageTextBox').removeAttr('disabled');
		}

	})
	


	$('#is_unlimitem_file_size_id').on('change',function(){
		if($('#is_unlimitem_file_size_id').is(':checked')){

			$('#sizeOfFileTextBox').attr('disabled','disabled');
			$('#sizeOfFileTextBox').val('');
		}else{

			$('#sizeOfFileTextBox').removeAttr('disabled');
			
		}

	})



	$('#is_unlimitem_duration_id').on('change',function(){
		if($('#is_unlimitem_duration_id').is(':checked')){

			$('#durationOfFileText').attr('disabled','disabled');
			$('#durationOfFileText').val('');
		}else{

			$('#durationOfFileText').removeAttr('disabled');
			
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

	function remove_feture(val){
		$('#customFeatures'+val).remove();
	}

	$('#m_repeater_3').repeater({
		initEmpty: {{empty(old('other_features')) ? 'true':'false' }},
		show: function() {
			$(this).slideDown();                               
		},
	});

</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\PlanRequest', '#createPlan'); !!}
@endsection


