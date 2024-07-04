@extends('layouts.error')
@section('title') Halaman Kadaluarsa @endsection

@section('content')
<div class="container h-100">
	<div class="row h-100 align-items-center">
		<div class="col-12 text-center">
			<div class="d-inline-block bg-light p-5 rounded-circle mb-4">
				<img src="{{ asset('assets/img/lapakami-icon-expired.png') }}" height="64px" alt="Icon Error" />
			</div>
			<h1 class="text-dark fw-bold display-1">419</h1>
			<h4>Halaman Kadaluarsa</h4>
			<p class="text-muted">Halaman telah kadaluarsa, silahkan muat ulang halaman sebelumnya</p>
			@if(\Auth::check())
				<a href="{{ url('user/beranda') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@else
				<a href="{{ url('') }}" class="btn btn-primary px-3 rounded-pill mt-4">Halaman Beranda</a>
			@endif
		</div>
	</div>
</div>
@endsection