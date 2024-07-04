@extends('layouts.user')
@section('title') Pengaturan @endsection

@section('content')
<div class="row mb-4 align-items-center">
	<div class="col-md-12">
		<h4 class="text-dark fw-bold mb-0">Pengaturan</h4>
	</div>
</div>

<div class="card p-2 border-0">
	<div class="card-body">

		<h5 class="text-dark">Ubah Kata Sandi</h5>
		<p>Untuk melakukan perubahan pada kata sandi anda silahkan menggunakan form berikut.</p>

		<form class="row">
			<div class="col-md-6 mb-3">
				<label class="form-label">Kata Sandi Sekarang</label>
				<input type="text" name="" class="form-control" placeholder="Masukan kata sandi">
			</div>
			<div class="col-md-12"></div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Kata Sandi Baru</label>
				<input type="text" name="" class="form-control" placeholder="Masukan kata sandi">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Konfirmasi Kata Sandi</label>
				<input type="text" name="" class="form-control" placeholder="Masukan konfirmasi">
			</div>
			<div class="col-md-12 mt-2">
				<button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
			</div>
		</form>

	</div>
</div>
@endsection