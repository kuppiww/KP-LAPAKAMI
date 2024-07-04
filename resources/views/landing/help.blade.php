@extends('layouts.app')
@section('title') Pusat Bantuan @endsection

@section('content')

<!-- End Guide -->
<!-- Guide -->
<div class="py-6">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mb-4 md-md-0">
				<div class="overflow-hidden">
					<iframe class="rounded" width="100%" height="320px" src="https://www.youtube.com/embed/mFQwxVJ9DCk" title="Forum Satu Data Kota Cimahi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				</div>
			</div>
			<div class="col-md-5 ms-auto">
				<h2 class="fw-bold text-dark">Petunjuk Penggunaan</h2>
				<p class="text-muted mb-0">Petunjuk cara menggunakan aplikasi Lapakami</p>

				<h5 class="mt-4">Video Tutorial</h5>
				<p>Tersedia petunjuk untuk menggunakan aplikasi Lapakami dalam bentuk video yang dapat diakses pada tautan disamping.</p>

				<h5 class="mt-4">Buku Panduan</h5>
				<p>Dan juga tersedia petunjuk dalam bentuk buku yang dapat diakses melalui tautan dibawah.</p>

				<a href="https://s.id/buku-panduan-lapakami" class="btn btn-primary rounded-pill px-3">
					<i class="ri-download-cloud-line me-2"></i>
					Unduh Buku Panduan Lapakami
				</a>
			</div>
		</div>
	</div>
</div>
<!-- End Guide -->


<!-- FAQ -->
<div class="">
	<div class="container">
		<div class="bg-light p-3 p-md-5 rounded-4">
			<div class="text-center mt-3 mt-md-0">
				<h2 class="fw-bold text-dark">Pertanyaan Sering Ditanyakan</h2>
				<p class="text-muted mb-0">Daftar pertanyaan yang sering ditanyakan oleh masyarakat</p>
			</div>
			<div class="row justify-content-center mt-5">
				<div class="col-md-8">
					<div class="card p-3 border-0 bg-white mb-4">
						<div class="card-body">
							<h5 class="text-primary">1. Apakah ada biaya yang dikeluarkan?</h5>
							<p class="mb-0">Untuk semua pelayanan yang tersedia pada aplikasi Lapakami tidak dipungut biaya apapun.</p>
						</div>
					</div>

					<div class="card p-3 border-0 bg-white mb-4">
						<div class="card-body">
							<h5 class="text-primary">2. Apakah perlu datang ke kelurahan atau kecamatan?</h5>
							<p class="mb-0">Secara umum untuk layanan ini tidak perlu datang ke kelurahan atau kecamatan, dimana pelayanan dilakukan secara online akan tetapi ada beberapa pelayanan yang masih mengharuskan datang karena satu dan lain, infomasi ini dapat dilihat pada masing-masing halaman layanan yang dapat diakses <a href="{{ url('layanan') }}">disini</a>.</p>
						</div>
					</div>

					
					<div class="card p-3 border-0 bg-white mb-4">
						<div class="card-body">
							<h5 class="text-primary">3. Apakah perlu memiliki akun untuk mengajukan permohonan layanan?</h5>
							<p class="mb-0">Iya, masyarakat diwajibkan untuk memiliki akun Lapakami untuk membuat permohonan layanan.</p>
						</div>
					</div>

					
					<div class="card p-3 border-0 bg-white mb-4">
						<div class="card-body">
							<h5 class="text-primary">4. Apakah satu akun dapat mengajukan lebih dari satu permohonan layanan?</h5>
							<p class="mb-0">Iya, satu akun Lapakami dapat membuat permohonan lebih dari satu kali dengan keperluan layanan sesuai dengan kebutuhan, akan tetapi Dokumen yang dihasilkan hanya diperuntukan untuk pemilik akun tersebut saja.</p>
						</div>
					</div>

					<div class="card p-3 border-0 bg-white mb-4">
						<div class="card-body">
							<h5 class="text-primary">5. Apakah akun saya dapat mengajukan permohonan untuk orang lain?</h5>
							<p class="mb-0">Tidak bisa, untuk membuat permohonan untuk orang lain orang yang bersangkutan perlu membuat akun Lapakami secara pribadi.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End FAQ -->
@endsection
