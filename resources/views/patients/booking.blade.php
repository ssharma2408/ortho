@extends('layouts.layout')

@section('page')

<div>Patient Booking</div>

@endsection
<?php 
	date_default_timezone_set("Asia/Kolkata");
	$timezone = 'Asia/Kolkata';
?>
				
@section('content')

<!-- balance start -->

<div class="section-title pt-0 mb-2 row d-flex justify-content-between align-items-center">
	<h3 class="title col-auto">Members</h3>
	<p class="text-descripstion secondary-text mb-0 col-auto" id="time"></p>
</div>

@foreach($members as $member)

<div class="card">
	<div class="card-body">
		<div class="details fw-bold secondary-text text-uppercase">
		{{$member->name}}
		</div>				
		@if( ! in_array($member->id, $is_booked))
			<div class="d-flex">
				 <button type="button" id="doc_{{$doctor_id}}_{{$slot_id}}_{{$member->id}}" class="btn btn-secondary btn-rounded btn-sm book">Book</button>
			</div>
		@else
			<div class="d-flex">
				<button class='btn btn-secondary btn-rounded btn-sm refresh_status' id="doc_{{$doctor_id}}_{{$slot_id}}_{{$member->id}}" type='button'>Check Status</button>
			</div>
		@endif
		<div class="token_details row gy-2 row-cols-1" id="token_details_{{$member->id}}"></div>
	</div>
</div>

@endforeach

<!-- balance End -->
@endsection

@section('scripts')
@parent
<script>
	var timestamp = '<?php echo time(); ?>';

	function updateTime() {
		var time_arr = Date(timestamp).split(" ");
		$('#time').html(time_arr[0] + " " + time_arr[1] + " " + time_arr[2] + "" + time_arr[4]);
	
		timestamp++;
	}
	$(function() {
		setInterval(updateTime, 1000);		
	});

	$(".book").click(function() {
		var doc_id = $(this).attr("id").split("_")[1];
		var slot_id = $(this).attr("id").split("_")[2];
		var patient_id = $(this).attr("id").split("_")[3];
		$.ajax({
			type: 'GET',
			url: '/user_dashboard/book-appointment/' + doc_id + '/' + slot_id+ '/' + patient_id,
			success: function(data) {
				if (data.success) {
					$("#doc_"+doc_id+"_"+slot_id+"_"+patient_id).hide();
					$html = "<div>" + data.msg + "</div><div>Current token:" + data.token.current_token + "<b></b></div><div>Your token number is <b>" + data.token.token_number + "</b> and estimated time is <b>" + data.token.estimated_time + "</b> minute</div><div><button class='btn btn-secondary btn-rounded btn-sm refresh_status' id='doc_" + doc_id + "_" + slot_id + "_" + patient_id +"' type='button'>Refresh</button></div>"
					$("#token_details_" + patient_id).show().html($html);
				} else {
					$html = "<div>" + data.msg + "</div>"
					$("#token_details_" + patient_id).show().html($html);
				}
			}
		});
	});

	$(document).on("click", ".refresh_status", function() {
		var doc_id = $(this).attr("id").split("_")[1];
		var slot_id = $(this).attr("id").split("_")[2];
		var patient_id = $(this).attr("id").split("_")[3];
		
		$.ajax({
			type: 'GET',
			url: '/user_dashboard/refresh-status/' + doc_id + '/' + slot_id+ '/' + patient_id,
			success: function(data) {
				if (data.success) {
					$("#doc_"+doc_id+"_"+slot_id+"_"+patient_id).hide();
					$html = "<div>Current token:" + data.token.current_token + "<b></b></div><div>Your token number is <b>" + data.token.token_number + "</b> and estimated time is <b>" + data.token.estimated_time + "</b> minute</div><div><button class='btn btn-secondary btn-rounded btn-sm refresh_status' id='doc_" + doc_id + "_" + slot_id + "_" + patient_id +"' type='button'>Refresh</button></div>"
					$("#token_details_" + patient_id).html($html);
				} else {
					$html = "<div>" + data.msg + "</div>"
					$("#token_details_" + patient_id).html($html);
				}
			}
		});
	});
</script>
@endsection