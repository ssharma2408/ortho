@extends('layouts.layout')

@section('page')
 
	<div>Patients</div>
 
@endsection
 
@section('content')
<!-- page-title stary -->
<div class="page-title mg-top-50">
	<div class="container">
		<a class="float-left" href="/">Home</a>
		<span class="float-right">My Profile</span>
	</div>
</div>
<!-- page-title end -->
<!-- balance start -->
<div class="balance-area pd-top-40">
	<div class="container">
		<div class="section-title">			
			<h3 class="title">Patients</h3>			
		</div>
		<div class="single-goal single-goal-one">
			<div class="row align-items-center">					
				<div class="col-3 pr-0">						
					<h6>Patient Name</h6>
				</div>
				<div class="col-3 pr-0">						
					<h6>Token number</h6>
				</div>
				<div class="col-3 pr-0">						
					<h6>Status</h6>
				</div>
				<div class="col-3 pr-0">						
					<h6>Action</h6>
				</div>
			</div>
		</div>
		@foreach($patients as $patient)
			<div class="single-goal single-goal-one">
				<div class="row align-items-center">					
					<div class="col-3 pr-0">						
						<h6>{{$patient->name}}</h6>
					</div>
					<div class="col-3 pr-0">						
						<h6>{{$patient->token_number}}</h6>
					</div>
					<div class="col-3 pr-0">						
						<select id="status_{{$patient->id}}">
							<option value="0" @if($patient->status==0){{'selected'}} @endif>Closed</option>
							<option value="1" @if($patient->status==1){{'selected'}} @endif>Open</option>
							<option value="2" @if($patient->status==2){{'selected'}} @endif>Hold</option>
						</select>
					</div>
					<div class="col-3 pr-0">						
						<button type="button" id="btn_{{$patient->id}}" class="btn_update btn btn-success">Update</button>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
<!-- balance End -->
@endsection
 
@section('scripts')
@parent
<script>


</script>
@endsection