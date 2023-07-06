<!-- preloader area start -->
<div class="preloader" id="preloader">
	<div class="preloader-inner">
		<div class="spinner">
			<div class="dot1"></div>
			<div class="dot2"></div>
		</div>
	</div>
</div>
<!-- preloader area end -->

<!-- header start -->
<div class="header-wrapper">
	<div class="container">
		<div class="row">

			<div class="col-sm-4 col-4">
				<a href="home.html" class="logo">
					<img src="{{asset('img/logo.svg') }}" alt="logo">
				</a>
			</div>
			<div class="col-sm-4 col-8 text-right ms-md-auto">
				<ul class="nav user-menu float-end">
					<li class="nav user-menu float-end has-arrow user-profile-list">
						@if (Session::has('user_details'))
						Hi {{Session::get('user_details')->name}}
						<a class="btn btn-secondary btn-rounded" href="{{ route('login.logout') }}">Logout</a>
						@else
						<button class="btn btn-secondary btn-rounded" data-toggle="dropdown">Login</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('login.show') }}">Login</a>
						<a class="dropdown-item" href="{{ route('patient.login.show') }}">Patient Login</a>
						<a class="dropdown-item" href="{{ route('patient.register.show') }}">Patient Registartion</a>
						</div>
						@endif
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- header end -->
@if (Session::has('close_status'))
<div class="balance-area pd-top-40 mg-top-50">
	<div class="container">
		<div class="text-center p-4 bg-danger mb-4">Clinic is closed today</div>
	</div>
</div>
@endif
<!-- //. search Popup -->
<!-- header start -->
<!--div class="header-area" style="background-image: url({{ asset('img/bg/1.png') }});">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-3">
				<a class="menu-back-page" href="home.html">
					<i class="fa fa-angle-left"></i>
				</a>
			</div>
			<div class="col-sm-4 col-6 text-center">
				<div class="page-name">@yield('page')</div>
			</div>
			<div class="col-sm-4 col-3 text-right">
				<div class="search header-search">
					<i class="fa fa-search"></i>
				</div>
			</div>
		</div>
	</div>
</div-->
<!-- header end -->