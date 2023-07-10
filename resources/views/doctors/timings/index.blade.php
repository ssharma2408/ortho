@extends('layouts.layout')

@section('page')

<div>Doctors</div>

@endsection

@section('content')

<div class="section-title pt-0 mb-2">
	<h1>Doctor Timings</h1>
</div>



@include('layouts.partials.messages')

<a href="{{ route('timings.edit', $details->doctor->id) }}" class="btn btn-success">Update</a>




<ul class="my-clinic-details-inner list-group list">
	<li class="my-clinic-details-title bg-green list-group-item d-flex justify-content-between align-items-start">
		<span class="float-left">Day</span>
		<span class="float-right">Timings</span>
		<span class="float-right">Max Token</span>
		<span class="float-right">Time Per Token</span>
		<span class="float-right"></span>
	</li>

	@if(!empty($details->opening_hours))
	@foreach($day_arr as $key=>$day)
	<li class="list-group-item d-flex justify-content-between align-items-start">
		<span class="ms-2 me-auto">{{ $day }}</span>
		@if(isset($details->opening_hours[$key+1]))
		<div class="float-right">
			@foreach($details->opening_hours[$key+1] as $slot=>$timing)
			<span>{{$timing->start_hour}} - {{$timing->end_hour}}</span>
			Max Token {{$timing->max_token}} <br>
			Time Per Token {{$timing->time_per_token}} <br>
			@endforeach
		</div>
		@else
		<div class="float-right">
			<span class="d-block">Cloed</span>
		</div>
		@endif
	</li>
	@endforeach
	@endif
</ul>

<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection