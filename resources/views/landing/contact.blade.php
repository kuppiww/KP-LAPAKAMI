@extends('layouts.app')
@section('title') Kontak Kami @endsection

@section('content')
<!-- Title -->
<div class="py-6 bg-light">
	<div class="container">
		<div class="text-center">
			<h2 class="fw-bold text-dark">Kontak Kami</h2>
			<p class="text-muted mb-0">Hubungi informasi kontak sesuai dengan kebutuhan anda</p>
		</div>

		<div class="mt-5">
			<!-- Tab Action -->
			<ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
				    <button class="nav-link active" id="pills-cimut-tab" data-bs-toggle="pill" data-bs-target="#tab-cimut" type="button" role="tab" aria-controls="pills-cimut" aria-selected="true">Kecamatan Cimahi Utara</button>
				</li>
				<li class="nav-item" role="presentation">
				    <button class="nav-link" id="pills-cimteng-tab" data-bs-toggle="pill" data-bs-target="#tab-cimteng" type="button" role="tab" aria-controls="pills-cimteng" aria-selected="false">Kecamatan Cimahi Tengah</button>
				</li>
				<li class="nav-item" role="presentation">
				    <button class="nav-link" id="pills-cimsel-tab" data-bs-toggle="pill" data-bs-target="#tab-cimsel" type="button" role="tab" aria-controls="pills-cimsel" aria-selected="false">Kecamatan Cimahi Selatan</button>
				</li>
			</ul>
			<!-- End Tab Action -->
		</div>
	</div>
</div>
<!-- End Title -->

<!-- Contact -->
<div class="py-6">
	<div class="container">
		<div class="row justify-content-center">
			
			<div class="col-md-12">
				<!-- Tab Content -->
				<div class="tab-content" id="myTabContent">
				  	<!-- Cimahi Utara -->
				  	<div class="tab-pane fade show active" id="tab-cimut" role="tabpanel" aria-labelledby="tab-cimut" tabindex="0">
				  		<div class="text-center">
				  			<h4 class="mb-3 fw-bold text-dark">Kecamatan Cimahi Utara</h4>
							<p>Jl. Serut No. 12 Kelurahan Cibabat Kecamatan Cimahi Utara, Kota Cimahi</p>

							<div class="d-md-inline-block d-block mb-3 mb-md-0">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1">
									<i class="ri-mail-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									cimahiutara@cimahikota.go.id
								</p>
							</div>
							<div class="d-md-inline-block d-block">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1 ms-3">
									<i class="ri-phone-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									(022) 6654591 / (022) 6654591
								</p>
							</div>
				  		</div>

						<!-- Subdistrict -->
						<div class="row mt-3 equal g-4">
							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cipageran</h5>
										<p class="mb-1">Jl. Cipageran No.77, Cipageran, Cimahi Utara, Kota Cimahi, Jawa Barat 40511</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cipageran@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6654063</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Citeureup</h5>
										<p class="mb-1">Jl. Encep Kartawiria No. 29 Cimahi, Cimahi Utara, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> citeureup@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 9954093/(022) 9954093</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cibabat</h5>
										<p class="mb-1">Jl. Sirnarasa No.18 RT 01 RW 25 Kelurahan Cibabat Kecamatan Cimahi Utara Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cibabat@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6654095/(022) 6654095</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Pasirkaliki</h5>
										<p class="mb-1">Jl. Gunung Batu Cidamar Cimahi, Cimahi Utara, Kota Cimahi, Jawa Barat 40511</p>
										<p class="mb-1"><span class="text-primary">Email:</span> pasirkaliki@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span>(022) 2001731</p>
									</div>
								</div>
							</div>
						</div>
						<!-- End Subdistrict -->
				  	</div>
				  	<!-- End Cimahi Utara -->

				  	<!-- Cimahi Tengah -->
				  	<div class="tab-pane fade show" id="tab-cimteng" role="tabpanel" aria-labelledby="tab-cimteng" tabindex="0">
				  		<div class="text-center">
				  			<h4 class="mb-3 fw-bold text-dark">Kecamatan Cimahi Tengah</h4>
							<p>Jl. Terusan No. 44 Cimahi Kelurahan Cimahi Kecamatan Cimahi Tengah, Kota Cimahi</p>

							<div class="d-md-inline-block d-block mb-3 mb-md-0">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1">
									<i class="ri-mail-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									cimahitengah@cimahikota.go.id
								</p>
							</div>
							<div class="d-md-inline-block d-block">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1 ms-3">
									<i class="ri-phone-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									(022) 6654592 / (022) 6654592
								</p>
							</div>
				  		</div>

						<!-- Subdistrict -->
						<div class="row mt-3 equal g-4">
							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Baros</h5>
										<p class="mb-1">Jl. Haji Haris No. 8/b, Cimahi Tengah, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> baros@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6644604/(022) 6644608</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cigugur Tengah</h5>
										<p class="mb-1">Jl. RH. Abdul Halim No.24 Cimahi 40522, Cimahi Tengah, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cigugurtengah@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6634746/(022) 6634746</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Karangmekar</h5>
										<p class="mb-1"> Jl. Lurah No.26 Cimahi 40523, Cimahi Tengah, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> karangmekar@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6652090</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Setiamanah</h5>
										<p class="mb-1">Jl. Ubed No.1 Cimahi 40524, Cimahi Tengah, Kota Cimahi, Jawa Barat</p>
										<p class="mb-1"><span class="text-primary">Email:</span> setiamanah@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span>(022) 6654087</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cimahi</h5>
										<p class="mb-1">Jl. Terusan No. 41 RT 007 RW 003, Cimahi Tengah, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cimahi@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6641829/(022) 6641829</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Padasuka</h5>
										<p class="mb-1">Jl. Kebon Manggu No 6 Padasuka 40526, Cimahi Tengah, Kota Cimahi, Jawa Barat</p>
										<p class="mb-1"><span class="text-primary">Email:</span> padasuka@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6621678/(022) 6621678</p>
									</div>
								</div>
							</div>
						</div>
						<!-- End Subdistrict -->
				  	</div>
				  	<!-- End Cimahi Tengah -->

				  	<!-- Cimahi Selatan -->
				  	<div class="tab-pane fade show" id="tab-cimsel" role="tabpanel" aria-labelledby="tab-cimsel" tabindex="0">
				  		<div class="text-center">
				  			<h4 class="mb-3 fw-bold text-dark">Kecamatan Cimahi Selatan</h4>
							<p>Jalan Baros No 14 Kelurahan Utama Kecamatan Cimahi Selatan, Kota Cimahi</p>

							<div class="d-md-inline-block d-block mb-3 mb-md-0">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1">
									<i class="ri-mail-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									cimahiselatan@cimahikota.go.id
								</p>
							</div>
							<div class="d-md-inline-block d-block">
								<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1 ms-3">
									<i class="ri-phone-line text-primary"></i>
								</div> 
								<p class="d-inline-block mb-0">
									(022) 6629676 / (022) 6631950
								</p>
							</div>
				  		</div>

						<!-- Subdistrict -->
						<div class="row mt-3 equal g-4">
							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cibeber</h5>
										<p class="mb-1">Jl. Ibu Ganirah No. 41 Cibeber, Cimahi Selatan, Kota Cimahi, Jawa Barat</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cibeber@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6672994/(022) 6672994</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Leuwigajah</h5>
										<p class="mb-1">Jl. Sadarmah No.11 Kel. Leuwigajah, Cimahi Selatan, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> leuwigajah@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6672995/(022) 6672995</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Utama</h5>
										<p class="mb-1">Jl. Nanjung No.58 Utama, Cimahi Selatan, Kota Cimahi</p>
										<p class="mb-1"><span class="text-primary">Email:</span> utama@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span> (022) 6676995</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Melong</h5>
										<p class="mb-1">Jl. Melong Sakola No. 72, Cimahi Selatan, Kota Cimahi, Jawa Barat</p>
										<p class="mb-1"><span class="text-primary">Email:</span> melong@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span>(022) 6026961</p>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="card border-0 bg-light h-100 p-3">
									<div class="card-body">
										<h5>Kelurahan Cibeureum</h5>
										<p class="mb-1">Jl. Jendral H. Amir Mahmud No.125, Cimahi Selatan, Kota Cimahi, Jawa Barat</p>
										<p class="mb-1"><span class="text-primary">Email:</span> cibeureum@cimahikota.go.id</p>
										<p class="mb-0"><span class="text-primary">No.Telp/Fax:</span>(022) 6002605</p>
									</div>
								</div>
							</div>
						</div>
						<!-- End Subdistrict -->
				  	</div>
				  	<!-- End Cimahi Selatan -->
				</div>
				<!-- End Tab Content -->
			</div>
		</div>
	</div>
</div>
<!-- End Contact -->

<!-- Seuggestion -->
<div class="">
	<div class="container">
		<div class="row bg-contact p-4 p-md-5 rounded-4 mx-1 mx-md-0">
			<div class="col-md-6">
				<h2 class="fw-bold text-dark">Saran & Masukan</h2>
				<p class="text-muted mb-0">Pendapat anda dapat membantu aplikasi menjadi lebih baik</p>

				<h5 class="mt-4">Pemerintah Daerah Kota Cimahi</h5>
				<p>Jl. Raden Demang Hardjakusumah Blok Jati Cihanjuang No.1, Kelurahan Cibabat, Kec. Cimahi Utara, Kota Cimahi</p>

				<div class="btn bg-light d-inline-block btn-icon rounded-circle me-3 py-1">
					<i class="ri-mail-line text-primary"></i>
				</div> 
				<p class="d-inline-block mb-0">
					lapakami@cimahikota.go.id
				</p>
			</div>
		</div>
	</div>
</div>
<!-- End Seuggestion -->
@endsection