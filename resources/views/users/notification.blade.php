@extends('layouts.user')
@section('title') Pemberitahuan @endsection

@section('content')
<div class="row mb-4 align-items-center">
	<div class="col-md-12">
		<h4 class="text-dark fw-bold mb-0">Pemberitahuan</h4>
	</div>
</div>

<div class="card p-2 border-0">
	<div class="card-body">

		<div class="notif-list">
			<p class="fw-semibold mb-0"><a class="text-dark">Surat Keterangan Keramaian</a></p>
			<p class="mb-0">Permohonan layanan sedang dalam proses verifikasi berkas</p>
			<p class="mb-0"><small class="text-muted">20 Januari 2023 10:00</small></p>
		</div>

		<div class="notif-list">
			<p class="fw-semibold mb-0"><a class="text-dark">Surat Keterangan Keramaian</a></p>
			<p class="mb-0">Permohonan layanan sedang dalam proses verifikasi berkas</p>
			<p class="mb-0"><small class="text-muted">20 Januari 2023 10:00</small></p>
		</div>

		<div class="notif-list">
			<p class="fw-semibold mb-0"><a class="text-dark">Surat Keterangan Keramaian</a></p>
			<p class="mb-0">Permohonan layanan sedang dalam proses verifikasi berkas</p>
			<p class="mb-0"><small class="text-muted">20 Januari 2023 10:00</small></p>
		</div>

	</div>
</div>

<nav class="mt-4">
  	<ul class="pagination justify-content-center ">
	  	<li class="page-item"><a class="page-link" href="#"><i class="ri-arrow-left-s-line"></i></a></li>
	    <li class="page-item active"><a class="page-link" href="#">1</a></li>
	    <li class="page-item"><a class="page-link" href="#">2</a></li>
	    <li class="page-item"><a class="page-link" href="#">3</a></li>
	    <li class="page-item"><a class="page-link" href="#"><i class="ri-arrow-right-s-line"></i></a></li>
  	</ul>
</nav>
@endsection