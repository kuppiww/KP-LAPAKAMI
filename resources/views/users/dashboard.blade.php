@extends('layouts.user')
@section('title') Beranda @endsection

@section('content')
<div class="card border-0 p-2 bg-warning">
	<div class="card-body">
		<i class="ri-information-line float-start fs-2 me-3 text-white"></i>
		<h5 class="text-white fw-bold mb-1">Informasi</h5>
		<p class="mb-0 text-white">Untuk melakukan pengajuan layanan anda harus mengekapi profil anda terlebih dahulu</p>
	</div>
</div>

<div class="row mt-4">
	<div class="col-md-8">
		
		<div class="card border-0 p-1 mb-3">
			<div class="card-body">

				<h5 class="text-dark fw-bold mb-3">Permohonan Layanan Terakhir</h5>
				
				<table class="table table-borderless">
					<thead>
						<tr>
							<th>Layanan</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Surat Keterangan Keramaian <br>
								<small class="text-muted">20 Januari 2023 10:00</small>
							</td>
							<td valign="middle">
								<span class="badge bg-info">Pengajuan</span>
							</td>
						</tr>
						<tr>
							<td>
								Surat Keterangan Kelahiran <br>
								<small class="text-muted">20 Januari 2023 10:00</small>
							</td>
							<td valign="middle">
								<span class="badge bg-success">Selesai</span>
							</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>

		<!-- <a href="" class="btn btn-pri	mary w-100 rounded-pill">Buat Permohonan Baru</a> -->
	</div>
	<div class="col-md-4">
		
		<div class="card border-0 p-2">
			<div class="card-body">
				
				<h5 class="text-dark fw-bold mb-3">Statistik Layanan</h5>

				<div class="row mb-3">
					<div class="col-10"><p class="mb-0">Pengajuan</p></div>
					<div class="col-2 text-end"><p class="mb-0">1</p></div>
				</div>
				<div class="row mb-3">
					<div class="col-10"><p class="mb-0">Verifikasi Berkas</p></div>
					<div class="col-2 text-end"><p class="mb-0">0</p></div>
				</div>
				<div class="row mb-3">
					<div class="col-10"><p class="mb-0">Pembuatan Dokumen</p></div>
					<div class="col-2 text-end"><p class="mb-0">0</p></div>
				</div>
				<div class="row">
					<div class="col-10"><p class="mb-0">Selesai</p></div>
					<div class="col-2 text-end"><p class="mb-0">1</p></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection