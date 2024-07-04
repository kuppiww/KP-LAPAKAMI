<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		@if(View::hasSection('title'))
			@yield('title') - 
		@endif

		Lapakami Pemerintah Daerah Kota Cimahi
	</title>

	<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/lapakami-favicon.png') }}">

	<!-- Bootstap 5.3 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

	<!-- Remix Icon -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
</head>
<body style="height: 100vh;">

	<!-- Content -->
	@yield('content')
	<!-- End Content -->

	<!-- Javascript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>