@extends('layouts.layout')

@section('page')

<div>Patient Dashboard</div>

@endsection

@section('content')

<!-- balance start -->
@php
$day = date( 'N' );
@endphp
<div class="section-title pt-0 mb-2 row d-flex justify-content-between align-items-center">
	<h3 class="title col-auto">Doctors</h3>
	<p class="text-descripstion secondary-text mb-0 col-auto" id="time"></p>
</div>
@foreach($doctor_arr as $doctor)
@if(isset($doctor['timings'][$day]))
<div class="single-goal single-goal-one {{isset($doctor['timings'][$day+1]) ? '' : 'border-top mt-2 pt-2 border-light-subtle'  }}">
	<div class="row align-items-center">
		<div class="col-lg-7 pr-0">
			<div class="details text-secondary">
				<h6>Dr. {{$doctor['name']}}</h6>
			</div>
		</div>
		<div class="col-lg-5 pr-0">
			@foreach($doctor['timings'][$day] as $slot=>$timing)
			<div class="row my-2 justify-content-between">
				<div class="col-auto">
					<span class="d-block">{{$timing['start_hour']}} - {{$timing['end_hour']}}</span>
				</div>
				@if( ! $doctor['is_booked'])
				<div class="col-auto">
					<button type="button" id="doc_{{$doctor['id']}}_{{$timing['slot_id']}}" class="btn btn-secondary btn-rounded btn-sm book">Book</button>
				</div>
				@else
				<div class="col-auto">
					<button class='btn btn-secondary btn-rounded btn-sm refresh_status' id="doc_{{$doctor['id']}}_{{$timing['slot_id']}}" type='button'>Check Status</button>
				</div>
				@endif
				<div class="token_details row gy-2 row-cols-1" id="token_details_{{$timing['slot_id']}}"></div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif
@endforeach


<!-- balance End -->
@endsection

@section('scripts')
@parent
<script>
	var timestamp = '<?= time(); ?>';

	function updateTime() {
		var time_arr = Date(timestamp).split(" ");
		$('#time').html(time_arr[0] + " " + time_arr[1] + " " + time_arr[2] + "" + time_arr[4]);
		timestamp++;
	}
	$(function() {
		setInterval(updateTime, 1000);
		//$(".token_details").hide();
	});

	$(".book").click(function() {
		var doc_id = $(this).attr("id").split("_")[1];
		var slot_id = $(this).attr("id").split("_")[2];
		$.ajax({
			type: 'GET',
			url: '/user_dashboard/book-appointment/' + doc_id + '/' + slot_id,
			success: function(data) {
				if (data.success) {
					$(".book").hide();
					$html = "<div>" + data.msg + "</div><div>Current token:" + data.token.current_token + "<b></b></div><div>Your token number is <b>" + data.token.token_number + "</b> and estimated time is <b>" + data.token.estimated_time + "</b> minute</div><div><button class='btn btn-secondary btn-rounded btn-sm refresh_status' id='doc_" + doc_id + "_" + slot_id + "' type='button'>Refresh</button></div>"
					$("#token_details_" + slot_id).show().html($html);
				} else {
					$html = "<div>" + data.msg + "</div>"
					$("#token_details_" + slot_id).show().html($html);
				}
			}
		});
	});

	$(document).on("click", ".refresh_status", function() {
		var doc_id = $(this).attr("id").split("_")[1];
		var slot_id = $(this).attr("id").split("_")[2];
		$.ajax({
			type: 'GET',
			url: '/user_dashboard/refresh-status/' + doc_id + '/' + slot_id,
			success: function(data) {
				if (data.success) {
					$html = "<div>Current token:" + data.token.current_token + "<b></b></div><div>Your token number is <b>" + data.token.token_number + "</b> and estimated time is <b>" + data.token.estimated_time + "</b> minute</div><div><button class='btn btn-secondary btn-rounded btn-sm refresh_status' id='doc_" + doc_id + "_" + slot_id + "' type='button'>Refresh</button></div>"
					$("#token_details_" + slot_id).html($html);
				} else {
					$html = "<div>" + data.msg + "</div>"
					$("#token_details_" + slot_id).html($html);
				}
			}
		});
	});
</script>
@endsection