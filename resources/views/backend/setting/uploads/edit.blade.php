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
		<h3 class="m-subheader__title m-subheader__title--separator">Upload Setting</h3>           
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
				<a href="{{route('backend.setting.uploads.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Uploads
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.uploads.edit',$uploads->id)}}" class="m-nav__link">
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
								Edit Upload
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="uploadSetting" method="POST" action="{{route('backend.setting.uploads.update',$uploads->id)}}">
					@csrf
					@method('PUT')
					<div class="m-portlet__body">

	                  <div class="form-group m-form__group">
							<label for="name">Name</label>
							<span class="red">*</span>
							<input type="text" class="form-control m-input m-input--square" id="plan_name" name="name" value="{{$uploads->name ?? ''}}" placeholder="Enter name">
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>


						  <div class="form-group m-form__group">
									<label for="storage_space">Storage space</label>
									<span class="red">*</span>
									<div class="input-group">
										<input type="number" name="storage_space" class="form-control m-input" placeholder="0" value="{{$storage_space}}" aria-describedby="basic-addon2">
										
										<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
									</div>

									@error('storage_space')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
								</div>

							 <div class="form-group m-form__group">
									<label for="size_per_file">Size of each file</label>
									<span class="red">*</span>
									<div class="input-group">
										<input type="number" name="size_per_file" value="{{$size_per_file}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2">
                                   
                                         <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-hdd me-2 padding-right-4"></i> MB</span></div>
									</div>
									@error('size_per_file')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
				                </div>

                                <div class="form-group m-form__group">
									<label for="file_expired_in">Files duration</label>
									<span class="red">*</span>
									<div class="input-group">

										<input type="number" name="file_expired_in" value="{{$uploads->file_expired_in ?? ''}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2">

										<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt me-2 padding-right-4"></i> Days</span></div>
									</div>

									@error('file_expired_in')
									<span class="m-form__help error">{{$message}}</span>
									@enderror
								</div>



							<div class="form-group m-form__group">
								<label for="upload_at_once">Uploaded files at once</label>
								<span class="red">*</span>
								<div class="input-group">
									<input type="number" name="upload_at_once" value="{{$uploads->upload_at_once}}" class="form-control m-input" placeholder="0" aria-describedby="basic-addon2">
									<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fas fa-file-alt me-2 padding-right-4"></i> Files</span></div>
								</div>

								@error('upload_at_once')
								<span class="m-form__help error">{{$message}}</span>
								@enderror
							</div>

								<div class="form-group m-form__group row">
								<label class="col-form-label col-sm-3">Allow protect files by password</label>
								<div class="col-sm-3">
									<input data-switch="true" data-on-text="Yes" data-handle-width="30" data-off-text="No" type="checkbox" {{ ($uploads->password_protection=='Y') ? 'checked' : '' }} data-on-color="brand" id="password_protection" name="password_protection" data-on-color="brand">
								</div>

								<label class="col-form-label col-sm-3">Show advertisements</label>
								<div class="col-sm-3">
									<input data-switch="true" data-on-text="Yes" data-handle-width="30" data-off-text="No" type="checkbox" {{ ($uploads->advertisements=='Y') ? 'checked' : '' }} data-on-color="brand" name="advertisements" id="advertisements">
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
<script type="text/javascript">
	$('#password_protection').bootstrapSwitch();
	$('#advertisements').bootstrapSwitch();
</script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\Setting\UploadsRequest', '#uploadSetting'); !!}
@endsection