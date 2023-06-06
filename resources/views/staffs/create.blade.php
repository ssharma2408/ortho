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
                <h3 class="title">Create Staff</h3>
            </div>
            <div class="staff-area">
                <form action ="{{ route('staffs.store') }}" method="post" class="staff-form-inner">
					@csrf
                    <label class="single-input-wrap">
                        <input type="text" placeholder="Name" name="name" required autocomplete="name" autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </label>
                    <label class="single-input-wrap">
                        <input type="email" placeholder="Email Address" name="email" required autocomplete="email">
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </label>
                    <label class="single-input-wrap">
                        <input type="number" placeholder="Mobile" name="mobile" required autocomplete="mobile">
						@error('mobile')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </label>
                    <label class="single-input-wrap">
                        <input type="text" placeholder="User name" name="username" required autocomplete="username">
						@error('username')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </label>
                    <label class="single-input-wrap">
                        <input type="password" placeholder="Password" name="password" required autocomplete="new-password">
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
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