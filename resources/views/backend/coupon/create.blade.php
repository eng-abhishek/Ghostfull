@extends('backend.layouts.app')

@section('styles')

@endsection

@section('content')
<!-- BEGIN: Subheader -->
<!------ Breadcrumb --------->
<div class="m-subheader">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">Coupon</h3>           
		<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			<li class="m-nav__item m-nav__item--home">
				<a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
					<i class="m-nav__link-icon la la-home"></i>
				</a>
			</li>
			
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.coupon.index')}}" class="m-nav__link">
					<span class="m-nav__link-text">Coupon
					</span>
				</a>
			</li>
			<li class="m-nav__separator">-</li>
			<li class="m-nav__item">
				<a href="{{route('backend.coupon.create')}}" class="m-nav__link">
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
								Create Coupon
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="couponID" method="POST" action="{{route('backend.coupon.store')}}">
					@csrf
					<div class="m-portlet__body">
						
						<div class="form-group m-form__group">
							<label for="name">Name</label>
							<input type="text" class="form-control m-input m-input--square" name="name" value="{{ old('name') }}" placeholder="Enter coupon name">
							@error('name')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="code">Code</label>
							<input type="text" class="form-control m-input m-input--square" name="code" value="{{ old('code') }}" placeholder="Enter coupon code">
							@error('code')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="plan">Plan</label>
							<select class="form-control m-input m-input--square" id="plan_id" name="plan_id">
								<option value="all">All</option>
								@foreach($plan as $planData)
								<option {{( old('plan_id') == $planData->id) ? 'selected' : ''}} value="{{$planData->id}}">{{$planData->name}}</option>
								@endforeach
							</select>
							@error('plan')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="description">Description</label>
							<textarea  class="form-control m-input m-input--square" name="description" placeholder="Enter description">{!! old('description') !!}</textarea>
							@error('description')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="discount_type">Discount Type</label>
							<select class="form-control m-input m-input--square" name="discount_type">
								<option value="">--Select--</option>
								<option {{( old('discount_type') == "fixed") ? 'selected' : ''}} value="fixed">Fixed</option>
								<option {{( old('discount_type') == "percentage") ? 'selected' : ''}} value="percentage">Percentage</option>
							</select>
							@error('discount_type')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="port">Discount Value</label>
							<input type="number" class="form-control m-input m-input--square" name="discount_amount" value="{{ old('discount_amount') }}" placeholder="Enter discount value">
							@error('discount_amount')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="port">Limit per user</label>
							<input type="text" class="form-control m-input m-input--square" name="limit_per_user" value="{{ old('limit_per_user') }}" placeholder="Enter from name">
							@error('limit_per_user')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>

						<div class="form-group m-form__group">
							<label for="start_date">Start Date</label>
							<div class="input-group date">
								<input type="text" class="form-control m-input" readonly="" placeholder="Select date &amp; time" value="{{ old('start_date') }}" name="start_date" id="m_datepicker_start_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
								</div>
							</div>
							@error('start_date')
							<span class="m-form__help error">{{$message}}</span>
							@enderror
						</div>


						<div class="form-group m-form__group">
							<label for="end_date">End Date</label>
							<div class="input-group date">
								<input type="text" class="form-control m-input" readonly="" placeholder="Select date &amp; time" value="{{ old('end_date') }}" name="end_date" id="m_datepicker_end_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
								</div>
							</div>
							@error('end_date')
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
<script type="text/javascript">

	var todaydate = new Date();
	console.log(todaydate);
	$('#m_datepicker_start_date').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'top-right',
		format: 'dd-mm-yyyy hh:ii',
		startDate: todaydate, 
	});


	$('#m_datepicker_end_date').datetimepicker({
		todayHighlight: true,
		autoclose: true,
		pickerPosition: 'top-right',
		format: 'dd-mm-yyyy hh:ii',
		startDate: todaydate,  

	});
	
	$('#plan_id').select2();
</script>

{!! JsValidator::formRequest('App\Http\Requests\Backend\CouponRequest', '#couponID'); !!}
@endsection