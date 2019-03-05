<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title> @yield('title') </title>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/all.class.css') }}">
	@yield('styles')

</head>
<body>

	<div class="content">
		@yield('content')
	</div>

<!-- Scripts -->
<script src="{{ asset('js/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrapjs/bootstrap-4.0.0/dist/js/bootstrap.min.js') }}"></script>
@yield('scripts')
</body>
</html>