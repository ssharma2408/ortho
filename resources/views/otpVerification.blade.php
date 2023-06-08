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
            <form method="post" action="{{ route('patient.login.perform') }}" class="contact-form-inner">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				@include('layouts.partials.messages')
                <label class="single-input-wrap">
                    <span>OTP*</span>
                    <input id="otp" type="text" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus placeholder="Enter OTP">
                </label>
				@if ($errors->has('otp'))
					<span class="text-danger text-left">{{ $errors->first('otp') }}</span>
				@endif
				<button class="btn btn-purple" type="submit">Login</button>                				
            </form>
        </div>
    </div> 
@endsection
 
@push('js')

@endpush