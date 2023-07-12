@extends('layouts.layout')
@section('page')
<div>Patient Sign In</div>

@endsection
@section('content')
<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card-box">
            <div class="section-title text-center pt-0">
                <h3>Patient Login</h3>
            </div>
            <div class="text-descripstion secondary-text text-center">
                Lorem Ipsum is simply dummy <br>
                text of the
            </div>
            <div class="mb-4 text-center">
                <div class="btn-group" role="group">
                    <a href="{{ route('patient.login.show') }}" type="button" class="btn btn-primary btn-rounded">Patient Login</a>
                    <a href="{{ route('patient.register.show') }}" type="button" class="btn btn-secondary btn-rounded">Patient Register</a>
                </div>
            </div>
            <form method="post" action="{{ route('patient.gen.otp') }}" class="contact-form-inner">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                @include('layouts.partials.messages')
                <div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Mobile No<span class="star-red">*</span></label>
                    <input id="mobile_no" class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no') }}" required="required" autocomplete="mobile_no" autofocus placeholder="Enter Your Registered Mobile Number">
                </div>
                @if ($errors->has('mobile_no'))
                <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                @endif
                <div class="single-input-wrap form-group mb-3 text-center">
                    <button class="btn btn-secondary btn-rounded" type="submit">Generate OTP</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('js')

@endpush