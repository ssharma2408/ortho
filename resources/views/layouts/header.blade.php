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
<div class="header-area" style="background-image: url({{ asset('img/bg/1.png') }});">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-3">
				<div class="menu-bar">
					<i class="fa fa-bars"></i>
				</div>
			</div>
			<div class="col-sm-4 col-4 text-center">
				<a href="home.html" class="logo">
					<img src="{{ asset('img/logo_myclinic.png') }}" alt="logo">
				</a>
			</div>
			<div class="col-sm-4 col-5 text-right">
				<ul class="header-right">
					<li>
						<a href="#">
							<i class="fa fa-envelope"></i>
							<span class="badge">9</span>
						</a>
					</li>
					<li>
						<a href="notification.html">
							<i class="fa fa-bell animated infinite swing"></i>
							<span class="badge">6</span>
						</a>
					</li>
					<li>
						<a class="header-user" href="user-setting.html"><img src="{{ asset('img/user.png') }}" alt="img"></a>
					</li>
					<li>
						@if (Session::has('user_details'))
							Hi {{Session::get('user_details')->name}} <a href="{{ route('login.logout') }}">Logout</a>
						@else
							<a href="{{ route('login.show') }}">Login</a>
							<a href="{{ route('login.showpatient') }}">Patient Login</a>
						@endif
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- header end -->


<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
	<form action="/" class="search-form">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search.....">
		</div>
		<button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
	</form>
</div>
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
