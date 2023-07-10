<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ trans('panel.site_title') }}</title>
	<link href="{{ asset('images/favicon.ico') }}" rel="icon">
	@if($_ENV['ENVIRONMENT'] == "local")
		@vite(['resources/scss/app.scss', 'resources/js/app.js'])
	@else
		@php
			$manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
		@endphp
		<script type="module" src="/build/{$manifest['resources/js/app.js']['file']}"></script>
		<link rel="stylesheet" href="/build/{$manifest['resources/js/app.js']['css'][0]}">
	@endif
	
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
	@yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">
	<div class="shape-bg"></div>
	@include('layouts.header')
	<div class="main-container container">
		@if (Session::has('user_details'))
			@yield('heading')				
			<div class="row">
				<div class="col-lg-3">
					@include('layouts.navigation')
				</div>
				<div class="col-lg-9">
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