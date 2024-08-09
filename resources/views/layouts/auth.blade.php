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

	<div class="row h-100">

		<!-- Side Title -->
		<div class="col-md-4 h-100 bg-primary align-items-center d-none d-md-flex">
			<div class="mx-5">
				<!-- Back Button -->
				<div class="mb-5 d-flex align-items-center">
					<a href="{{ url('/') }}" class="btn btn-lg btn-icon btn-white rounded-circle py-1 me-3">
						<i class="ri-arrow-left-line"></i>
					</a>
					<a href="{{ url('/') }}" class="text-white d-inline-block">Halaman Utama</a>
				</div>
				<!-- End Back Button -->
				
				<!-- Tagline -->
				<h3 class="text-white fw-bold">Layanan Publik Kecamatan Kelurahan Kota Cimahi</h3>
				<p class="text-white">Memberikan kemudahan pelayanan masyarakat Kota Cimahi secara online.</p>
				<!-- End Tagline -->

				<!-- Footer -->
				<footer class="mt-5">
					<p class="mb-0 text-white"><small>Hak Cipta 2023 Lapakami<br>Pemerintah Daerah Kota Cimahi</small></p>
				</footer>
				<!-- End Footer -->
			</div>
		</div>
		<!-- End Side Title -->

		<!-- Main -->
		<div class="col-md-8">
			<div class="row justify-content-center align-items-center h-100 w-100 mx-0">
				<div class="col-md-10 col-11">

			  		<!-- Back Button Mobile -->
					<div class="mb-4 mt-4 d-flex align-items-center position-absolute top-0 d-md-none">
						<a href="{{ url('/') }}" class="btn btn-lg btn-icon btn-primary rounded-circle py-1 me-3">
							<i class="ri-arrow-left-line"></i>
						</a>
						<a href="{{ url('/') }}" class="text-dark d-inline-block">Halaman Utama</a>
					</div>
					<!-- End Back Button Mobile -->

					<!-- Content -->
					<div class="mt-md-0 mt-100">
						@yield('content')
					</div>
					<!-- End Content -->

					<!-- Footer Mobile -->
					<footer class="mb-4 mt-5 d-block d-md-none">
						<p class="mb-0 text-muted"><small>Hak Cipta 2023 Lapakami.<br>Pemerintah Daerah Kota Cimahi</small></p>
					</footer>
					<!-- End Footer Mobile -->

				</div>
			</div>
		</div>
		<!-- End Main -->

	</div>

	<!-- Javascript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<!-- Jquery Validation -->
	<script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/additional-methods.min.js') }}"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		 jQuery.validator.addMethod("alphanumeric", function(value, element) {
			 return this.optional(element) || /^[\w.\%\-\_\&\(\)\s\,\?\!]+$/i.test(value);
		 }, "Letters, numbers, and underscores only please");
	});
	</script>
	<!-- /Jquery Validation / -->

	<!-- Google reCaptcha -->
	{!! NoCaptcha::renderJs() !!}

	<!-- Script -->
	@yield('script')
	<!-- End Script -->
	 
	<!-- End  Javascript -->

</body>
</html>