@extends('layouts.userblank')
@section('title') Detail Permohonan Layanan @endsection

@section('content')
<!-- Back Button -->
<div class="mb-4 d-flex align-items-center">
	<a href="{{ url('user/layanan') }}" class="btn btn-lg btn-icon btn-light rounded-circle py-1 me-3">
		<i class="ri-arrow-left-line"></i>
	</a>
	<a href="{{ url('user/layanan') }}" class="d-inline-block">Kembali</a>
</div>
<!-- End Back Button -->

<div class="row mb-4 align-items-center">
	<div class="col-md-12">
		<h4 class="text-dark fw-bold mb-0">Detail Permohonan Layanan</h4>
		<p class="mb-0 text-muted">Surat Keterangan Kependudukan</p>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="card p-2 border-0">
			<div class="card-body">

				<!-- Tab Action -->
				<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link active" id="pills-user-tab" data-bs-toggle="pill" data-bs-target="#pills-user" type="button" role="tab" aria-controls="pills-user" aria-selected="true">Informasi Pemohon</button>
				  	</li>
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link" id="pills-service-tab" data-bs-toggle="pill" data-bs-target="#pills-service" type="button" role="tab" aria-controls="pills-service" aria-selected="false">Informasi Layanan</button>
				  	</li>
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link" id="pills-requirement-tab" data-bs-toggle="pill" data-bs-target="#pills-requirement" type="button" role="tab" aria-controls="pills-requirement" aria-selected="false">Berkas Persyaratan</button>
				  	</li>
				</ul>
				<!-- End Tab Action -->

				<!-- Tab Content -->
				<div class="tab-content" id="pills-tabContent">
					<!-- Tab 1. Informasi Pemohon -->
				  	<div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
				  		<div class="row">
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Nomor Induk Kependudukan</label><br>
				  					3277123456789012
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Nomor Kartu Keluarga</label><br>
				  					3277123456789012
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Nama Lengkap</label><br>
				  					Yudi Permana
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Jenis Kelamin</label><br>
				  					Laki-laki
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Tempat Lahir</label><br>
				  					Cimahi
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Tanggal Lahir</label><br>
				  					01 Januari 2023
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Agama</label><br>
				  					Islam
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Kewarganegaraan</label><br>
				  					WNI
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Status Perkawinan</label><br>
				  					Kawin
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Pekerjaan</label><br>
				  					Karyawan Swasta
				  				</p>
				  			</div>
				  			<div class="col-md-12">
				  				<p>
				  					<label class="form-label">Alamat Lengkap</label><br>
				  					Jl. Raden Demang Hardjakusumah Blok Jati Cihanjuang No.1, Kelurahan Cibabat, Kec. Cimahi Utara, Kota Cimahi
				  				</p>
				  			</div>
				  		</div>
					</div>
					<!-- End Tab 1. Informasi Pemohon -->

					<!-- Tab 2. Informasi Layanan -->
				  	<div class="tab-pane fade" id="pills-service" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
				  		<div class="row">
				  			<div class="col-md-12 mb-3">
				  				<h5 class="text-dark">Informasi Surat Pengantar</h5>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Nomor Surat</label><br>
				  					ABC/02/2023
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Tanggal Surat</label><br>
				  					01 Januari 2023
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Kecamatan</label><br>
				  					Cimahi Selatan
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Kelurahan</label><br>
				  					Leuwigajah
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Rukun Tetangga (RT)</label><br>
				  					1
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Rukun Warga (RW)</label><br>
				  					2
				  				</p>
				  			</div>
				  		</div>
				  	</div>
				  	<!-- End Tab 2. Informasi Layanan -->

				  	<!-- Tab 3. Berkas Persyaratan -->
				  	<div class="tab-pane fade" id="pills-requirement" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
				  		<div class="row">
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Foto Kartu Tanda Penduduk (KTP)</label><br>
				  					<a href="" class="btn btn-light"><i class="ri-image-line me-2"></i> KTP Yudi.jpg</a>
				  				</p>
				  			</div>
				  			<div class="col-md-6">
				  				<p>
				  					<label class="form-label">Foto Surat Pengantar RT/RW</label><br>
				  					<a href="" class="btn btn-light"><i class="ri-image-line me-2"></i> Surat pengantar.jpg</a>
				  				</p>
				  			</div>
				  		</div>
				  	</div>
				  	<!-- End Tab 3. Berkas Persyaratan -->
				</div>
				<!-- End Tab Content -->
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card p-2 border-0 mb-4">
			<div class="card-body">
				<h5 class="text-dark mb-1 text-center">Dokumen Hasil</h5>
				<p class="text-muted text-center">Dokumen hasil permohonan anda dapat diunduh disini</p>

				<!-- Not Available -->
				<!-- <a href="" class="btn btn-danger disabled w-100"><i class="ri-file-forbid-line me-2"></i> Belum tersedia</a> -->
				<!-- End Not Available -->

				<!-- Available -->
				<a href="javascript:void(0)" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#downloadModal"><i class="ri-file-search-line me-2"></i> Lihat Dokumen</a>
				<!-- End Available -->
			</div>
		</div>
		<div class="card p-2 border-0">
			<div class="card-body">
				<h5 class="text-dark text-center mb-2">Status Pelayanan</h5>

				<div class="timeline-status">
                    <div class="tl-item active">
                        <div class="tl-dot b-warning"></div>
                        <div class="tl-content w-100">
                            <p class="mb-1 text-dark fw-semibold">Selesai</p>
                            <div class="tl-date text-muted">13 Jan 2023 10:00</div>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot b-primary"></div>
                        <div class="tl-content w-100">
                            <p class="mb-1">Proses Pembuatan</p>
                            <div class="tl-date text-muted">13 Jan 2023 10:00</div>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot b-danger"></div>
                        <div class="tl-content w-100">
                           <p class="mb-1">Proses Verifikasi</p>
                            <div class="tl-date text-muted">13 Jan 2023 10:00</div>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot b-danger"></div>
                        <div class="tl-content w-100">
                            <p class="mb-1">Pengajuan</p>
                            <div class="tl-date text-muted">13 Jan 2023 10:00</div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title text-dark">Surat Keterangan Kependudukan</h5>
	        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      	</div>
	      	<div class="modal-body">
	      		<embed src="{{ asset('assets/files/632d1bfd-66e6-4b03-8f48-7e60d696b66f_signed.pdf') }}" class="w-100" width="" height="500" type="application/pdf">
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
	        	<button type="button" class="btn btn-primary">Unduh</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- End Modal -->
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection