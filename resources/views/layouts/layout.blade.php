<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ trans('panel.site_title') }}</title>
		<link href="{{ asset('images/favicon.ico') }}" rel="icon">	
		
		<link href="{{ asset('css/vendor.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
		
		@yield('styles')
	</head>
	<body>  
		@include('layouts.header')
		
		@include('layouts.navigation')
 
  		@yield('content')
 
		@include('layouts.footer')
		
		@yield('scripts')
	</body>
</html>
