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
			<h1 class="title">Current Appointments</h1>			
		</div>
		@foreach($patient_arr as $slot=>$patients)
			<h4>Slot: {{$slot}}</h4>
			<div class="single-goal single-goal-one">
				<div class="row align-items-center p-2">					
					<div class="col-2 pr-0">						
						<h6>Patient Name</h6>
					</div>
					<div class="col-1 pr-0">						
						<h6>Token number</h6>
					</div>
					<div class="col-1 pr-0">
						<h6>Status</h6>
					</div>
					<div class="col-3 pr-0">
						<h6>Comment</h6>
					</div>
					<div class="col-3 pr-0">
						<h6>Upload Prescription</h6>
					</div>
					<div class="col-2 pr-0">						
						<h6>Action</h6>
					</div>
				</div>
			</div>
			@foreach($patients as $patient)
				<form class="taken_frm" method="post" enctype="multipart/form-data">
					@csrf
					<div class="single-goal single-goal-one">
						<div class="row align-items-center p-2">					
							<div class="col-2 pr-0">						
								<h6>{{$patient->name}}</h6>
							</div>
							<div class="col-1 pr-0">						
								<h6>{{$patient->token_number}}</h6>
							</div>
							<div class="col-1 pr-0">						
								<select name="status" id="status_{{$patient->id}}">
									<option value="0" @if($patient->status==0){{'selected'}} @endif>Close</option>
									<option value="1" @if($patient->status==1){{'selected'}} @endif>Open</option>
									<!--option value="2" @if($patient->status==2){{'selected'}} @endif>Hold</option-->
								</select>
							</div>
							<div class="col-3 pr-0">
								<textarea name="comment" id="comment_{{$patient->id}}"></textarea>
							</div>
							<div class="col-3 pr-0">
								<input name="prescription" type="file" id="prescription_{{$patient->id}}">
							</div>
							<div class="col-2 pr-0">						
								<button type="submit" id="btn_{{$patient->id}}_{{$patient->timing_id}}" class="btn_update btn btn-success">Update</button>
								<input type="hidden" name="patient_id" value="{{$patient->id}}" />
								<input type="hidden" name="slot_id" value="{{$patient->timing_id}}" />
								<div class="patient_msg" id="msg_{{$patient->id}}"></div>
							</div>
						</div>
					</div>
				</form>
			@endforeach
		@endforeach
	</div>
</div>
<!-- balance End -->
@endsection
 
@section('scripts')
@parent
<script>


$(function(){
	$(".patient_msg").hide();  
});

$("form.taken_frm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	var patient_id = $(this).find('input[name="patient_id"]').val();
   $.ajax({
        url: '/doctor_dashboard/update-token',
        type: 'POST',
        data: formData,
        success: function (data) {
            if(data.success){				
				$html = "<div>"+data.msg+"</div>"
				$("#msg_"+patient_id+"").show().html($html);
			 }else{
				$html = "<div>There is a technical error, please try after sometime.</div>"
				$("#msg_"+patient_id+"").show().html($html);
			 }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
@endsection