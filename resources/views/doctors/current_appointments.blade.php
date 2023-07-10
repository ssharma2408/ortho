@extends('layouts.layout')

@section('page')

<div>Patients</div>

@endsection

@section('content')
<!-- page-title stary -->

<!-- page-title end -->
<!-- balance start -->

@foreach($patient_arr as $slot=>$patients)
<div class="section-title pt-0 mb-2 d-flex">
	<h1 class="title">Current Appointments</h1>
	<div class="text-descripstion secondary-text mb-0 ms-auto fw-bold">
		Slot: {{$slot}}
	</div>
</div>
@foreach($patients as $patient)
<form class="taken_frm" method="post" enctype="multipart/form-data">
	@csrf
	<div class="card">
		<div class="card-body">
			<div class="d-flex">
				<div class="ms-auto fw-bold secondary-text">
					Token : {{$patient->token_number}}
				</div>
			</div>
			<div class="single-goal single-goal-one">
				<div class="row align-items-center">
					<div class="col-md-4 col-12 mt-2">
						<label for="" class="form-label">Patient Name</label>
						<input type="text" readonly class="form-control" value="{{$patient->name}}">
					</div>
					<div class="col-md-4 col-12 mt-2">
						<label for="" class="form-label">Status</label>
						<select name="status" id="status_{{$patient->id}}" class="form-select">
							<option value="0" @if($patient->status==0){{'selected'}} @endif>Close</option>
							<option value="1" @if($patient->status==1){{'selected'}} @endif>Open</option>
							<!--option value="2" @if($patient->status==2){{'selected'}} @endif>Hold</option-->
						</select>
					</div>

					<div class="col-md-4 col-12 mt-2">
						<label class="form-label">Prescription</label>
						<input class="form-control" name="prescription" type="file" id="prescription_{{$patient->id}}">
					</div>
					<div class="col-md-6 col-12 mt-2">
						<label for="" class="form-label">Comment</label>
						<textarea class="form-control" name="comment" id="comment_{{$patient->id}}"></textarea>
					</div>
					<div class="col-md-6 col-12 mt-2 align-self-end">
						<button type="submit" id="btn_{{$patient->id}}_{{$patient->timing_id}}" class="btn_update btn btn-secondary btn-rounded">Update</button>
						<input type="hidden" name="patient_id" value="{{$patient->id}}" />
						<input type="hidden" name="slot_id" value="{{$patient->timing_id}}" />
						<div class="patient_msg text-danger small" id="msg_{{$patient->id}}"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
@endforeach
@endforeach

<!-- balance End -->
@endsection

@section('scripts')
@parent
<script>
	$(function() {
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
			success: function(data) {
				if (data.success) {
					$html = "<div>" + data.msg + "</div>"
					$("#msg_" + patient_id + "").show().html($html);
				} else {
					$html = "<div>There is a technical error, please try after sometime.</div>"
					$("#msg_" + patient_id + "").show().html($html);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
</script>
@endsection