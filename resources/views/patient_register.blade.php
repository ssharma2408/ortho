@extends('layouts.layout')

@section('page')

<div>Patient Sign In</div>

@endsection

@section('content')


<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card-box">
            <div class="section-title text-center pt-0">
                <h3>Patient Register</h3>
            </div>
            <form method="post" action="{{ route('patient.register.save') }}" class="contact-form-inner">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                @include('layouts.partials.messages')
                <div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Name*</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="" required="required" autocomplete="name" autofocus>
                </div>
                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
                <div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Mobile No*</label>
                    <input id="mobile_no" class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
                </div>
                @if ($errors->has('mobile_no'))
                <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                @endif
                <!--label class="single-input-wrap">
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
				@endif -->
                <div class="single-input-wrap form-group mb-3 text-center">
                    <button class="btn btn-secondary btn-rounded" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush