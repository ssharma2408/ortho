@extends('layouts.layout')

@section('page')

<div>Patient</div>

@endsection

@section('content')

<div class="section-title text-uppercase pt-0 mb-2 d-flex justify-content-between">
	<h3 class="sub-title">My Family</h3>
	<span class="sub-title">Total-{{count($members)}}</span>
</div>

@include('layouts.partials.messages')

<div class="row gx-3 row-cols-1  row-cols-lg-2">
	@foreach($members as $key => $member)
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-secondary mb-2">{{$member->name}}</h5>				
				<p class="card-text mb-2">Date of Birth : {{$member->dob}}</p>
				@if($member->id == Session::get('user_details')->id)
					<div>
						<a href="" class="btn btn-primary btn-sm" role="button">Update Profile</a>
					</div>
				@else
					<div>
						<a href="{{ route('family.edit', $member->id) }}" class="btn btn-primary btn-sm" role="button">Edit</a>
						<form action="{{ route('family.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-secondary btn-sm">Delete</button>
						</form>
					</div>
				@endif
			</div>
		</div>
	</div>
	@endforeach
</div>
<div class="text-center">
	<a class="btn btn-secondary btn-rounded" href="{{route('family.create') }}">Add New Member</a>
</div>

<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection