<!-- navbar end -->

<div class="card-box sidebar-content">
	<div class="ba-main-menu">
		<ul class="vertical-menu">
			@if (Session::has('user_details') && Session::get('user_details')->role=="Clinic Admin")
				<li><a href="{{route('clinic.admin.dashboard')}}">Home</a></li>
				<li><a href="{{route('my-clinic.show')}}">My Clinic</a></li>
				<li><a href="{{route('doctors.index')}}">Doctors</a></li>
				<li><a href="{{route('staffs.index')}}">Staffs</a></li>
				<li><a href="all-page.html">Pages</a></li>	
				<li><a href="{{ route('login.logout') }}">Logout</a></li>
			@endif
			
			@if (Session::has('user_details') && Session::get('user_details')->role=="Doctor")
				<li><a href="{{route('doctor.dashboard')}}">Home</a></li>			
				<li><a href="{{route('timings.index')}}">Timings</a></li>
				<li><a href="{{route('doctor.current.appointments')}}">Current Appointments</a></li>
				<li><a href="{{route('doctor.patients')}}">Patients</a></li>
				<li><a href="{{ route('login.logout') }}">Logout</a></li>
			@endif
			
			@if (Session::has('user_details') && Session::get('user_details')->role=="Staff")
				<li><a href="{{route('staff.dashboard')}}">Home</a></li>
				<li><a href="{{route('clinic.show')}}">My Clinic</a></li>
				<li><a href="{{route('clinic.doctors')}}">Doctors</a></li>
				<li><a href="{{ route('login.logout') }}">Logout</a></li>
			@endif
		</ul>
	</div>
</div>

<!-- navbar end -->