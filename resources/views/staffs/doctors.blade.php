@extends('layouts.layout')

@section('page')
 
	<div>Doctors</div>
 
@endsection
 
@section('content')

<div class="section-title text-uppercase pt-0 mb-2">
	<h3 class="title-lg">Our Doctors</h3>
</div>
		
@include('layouts.partials.messages')
<div class="row">
	@foreach($doctors as $key => $doctor)
		<div class="col-md-4">
			<div class="card-box">
				<div class="card-body">
					<div class="doctor-profile">

					</div>
					<h5 class="card-title text-secondary mb-2">Dr.{{$doctor->name}}</h5>
					<p class="card-text mb-1">Email : {{$doctor->email}}</p>
					<p class="card-text mb-2">Phone : {{$doctor->mobile_number}}</p>
					<div class="mt-1">
						<a class="btn btn-primary btn-sm" href="{{ route('staff.doctor.view', ['doctor_id'=>$doctor->id]) }}"><i class="ri-eye-line"></i> View</a>
						<a class="btn btn-secondary btn-sm" href="{{ route('staff.doctor.edit', ['doctor_id'=>$doctor->id]) }}"><i class="ri-pencil-line"></i> Edit</a>
					</div>
				</div>
			</div>
		</div>		
	@endforeach
</div>	
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection