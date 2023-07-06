<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ trans('panel.site_title') }}</title>
	<link href="{{ asset('images/favicon.ico') }}" rel="icon">
	@vite(['resources/scss/app.scss', 'resources/js/app.js'])
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	@yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">
	<div class="shape-bg"></div>
	@include('layouts.header')
	<div class="main-container container">
		@if (Session::has('user_details'))
			@yield('heading')			
			<ol class="breadcrumb">		
				<?php $segments = ''; ?>
				@foreach(Request::segments() as $segment)
					<?php $segments .= '/'.$segment; ?>
					<li>
						<a href="{{ $segments }}">{{$segment}}</a>
					</li>
				@endforeach
			</ol>		
			<div class="row">
				<div class="col-md-3">
					@include('layouts.navigation')
				</div>
				<div class="col-md-9">
					<div class="card-box">
						@yield('content')
					</div>
				</div>
			</div>
		@else
			@yield('content')
		@endif
	</div>
	@include('layouts.footer')
	@yield('modal')
	@yield('scripts')
</body>

</html>