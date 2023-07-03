@extends('layouts.layout')

@section('page')
 
	<div>Doctors</div>
 
@endsection
 
@section('content')
<!-- page-title stary -->
<div class="page-title mg-top-50">
	<div class="container">
		<a class="float-left" href="/">Home</a>
		<span class="float-right">Doctor</span>
	</div>
</div>
<div class="goal-area pd-top-36">
	<div class="container">
		<div class="section-title">
			<h3 class="title">{{$details->doctor->name}}</h3>
		</div>
		
	</div>
</div>
@if(!empty($details->opening_hours))
<!-- my-clinic start -->
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-green">
				<span class="float-left">Day</span>
				<span class="float-right">Timings</span>
				<span class="float-right">Max Token</span>
				<span class="float-right">Time Per Token</span>
			</li>
			@foreach($day_arr as $key=>$day)
				<li>
					<span class="float-left">{{ $day }}</span>
					@if(isset($details->opening_hours[$key+1]))
						<div class="float-right">	
							@foreach($details->opening_hours[$key+1] as $slot=>$timing)					
								<span class="d-block">{{$timing->start_hour}} - {{$timing->end_hour}}</span>
								<span class="d-block">{{$timing->max_token}}</span>
								<span class="d-block">{{$timing->time_per_token}}</span>
							@endforeach
						</div>
					@else
						<div class="float-right">								
							<span class="d-block">Cloed</span>							
						</div>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div>
@endif
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection