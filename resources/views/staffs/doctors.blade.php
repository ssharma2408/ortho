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
			<h3 class="title">Our Doctors</h3>			
			<a class="goal-title" href="#">Total-{{count($doctors)}}</a>
		</div>
		@include('layouts.partials.messages')
		@foreach($doctors as $key => $doctor)
			<div class="single-goal single-goal-one">
				<div class="row align-items-center">					
					<div class="col-7 pr-0">
						<div class="details">
							<h6>{{$doctor->name}}</h6>
						</div>
					</div>					
					<div class="col-5 pl-0">
						<div class="d-flex align-items-center justify-content-end pr-3">
							<a class="icon-outline text-red fw-5 mx-1" href="{{ route('staff.doctor.view', ['doctor_id'=>$doctor->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							<a class="icon-outline text-red fw-5 mx-1" href="{{ route('staff.doctor.edit', ['doctor_id'=>$doctor->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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