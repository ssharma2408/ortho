@extends('layouts.layout')

@section('page')
 
	<div>Staff</div>
 
@endsection
 
@section('content')
<!-- page-title stary -->
<div class="page-title mg-top-50">
	<div class="container">
		<a class="float-left" href="/">Home</a>
		<span class="float-right">Staff</span>
	</div>
</div>
<div class="goal-area pd-top-36">
	<div class="container">
		<div class="section-title">
			<h3 class="title">Our Staff</h3>
			<a class="fw-5 mx-1" href="{{route('staffs.create') }}">Add New Staff</a>
			<a class="goal-title" href="#">Total-{{count($staffs)}}</a>
		</div>
		@foreach($staffs as $key => $staff)
			<div class="single-goal single-goal-one">
				<div class="row align-items-center">
					<a href="{{ route('staffs.show', $staff->id) }}">
						<div class="col-7 pr-0">
							<div class="details">
								<h6>{{$staff->name}}</h6>								
								<p>Username : {{$staff->username}}</p>								
							</div>
						</div>
					</a>
					<div class="col-5 pl-0">
						<div class="d-flex align-items-center justify-content-end pr-3">
							<a class="icon-outline text-red fw-5 mx-1" href="{{ route('staffs.edit', $staff->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							<form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
								<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="icon bg-violet text-white fw-5 mx-1"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
							</form>							
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection