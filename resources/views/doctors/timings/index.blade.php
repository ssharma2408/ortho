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
<!-- my-clinic start -->
<div class="my-clinic-details pd-top-36">
	<div class="container">
		@include('layouts.partials.messages')
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-green">
				<span class="float-left">Day</span>
				<span class="float-right">Timings</span>
				<span class="float-right">Max Token</span>
				<span class="float-right">Time Per Token</span>
				<span class="float-right"><a href="{{ route('timings.edit', $details->doctor->id) }}" class="btn btn-success">Update</a></span>
			</li>
			@if(!empty($details->opening_hours))
				@foreach($day_arr as $key=>$day)
					<li>
						<span class="float-left">{{ $day }}</span>
						@if(isset($details->opening_hours[$key+1]))
							<div class="float-right">	
								@foreach($details->opening_hours[$key+1] as $slot=>$timing)					
									<span class="d-block">{{$timing->start_hour}} - {{$timing->end_hour}}</span>
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
	</div>
</div>

<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection