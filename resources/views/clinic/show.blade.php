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

<!-- my-clinic start -->
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-green">
				<span class="float-left">Timings</span>
				<span class="float-right"><i class="fa fa-calendar"></i></span>
			</li>
			<li>
				<span class="float-left">Monday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">Tuesday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">Wedenesday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">Thursday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">Friday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">Saturday</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<ul class="my-clinic-details-inner">
			<li class="my-clinic-details-title bg-secondary">
				<span class="float-left">Closed on</span>
				<span class="float-right"><i class="fa fa-calendar-times-o"></i></span>
			</li>
			<li>
				<span class="float-left">15-05-2023</span>
				<div class="float-right">
					<span class="d-block">10:00AM - 2:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">16-05-2023</span>
				<div class="float-right">
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
			<li>
				<span class="float-left">17-05-2023</span>
				<div class="float-right">
					<span class="d-block">4:00PM - 7:00PM</span>
				</div>
			</li>
		</ul>
	</div>
</div>
<!-- my-clinic End -->

<div class="btn-wrap mg-top-40 text-center">
	<div class="container">
		<p class="btn-content-text">If haveing any timing issue, Please <a href="contact.html">contact us</a></p>
	</div>
</div>
@endsection
 
@push('js')

@endpush