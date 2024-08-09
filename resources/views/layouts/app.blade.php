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

	<!-- Splide js -->
	<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

	<!-- Remix Icon -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  	<div class="container">
	  		<a class="navbar-brand" href="#">
	  			<img src="{{ asset('assets/img/lapakami-logo-text.png') }}" height="50px" alt="Lapakami Logo" />
	  		</a>
		  	
		  	<!-- Off Canvas Button -->
	  		<button class="btn btn-icon btn-primary rounded-circle py-1 d-inline d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
			  	<i class="ri-menu-line"></i>
			</button>
	  		<!-- End Off Canvas Button -->

		  	<div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav ms-4">
			      	<li class="nav-item">
			        	<a class="nav-link @if(Request::segment(1) == '') active @endif" href="{{ url('/') }}">Beranda</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link @if(Request::segment(1) == 'layanan') active @endif" href="{{ url('layanan') }}">Layanan</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link @if(Request::segment(1) == 'pusat-bantuan') active @endif" href="{{ url('pusat-bantuan') }}">Pusat Bantuan</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link @if(Request::segment(1) == 'kontak-kami') active @endif" href="{{ url('kontak-kami') }}">Kontak Kami</a>
			      	</li>
			    </ul>
			    <ul class="navbar-nav ms-auto">
			    	<li class="nav-item">
			        	<a class="nav-link" href="{{ url('masuk') }}">Masuk</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link btn btn-outline-primary rounded-pill px-3" href="{{ url('daftar') }}">Pendaftaran</a>
			      	</li>
			    </ul>
			</div>
	  	</div>
	</nav>
	<!-- End Navbar -->

	<!-- Off Canvas Nav -->
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
	  	<div class="offcanvas-header">
	    	<a class="navbar-brand" href="#">
	  			<img src="{{ asset('assets/img/lapakami-logo-text.png') }}" height="50px" alt="Lapakami Logo" />
	  		</a>
	    	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	  	</div>
	  	<div class="offcanvas-body">
	    	<ul class="nav flex-column">
			  	<li class="nav-item">
			       	<a class="nav-link @if(Request::segment(1) == '') active @endif" href="{{ url('/') }}">Beranda</a>
			    </li>
			    <li class="nav-item">
			        <a class="nav-link @if(Request::segment(1) == 'layanan') active @endif" href="{{ url('layanan') }}">Layanan</a>
			    </li>
			    <li class="nav-item">
			        <a class="nav-link @if(Request::segment(1) == 'pusat-bantuan') active @endif" href="{{ url('pusat-bantuan') }}">Pusat Bantuan</a>
			    </li>
			    <li class="nav-item">
			       	<a class="nav-link @if(Request::segment(1) == 'kontak-kami') active @endif" href="{{ url('kontak-kami') }}">Kontak Kami</a>
			    </li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="{{ url('masuk') }}">Masuk</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" href="{{ url('daftar') }}">Pendaftaran</a>
			  	</li>
			</ul>
	  	</div>
	</div>
	<!-- Off Canvas Nav -->

	<!-- Content -->
	@yield('content')
	<!-- End Content -->


	<!-- Footer -->
	<section class="footnote py-6">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-3 mb-md-0">
					<h5 class="text-dark fw-bold mb-4">Tentang Lapakami</h5>
					<p class="me-5">Layanan Publik Kecamatan Kelurahan Kota Cimahi dikembangkan oleh Dinas Komunikasi dan Informatika Kota Cimahi.</p>

					<p class="mb-3">
						Masukan dan saran dapat dikirim melalui email.
					</p>
					<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1">
						<i class="ri-mail-line text-primary"></i>
					</div> 
					<p class="d-inline-block">
						lapakami@cimahikota.go.id
					</p>
				</div>
				<div class="col-md-3 mb-3 mb-md-0">
					<h5 class="text-dark fw-bold mb-4">Situs Terkait</h5>

					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" href="https://cimahikota.go.id/" target="blank">Pemerintah Daerah Kota Cimahi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://smartcity.cimahikota.go.id/" target="blank">Portal Cimahi Smart City</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://cimut.cimahikota.go.id/" target="blank">Kecamatan Cimahi Utara</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://cimahitengah.cimahikota.go.id/" target="blank">Kecamatan Cimahi Tengah</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://cimahiselatan.cimahikota.go.id/" target="blank">Kecamatan Cimahi Selatan</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3 mb-3 mb-md-0">
					<h5 class="text-dark fw-bold mb-4">Tautan Lainnya</h5>

					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" href="{{ url('verifikasi-dokumen') }}">Verifikasi Dokumen</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://tte.kominfo.go.id/verifyPDF" target="blank">Verifikasi TTE</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('kebijakan-privasi') }}">Kebijakan Privasi</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<footer class="bg-light py-4">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
					<p class="mb-0"><small>Hak Cipta 2023 Lapakami.</small></p>
					<p class="mb-0"><small>Pemerintah Daerah Kota Cimahi</small></p>
				</div>
				<div class="col-md-6 text-center text-md-end">
					<p class="mb-0 d-inline-block me-2"><small>Didukung oleh<small></p>
					<!-- <img src="{{ asset('assets/img/logo-pemkot-cimahi.png') }}" class="mx-2" height="40px" alt="Kota Cimahi" /> -->
					<!-- <img src="{{ asset('assets/img/logo-smartcity.png') }}" class="mx-2"  height="40px" alt="Smart City" /> -->
					<a href="https://diskominfo.cimahikota.go.id/" target="blank">
						<img src="{{ asset('assets/img/logo-diskominfo.png') }}" class="mx-2" height="40px" alt="Diskominfo Cimahi" />
					</a>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->

	<!-- Javascript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

	<!-- Jquery Validation -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-validation/dist/additional-methods.min.js') }}">
    </script>

    <script>
        var splide = new Splide('.splide', {
            type: 'loop',
            perPage: 4,
            breakpoints: {
				800: {
					perPage: 2,
				},
				480: {
					perPage: 1,
				},
		  	},
            rewind: true,
            autoplay: false
        });

        splide.mount();
    </script>

    @yield('script')

    {!! NoCaptcha::renderJs() !!}
	<!-- End  Javascript -->
</body>
</html>