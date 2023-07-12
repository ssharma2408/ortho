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
               <div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Gender*</label>
                    <select name="gender" required>
						<option value="">Please Select</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
						<option value="3">Other</option>
					</select>
                </div>
                @if ($errors->has('gender'))
                <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                @endif
				<div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" max="<?php echo date('Y-m-d'); ?>" />
                </div>
                @if ($errors->has('mobile_no'))
                <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                @endif
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