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
		<h3 class="m-subheader__title m-subheader__title--separator">Storage Provider Setting</h3>           
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
				<a href="{{route('backend.setting.storage-provider.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Storage Provider
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.setting.storage-provider.edit',$storage->id)}}" class="m-nav__link">
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
								Edit Storage Provider
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="storageProviderSetting" method="POST" action="{{route('backend.setting.storage-provider.update',$storage->id)}}">
					@csrf
					@method('PUT')
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label for="name">Name</label>
							<input type="text" class="form-control m-input m-input--square" name="name" value="{{$storage->name ?? ''}}" placeholder="Enter storage name">
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="website_url">Credential</label>
							<input type="text" class="form-control m-input m-input--square" name="credentials" value="{{$storage->credentials ?? ''}}" placeholder="Enter credential">
							@error('credentials')
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\Setting\StorageProviderRequest','#storageProviderSetting'); !!}
@endsection