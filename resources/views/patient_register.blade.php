@extends('layouts.layout')

@section('page')
 
	<div>Patient Sign In</div>
 
@endsection
 
@section('content')
 
	<div class="ba-page-name text-center mg-bottom-40">
        <h3>Patient Register</h3>
    </div>    
    <div class="signin-area">
        <div class="container">
            <form method="post" action="{{ route('patient.register.save') }}" class="contact-form-inner">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				@include('layouts.partials.messages')
                <label class="single-input-wrap">
                    <span>Name*</span>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="" required="required" autocomplete="name" autofocus>
                </label>
				@if ($errors->has('name'))
					<span class="text-danger text-left">{{ $errors->first('name') }}</span>
				@endif
				<label class="single-input-wrap">
                    <span>Mobile No*</span>
                    <input id="mobile_no" type="text" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
                </label>
				 @if ($errors->has('mobile_no'))
					<span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
				@endif
                <label class="single-input-wrap">
                    <span>Password*</span>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                </label>
				 @if ($errors->has('password'))
					<span class="text-danger text-left">{{ $errors->first('password') }}</span>
				@endif
                <label class="single-input-wrap">
                    <span>Confirm Password*</span>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                </label>
				 @if ($errors->has('password_confirmation'))
					<span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
				@endif

				<button class="btn btn-purple" type="submit">Register</button>               			
            </form>
        </div>
    </div> 
@endsection
 
@push('js')

@endpush