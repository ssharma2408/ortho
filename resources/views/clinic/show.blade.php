@extends('layouts.layout')

@section('page')
 
	<div>My Clinic</div>
 
@endsection
 
@section('content')
<!-- page-title stary -->
<div class="page-title mg-top-50">
	<div class="container">
		<a class="float-left" href="/">Home</a>
		<span class="float-right">Staff</span>
	</div>
</div>
<!-- page-title end -->
<!-- balance start -->
<div class="balance-area pd-top-40">
	<div class="container">
		<div class="section-title">			
			<h3 class="title">{{$clinic->name}}</h3>			
		</div>
		<div class="section-title">			
			<h2 class="title">Package: {{$clinic->package->package}}</h2>			
		</div>
		<div class="balance-area-bg bg-transaction-details">
			<div class="balance-title text-center">
				<h3><b>{{$clinic->clinic_admin->name}}</b></h3>
			</div>
			<div class="ba-balance-inner text-center" style="background-image: url({{ asset('img/bg/2.png') }});">
				<div class="icon">
					<i class="fa fa-map-marker"></i>
				</div>
				<h6 class="title">{!! $clinic->address !!}</h6>
			</div>
		</div>
	</div>
</div>
<!-- balance End -->

@if(!empty($clinic->opening_hours))
<!-- my-clinic start -->
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-green">
				<span class="float-left">Timings</span>
				<span class="float-right"><i class="fa fa-calendar"></i></span>
			</li>
			@foreach($day_arr as $key=>$day)
				<li>
					<span class="float-left">{{ $day }}</span>
					@if(isset($clinic->opening_hours[$key+1]))
						<div class="float-right">	
							@foreach($clinic->opening_hours[$key+1] as $slot=>$timing)					
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
		</ul>
	</div>
</div>
@endif

@if(!empty($closed_days))
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-secondary">
				<span class="float-left">Closed on</span>
				<span class="float-right"><i class="fa fa-calendar-times-o"></i></span>
			</li>
			@foreach($closed_days as $day)
				<li>
					<span class="float-left">{{date('d-M-y', strtotime($day->closed_on))}}</span>					
				</li>
			@endforeach
		</ul>
	</div>
</div>
@endif
<!-- my-clinic End -->

<div class="btn-wrap mg-top-40 text-center">
	<div class="container">
		<p class="btn-content-text">If haveing any timing issue, Please <a href="contact.html">contact us</a></p>
	</div>
</div>
@endsection
 
@push('js')

@endpush