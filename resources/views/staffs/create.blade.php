@extends('layouts.layout')

@section('page')

<div>Add Staff</div>

@endsection
@section('content')

	<div class="container">
		<div class="section-title text-uppercase">
			<h3 class="sub-title">Create Staff</h3>
		</div>
		<div class="staff-area">
			<form action="{{ route('staffs.store') }}" method="post" class="staff-form-inner">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="single-input-wrap form-group mb-3">
							<input class="form-control" type="text" placeholder="Name" name="name" required autocomplete="name" autofocus>
							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="single-input-wrap form-group mb-3">
							<input class="form-control" type="email" placeholder="Email Address" name="email" required autocomplete="email">
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="single-input-wrap form-group mb-3">
							<input class="form-control" type="text" placeholder="Mobile" name="mobile" required autocomplete="mobile">
							@error('mobile')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
					<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">orth_</span>
  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>
						<div class="single-input-wrap form-group mb-3">
							{{ Session::get('user_details')->prefix }}_<input class="form-control" type="text" placeholder="User name" name="username" required autocomplete="username">
							@error('username')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="single-input-wrap form-group mb-3">
							<input class="form-control" type="password" placeholder="Password" name="password" required autocomplete="new-password">
							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-secondary btn-rounded">Save</button>
			</form>
		</div>
	</div>

@endsection
@section('scripts')
@parent
<script>

</script>
@endsection