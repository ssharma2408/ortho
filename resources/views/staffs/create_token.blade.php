@extends('layouts.layout')

@section('page')

<div>Create Token</div>

@endsection

@section('content')


<div class="row">
    <div class="col-lg-12 mx-auto">
        
		<div class="section-title text-center pt-0">
			<h3 class="text-uppercase">Create Token</h3>           
		</div>
	  
		<form method="post" action="{{route('staff.create.token')}}" class="contact-form-inner">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />			
			
			<div class="single-input-wrap form-group mb-3">
				<label class="form-label">Mobile No*</label>
				<div class="input-box" style="position: relative;">
					<span class="prefix position-absolute top-50 start-0 translate-middle ms-4">+91</span>
					<input id="mobile_no" class="form-control ps-5" type="text" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
				</div>
			</div>
			@if ($errors->has('mobile_no'))
			<span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
			@endif

			<div class="single-input-wrap form-group mb-3 text-center">
				<button class="btn btn-secondary btn-rounded" type="submit">Create Token</button>
			</div>
			<input type="hidden" name="doctor_id" value="{{$doctor_id}}" />
			<input type="hidden" name="slot_id" value="{{$slot_id}}" />
		</form>
        
    </div>
</div>
@endsection