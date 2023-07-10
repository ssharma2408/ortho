@extends('layouts.layout')

@section('page')

<div>Staff</div>

@endsection

@section('content')
<!-- page-title stary -->
<div class="page-title mg-top-50">

</div>
<div class="goal-area pd-top-36">
	<div class="container">
		<div class="row align-items-center ">
			<div class="col-md-8">
				<div class="section-title text-uppercase">
					<h3 class="sub-title">Our Staff </h3>
			
				</div>
			</div>
			<div class="col-auto text-end float-end ms-auto download-grp">
				<div>
				<span class="sub-title">Total-{{count($staffs)}}</span>
				<a class="btn btn-secondary btn-sm" href="{{route('staffs.create') }}">Add New Staff</a> </div>
			</div>
		</div>
		<table class="table align-middle">
			<thead>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Mobile</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody class="table-group-divider">
				@foreach($staffs as $key => $staff)
				<tr>
					<td>{{$staff->name}}</td>
					<td>{{$staff->username}}</td>
					<td>{{$staff->email}}</td>
					<td>{{$staff->mobile_number}}</td>
					<td class="text-end">
						<a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-primary btn-sm" role="button">Edit</a>
						<form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-secondary btn-sm">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>
<!-- goal area End -->
@endsection
@section('scripts')
@parent
<script>

</script>
@endsection