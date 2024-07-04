@extends('layouts.error')
@section('title') Terjadi Kesalahan @endsection

@section('content')
<div class="container h-100">
	<div class="row h-100 align-items-center">
		<div class="col-12 text-center">
			<div class="d-inline-block bg-light p-5 rounded-circle mb-4">
				<img src="{{ asset('assets/img/lapakami-icon-error.png') }}" height="64px" alt="Icon Error" />
			</div>
			<h1 class="text-dark fw-bold display-1">500</h1>
			<h4>Terjadi Kesalahan</h4>
			<p class="text-muted">Silahkan coba kembali beberapa saat lagi</p>
			@if(\Auth::check())
				<a href="{{ url('user/beranda') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@else
				<a href="{{ url('') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@endif
		</div>
	</div>
</div>
@endsection