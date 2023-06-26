@extends('layouts.layout')

@section('page')
 
	<div>Patient Dashboard</div>
 
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
@php
	$day = date( 'N' );
@endphp
<div class="goal-area pd-top-36">
	<div class="container">
		<div class="section-title row">
			<h3 class="title col-7">Doctors</h3>
			<p class="col-5" id="time"></p>
		</div>
		@foreach($doctor_arr as $doctor)
			@if(isset($doctor['timings'][$day]))
				<div class="single-goal single-goal-one">
					<div class="row align-items-center">					
						<div class="col-7 pr-0">
							<div class="details">
								<h6>{{$doctor['name']}}</h6>
							</div>
						</div>						
						<div class="col-5 pr-0">								
							@foreach($doctor['timings'][$day] as $slot=>$timing)
								<div class="row">
									<div class="col-md-10">
										<span class="d-block">{{$timing['start_hour']}} - {{$timing['end_hour']}}</span>
										<div class="token_details"></div>
									</div>
									<div class="col-md-2">
										<button type="button" id="doc_{{$doctor['id']}}" class="book btn btn-success" >Book</button>
									</div>
								</div>
							@endforeach							
						</div>
					</div>
				</div>
			@endif
		@endforeach
	</div>
</div>
<!-- balance End -->
@endsection
 
@section('scripts')
@parent
<script>
	var timestamp = '<?=time();?>';
	function updateTime(){
	  $('#time').html(Date(timestamp));
	  timestamp++;
	}
	$(function(){
	  setInterval(updateTime, 1000);
	  $(".token_details").hide();
	});
	
	$(".book").click(function(){
		var doc_id = $(this).attr("id").split("_")[1];
		$.ajax({
               type:'GET',
               url:'/user_dashboard/book-appointment/'+doc_id,
               success:function(data) {
                 if(data.success){
					$("#doc_"+doc_id).hide();
					$html = "<div>"+data.msg+"</div><div>Current token:"+data.token.current_token+"<b></b></div><div>Your token number is <b>"+data.token.token_number+"</b> and estimated time is <b>"+data.token.estimated_time+"</b> minute</div><div><button type='button'>Refresh</button></div>"
					$(".token_details").show().html($html);
				 }else{
					 $html = "<div>"+data.msg+"</div>"
					$(".token_details").show().html($html);
				 }
               }
            });
	});
	
</script>
@endsection