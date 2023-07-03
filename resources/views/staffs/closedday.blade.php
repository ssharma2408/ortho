@extends('layouts.layout')

@section('page')
 
	<div>Staff Dashboard</div>
 
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
		<form method="post" action="{{route('clinic.closed.save')}}">
			@csrf
			<div class="closed_container">
				@if(empty($details))				
					<div class="row mb-2">
						<div class="col-md-10">
							Date
							<input type="date" id="" name="closedon[]"  />
						</div>																
						<div class="col-md-2">
							<span class="add_row" id="add_row">+</span>
						</div>						
					</div>				
				@else				
					@foreach($details as $key=>$val)
						<div class="row mb-2">
							<div class="col-md-10">
								Date
								<input type="date" id="" name="closedon[]" value="{{$val->closed_on}}" />
							</div>								
							<div class="col-md-2">
								@if($key ==0)
									<span class="add_row" id="add_row" >+</span>
								@else
									<span class="remove_row" id="remove_row" >-</span>
								@endif
							</div>
						</div>
					@endforeach
				@endif
			</div>
			<button type="submit" class="btn btn-success">Save</button>			
			<input type="hidden" name="user_id" value="{{ $clinic_admin }}">
		</form>		
	</div>
</div>
<!-- balance End -->
@endsection
 
@section('scripts')
@parent
<script>
	$(".add_row").click(function(){
		$(this).parent().parent().parent().append(row_html());
	});
	$(".closed_container").on('click','.remove_row',function(){
	   $(this).parent().parent().remove();
	});
	
	function row_html(){
		return '<div class="row mb-2"><div class="col-md-10">Date <input type="date" id="" name="closedon[]"  /></div><div class="col-md-2"><span class="remove_row" id="remove_row">-</span></div></div>';	
	}	
</script>
@endsection