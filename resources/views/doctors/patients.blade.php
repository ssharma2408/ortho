@extends('layouts.layout')

@section('page')

<div>Doctor Dashboard</div>

@endsection

@section('content')


<div class="section-title d-flex pt-0">
	<h3 class="title"> Patients History</h3> <i class="ri-history-line ms-auto fw-bold"></i> 
</div>

@foreach($patient_arr as $id => $details)
<div class="card">
	<div class="card-body">

		<div class="details fw-bold secondary-text text-uppercase  mb-3">
		{{$details['name']}}
		</div>		
		@foreach($details['visit_date'] as $date)
			<div class="d-flex mt-2">
				<div class="visit_date">{{$date['visit_date']}}</div>
				<button type="button" class="ms-auto btn btn-primary btn-sm show_btn" id="history_{{$date['history_id']}}">View</button>				
			</div>
		@endforeach		
	</div>
</div>
@endforeach


<!-- balance End -->
@endsection

@section('scripts')
@parent
<script>
	$(".show_btn").click(function() {

		$.ajax({
			type: 'GET',
			url: '/doctor_dashboard/get_history/' + $(this).attr('id').split("_")[1],
			success: function(data) {
				if (data.success) {
					$("#p_name").text(data.history.patient.name);
					$("#p_visitdate").text(data.history.visit_date);
					$("#p_prescription").html('<img class="img-fluid" src ="' + data.history.prescription + '" />');
					$("#p_comment").text(data.history.comment);
					$('#historyModal').modal('show');
				}
			}
		});
	});
</script>
@endsection

@section('modal')
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">History</h4>
			</div>
			<div class="modal-body">
				<div>Name : <span id="p_name"></span></div>
				<div>Visit Date: <span id="p_visitdate"></span></div>
				<div>Prescription : <span id="p_prescription"></span></div>
				<div>Comment : <span id="p_comment"></span></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection