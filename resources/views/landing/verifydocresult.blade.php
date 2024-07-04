@extends('layouts.app')
@section('title') Hasil Verifikasi Dokumen @endsection

@section('content')
<!-- Guide -->
<div class="py-6">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">

				<!-- Not Verified -->
				<!-- <div class="text-center">
					<h2 class="fw-bold text-dark">Hasil Verifikasi Dokumen</h2>
					<p class="text-muted mb-2">Hasil pemeriksaan terhadap nomor surat atau dokumen</p>
					<span class="badge bg-danger"><i class="ri-close-circle-line me-2"></i> Dokumen tidak tersedia</span>
				</div> -->
				<!-- End Not Verified -->

				<!-- Verified -->
				<div class="text-center">
					<h2 class="fw-bold text-dark">Hasil Verifikasi Dokumen</h2>
					<p class="text-muted mb-2">Hasil pemeriksaan terhadap nomor surat atau dokumen</p>
					<span class="badge bg-success"><i class="ri-checkbox-circle-line me-2"></i> Dokumen tersedia dan asli</span>
				</div>

				<div class="row mt-5">
					<div class="col-md-6">
						<p>
							<small class="text-muted">ID Dokumen</small> <br>
							<b>{{ $getDoc->request_simkel_id }}</b>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<small class="text-muted">Jenis Dokumen</small> <br>
							<b>{{ $getDoc->service_name }}</b>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<small class="text-muted">Tanggal Terbit</small> <br>
							<b>{{ DateFormatHelper::dateInFull($getDoc->request_file_date) }}</b>
						</p>
					</div>
					<div class="col-md-6">
						<p>
							<small class="text-muted">Asal Dokumen</small> <br>
							<b>
								@if($getDoc->service_is_kec)
									Kecamatan {{ $getDoc->district }}
								@else
									Kelurahan {{ $getDoc->sub_district }}
								@endif
							</b>
						</p>
					</div>
				</div>

				<div class="mt-4 p-3 bg-light">
					<embed src="{{ url('backend/'. $getDoc->slug_simkel .'/besign-pdf/'. $getDoc->request_file) }}" class="w-100" width="" height="600" type="application/pdf">
				</div>
				<!-- End Verified -->
				
			</div>
		</div>

	</div>
</div>
<!-- End Guide -->
@endsection