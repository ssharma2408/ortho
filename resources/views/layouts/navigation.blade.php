<!-- navbar end -->
<div class="ba-navbar">
	<div class="ba-navbar-user mb-0">
		<div class="menu-close">
			<i class="la la-times"></i>
		</div>
		<div class="thumb">
			<img src="{{ asset('img/user.png') }}" alt="user">
		</div>
		<div class="details">
			<h5>Raduronto kelax</h5>
		</div>
	</div>
	<div class="ba-main-menu mt-0">
		<h5>Menu</h5>
		<ul>
			@if (Session::has('user_details') && Session::get('user_details')->role=="Clinic Admin")
				<li><a href="{{route('clinic.admin.dashboard')}}">Home</a></li>
				<li><a href="{{route('my-clinic.show')}}">My Clinic</a></li>
				<li><a href="home.html">Doctors</a></li>
				<li><a href="{{route('staffs.index')}}">Staffs</a></li>
				<li><a href="all-page.html">Pages</a></li>	
				<li><a href="signup.html">Logout</a></li>
			@endif
			
			@if (Session::has('user_details') && Session::get('user_details')->role=="Doctor")
				<li><a href="{{route('dashboard')}}">Home</a></li>			
				<li><a href="signup.html">Logout</a></li>
			@endif
		</ul>
		<a class="btn btn-purple" href="#">View Profile</a>
	</div>
</div>
<!-- navbar end -->