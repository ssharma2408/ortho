@extends('layouts.layout')

@section('page')
 
	<div>Add Staff</div>
 
@endsection
@section('content')

<div class="page-title mg-top-50">
	<div class="container">
		<a class="float-left" href="/">Home</a>
		<span class="float-right">Staff</span>
	</div>
</div>
    <!-- goal area Start -->
    <div class="goal-area pd-top-36">
        <div class="container">
            <div class="section-title">
                <h3 class="title">{{$staff->name}}</h3>
            </div>
            <div class="staff-area">
                <form method="POST" action="{{ route("staffs.update", [$staff->id]) }}" class="staff-form-inner">
					@method('PUT')
					@csrf
                    <label class="single-input-wrap">
                        <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}" required>
						@if($errors->has('name'))
							<div class="invalid-feedback">
								{{ $errors->first('name') }}
							</div>
						@endif
                    </label>
                    <label class="single-input-wrap">
                        <input type="email" name="email" id="email" value="{{ old('email', $staff->email) }}" required>
						@if($errors->has('email'))
							<div class="invalid-feedback">
								{{ $errors->first('email') }}
							</div>
						@endif
                    </label>
                    <label class="single-input-wrap">
                        <input type="number" name="mobile" id="mobile" value="{{ old('mobile', $staff->mobile_number) }}" required>
						@if($errors->has('mobile'))
							<div class="invalid-feedback">
								{{ $errors->first('mobile') }}
							</div>
						@endif
                    </label>
                    <label class="single-input-wrap">
                        <input type="text" name="username" id="username" value="{{ old('username', $staff->username) }}" required>_{{ Session::get('user_details')->postfix }}
						@if($errors->has('username'))
							<div class="invalid-feedback">
								{{ $errors->first('username') }}
							</div>
						@endif
                    </label>
                    <label class="single-input-wrap">
                        <input type="password" name="password" id="password" value="" >
                    </label>
                    <button type="submit" class="btn btn-purple">Save</button>
                </form>
            </div>
        </div>
    </div>
    <!-- goal area End -->

@endsection
@section('scripts')
@parent
<script>

</script>
@endsection