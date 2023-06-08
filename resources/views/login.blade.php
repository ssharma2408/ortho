@extends('layouts.layout')

@section('page')
 
	<div>Sign In</div>
 
@endsection
 
@section('content')
 
	<div class="ba-page-name text-center mg-bottom-40">
        <h3>Login</h3>
    </div>    
    <div class="signin-area">
        <div class="container">
            <form method="post" action="{{ route('login.perform') }}" class="contact-form-inner">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				@include('layouts.partials.messages')
                <label class="single-input-wrap">
                    <span>Email address*</span>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="" required="required" autofocus>
                </label>
				@if ($errors->has('username'))
					<span class="text-danger text-left">{{ $errors->first('username') }}</span>
				@endif
                <label class="single-input-wrap">
                    <span>Password*</span>
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="" required="required">
                </label>
				 @if ($errors->has('password'))
					<span class="text-danger text-left">{{ $errors->first('password') }}</span>
				@endif
                <div class="single-checkbox-wrap">
                    <input type="checkbox"><span>Remember password</span>
                </div>

				<button class="btn btn-purple" type="submit">Login</button>
                <a class="forgot-btn" href="#">Forgot password?</a>				
            </form>
        </div>
    </div> 
@endsection
 
@push('js')

@endpush