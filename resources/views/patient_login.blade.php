@extends('layouts.layout')

@section('page')
 
	<div>Patient Sign In</div>
 
@endsection
 
@section('content')
 
	<div class="ba-page-name text-center mg-bottom-40">
        <h3>Patient Login</h3>
    </div>    
    <div class="signin-area">
        <div class="container">
            <form method="post" action="{{ route('patient.gen.otp') }}" class="contact-form-inner">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				@include('layouts.partials.messages')
                <label class="single-input-wrap">
                    <span>Mobile No*</span>
                    <input id="mobile_no" type="text" name="mobile_no" value="{{ old('mobile_no') }}" required="required" autocomplete="mobile_no" autofocus placeholder="Enter Your Registered Mobile Number">
                </label>
				@if ($errors->has('mobile_no'))
					<span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
				@endif
				<button class="btn btn-purple" type="submit">Generate OTP</button>                				
            </form>
        </div>
    </div> 
@endsection
 
@push('js')

@endpush