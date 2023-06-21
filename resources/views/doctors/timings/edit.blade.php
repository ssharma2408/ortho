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
<!-- my-clinic start -->
<div class="my-clinic-details pd-top-36">
	<div class="container">
		<form method="post" action="{{route('timings.save', [$details->doctor->id])}}">
			@csrf
			@if(empty($details->opening_hours))
				@foreach($day_arr as $key=>$day)
					<div class="row mb-4 daycontainer">
						<div class="col-md-3">
							{{ $day }}
							<input type="checkbox" id="day_{{$key+1}}" name="day_{{$key+1}}" class="check_day" />
						</div>
						<div class="timing col-md-9">
							<div class="row">
								<div class="col-md-4">
									Open at
									<input type="time" id="" name="open_{{$key+1}}[]" min="07:00" max="23:00" />
								</div>
								<div class="col-md-4">
									Close at
									<input type="time" id="" name="close_{{$key+1}}[]" min="07:00" max="23:00" />
								</div>
								<div class="col-md-4">
									<span class="add_row" id="add_row" data-key ="{{$key+1}}">+</span>
								</div>
							</div>													
						</div>
					</div>
				@endforeach
			@else
				@foreach($day_arr as $key=>$day)
					<div class="row mb-4 daycontainer">
						<div class="col-md-3">
							{{ $day }}
							@php
								$checked = "";
								if(!isset($details->opening_hours[$key+1])){
									$checked = "checked";
								}
							@endphp
							<input type="checkbox" id="day_{{$key+1}}" name="day_{{$key+1}}" class="check_day" {{$checked}} />
						</div>
						<div class="timing col-md-9">
							@if(isset($details->opening_hours[$key+1]))
								@foreach($details->opening_hours[$key+1] as $slot=>$timing)
									<div class="row mt-2">
										<div class="col-md-4">
											Open at
											<input type="time" id="" name="open_{{$key+1}}[]" min="07:00" max="23:00" value="{{$timing->start_hour}}" />
										</div>
										<div class="col-md-4">
											Close at
											<input type="time" id="" name="close_{{$key+1}}[]" min="07:00" max="23:00" value="{{$timing->end_hour}}" />
										</div>
										<div class="col-md-4">
											@if($slot ==0)
												<span class="add_row" id="add_row" data-key ="{{$key+1}}">+</span>
											@else
												<span class="remove_row" id="remove_row" data-key ="{{$key+1}}">-</span>
											@endif
										</div>
									</div>
								@endforeach
							@else
								<div class="row mt-2">
									<div class="col-md-4">
										Open at
										<input type="time" id="" name="open_{{$key+1}}[]" min="07:00" max="23:00" />
									</div>
									<div class="col-md-4">
										Close at
										<input type="time" id="" name="close_{{$key+1}}[]" min="07:00" max="23:00" />
									</div>
									<div class="col-md-4">																		
										<span class="add_row" id="add_row" data-key ="{{$key+1}}">+</span>
									</div>
								</div>
							@endif														
						</div>
					</div>
				@endforeach
			@endif
			<button type="submit" class="btn btn-success">Save</button>
			<input type="hidden" name="user_id" value="{{ $details->doctor->id }}">
		</form>
	</div>
</div>
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>		
	$(".check_day").click(function(){		
		if($(this).prop('checked') == true){
			$(this).parent().next(".timing").find('input').val("");
		}
		$(this).parent().next(".timing").toggle();
	});
	
	$(".add_row").click(function(){
		$(this).parent().parent().parent().append(row_html($(this).data("key")));
	});
	$(".timing").on('click','.remove_row',function(){
	   $(this).parent().parent().remove();		
	});
	
	function row_html(key){
		return '<div class="row mt-2"><div class="col-md-4">Open at <input type="time" id="" name="open_'+key+'[]" min="07:00" max="23:00" /></div><div class="col-md-4">Close at <input type="time" id="" name="close_'+key+'[]" min="07:00" max="23:00" /></div><div class="col-md-4"><span class="remove_row" id="remove_row">-</span></div></div>';	
	}
	$(function() {
		$(".check_day").each(function(){
			if($(this).prop('checked') == true){
				$(this).parent().next(".timing").toggle();
			}
		});		
	});
</script>
@endsection