@extends('layouts.user')
@section('title') Bantuan @endsection

@section('content')
<div class="row mb-4 align-items-center">
	<div class="col-md-12">
		<h4 class="text-dark fw-bold mb-0">Bantuan</h4>
	</div>
</div>

{{-- <div class="card p-2 border-0">
	<div class="card-body">

		<div class="row align-items-center">
			<div class="col-md-3 text-center">
				<img src="{{ asset('assets/img/lapakami-icon-tutorial.png') }}" height="100px" alt="Video Tutorial" />
			</div>
			<div class="col-md-9 text-md-start text-center">
				<h5 class="text-dark">Video Tutorial</h5>
				<p>Tersedia petunjuk untuk menggunakan aplikasi Lapakami dalam bentuk video yang dapat diakses pada tautan disamping.</p>

				<a href="#" class="btn btn-primary rounded-pill px-3">
					<i class="ri-play-line me-2"></i>
					Lihat Video Versi Lengkap
				</a>
			</div>
		</div>

	</div>
</div> --}}

<div class="card p-2 border-0 mt-4">
	<div class="card-body">
		<div class="row align-items-center">
			<div class="col-md-3 text-center">
				<img src="{{ asset('assets/img/lapakami-icon-manual.png') }}" height="100px" alt="Video Tutorial" />
			</div>
			<div class="col-md-9 text-md-start text-center">
				<h5 class="text-dark">Buku Panduan</h5>
				<p>Dan juga tersedia petunjuk dalam bentuk buku yang dapat diakses melalui tautan dibawah.</p>

				<a href="https://s.id/buku-panduan-lapakami-umum" class="btn btn-primary rounded-pill px-3 my-1" target="blank">
					<i class="ri-download-cloud-line me-2"></i>
					Unduh Panduan Versi Singkat
				</a>

				<a href="https://s.id/buku-panduan-lapakami-detail" class="btn btn-primary rounded-pill px-3 my-1" target="blank">
					<i class="ri-download-cloud-line me-2"></i>
					Unduh Panduan Versi Lengkap
				</a>
			</div>
		</div>

	</div>
</div>
@endsection