@extends('layouts.layout')

@section('page')

<div>Update Member</div>

@endsection
@section('content')



<div class="section-title text-uppercase">
    <h3 class="sub-title">{{$member->name}}</h3>
</div>
<div class="staff-area">
    <form method="POST" action="{{ route('family.update', [$member->id]) }}" class="staff-form-inner">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="single-input-wrap form-group mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required>
                    @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
            </div>
			@if($type==1)
				<div class="col-md-6" id="mobile_div">
					<div class="single-input-wrap form-group mb-3">
					<label class="form-label">Mobile</label>
						<div class="input-box" style="position: relative;">
							<span class="prefix position-absolute top-50 start-0 translate-middle ms-4">+91</span>
							<input id="mobile_number" class="form-control ps-5" type="text" name="mobile_number" value="{{ old('mobile_number', str_replace('+91', '', $member->mobile_number)) }}" required autocomplete="mobile_number" autofocus>
						</div>
						@error('mobile_number')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
			@endif
            <div class="col-md-6">
				<div class="single-input-wrap form-group mb-3">
				<label class="form-label">Gender</label>
					<select name="gender" required class="form-select">
						<option value="">Please Select</option>
						<option @if(old('gender')==1 || $member->gender == 1) selected @endif value="1">Male</option>
						<option @if(old('gender')==2 || $member->gender == 2) selected @endif value="2">Female</option>
						<option @if(old('gender')==3 || $member->gender == 3) selected @endif value="3">Other</option>
					</select>
					@error('gender')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
			</div>				
			<div class="col-md-6">
				<div class="single-input-wrap form-group mb-3">
				<label class="form-label">Date of Birth</label>
					<input class="form-control" type="date" name="dob" max="<?php echo date('Y-m-d'); ?>" value="{{ old('dob', $member->dob) }}" />
					@error('dob')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
			</div>
        </div>
		<input type="hidden" name="id" value="{{ $member->id }}" />
        <button type="submit" class="btn btn-secondary btn-rounded text-uppercase">Save</button>		
    </form>
</div>


@endsection
@section('scripts')
@parent
<script>

</script>
@endsection