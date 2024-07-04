@extends('layouts.error')
@section('title') Halaman Tidak Ditemukan @endsection

@section('content')
<div class="container h-100">
	<div class="row h-100 align-items-center">
		<div class="col-12 text-center">
			<div class="d-inline-block bg-light p-5 rounded-circle mb-4">
				<img src="{{ asset('assets/img/lapakami-icon-alert.png') }}" height="64px" alt="Icon Error" />
			</div>
			<h1 class="text-dark fw-bold display-1">404</h1>
			<h4>Halaman Tidak Ditemukan</h4>
			<p class="text-muted">Halaman yang anda cari tidak tersedia, silahkan kembali ke halaman awal</p>
			@if(\Auth::check())
				<a href="{{ url('user/beranda') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@else
				<a href="{{ url('') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@endif
		</div>
	</div>
</div>
@endsection