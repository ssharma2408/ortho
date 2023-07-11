@extends('layouts.layout')

@section('page')
 
	<div>Doctors</div>
 
@endsection
 
@section('content')
<!-- page-title stary -->
<div class="section-title mb-2 pt-0">
	<h3 class="title">{{$details->doctor->name}}</h3>
</div>

@if(!empty($details->opening_hours))
	<!-- my-clinic start -->
	<div class="my-clinic-details pd-top-36">
		<ul class="my-clinic-details-inner list-group">
			<li class="my-clinic-details-title  bg-body-tertiary list-group-item d-flex justify-content-between align-items-start fw-bold">
				<span class="col-4">Day</span>
				<span class="col-4">Timings</span>
				<span class="col-2">Max Token</span>
				<span class="col-2">Time Per Token</span>
			</li>
			@foreach($day_arr as $key=>$day)
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<span class="fw-bold col-4">{{ $day }}</span>
				<div class="col-8">
				@if(isset($details->opening_hours[$key+1]))
					@foreach($details->opening_hours[$key+1] as $slot=>$timing)
					<div class="row my-2">
						<div class="col-6">
						<span>{{$timing->start_hour}} - {{$timing->end_hour}}</span> 
						</div>
						<div class="col-3">
						<span>{{$timing->max_token}}</span>
						</div>
						<div class="col-3">
						<span>{{$timing->time_per_token}}</span><br>
						</div>
					</div>
					@endforeach
			
				@else
				<div>
					<span>Cloed</span>
				</div>
				</div>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
@endif
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection