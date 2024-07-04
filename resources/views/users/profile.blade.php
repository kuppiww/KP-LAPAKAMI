@extends('layouts.user')
@section('title') Profil @endsection

@section('content')
<div class="row mb-4 align-items-center">
	<div class="col-md-12">
		<h4 class="text-dark fw-bold mb-0 align-items-center d-flex">
			<span>Profil</span>
			<!-- <p class="mb-0 d-inline-block ms-2">
				<span class="badge bg-success rounded-pill px-3"><i class="ri-check-line me-2"></i> Sudah Lengkap</span>
			</p> -->
			<p class="mb-0 d-inline-block ms-2">
				<span class="badge bg-warning rounded-pill px-3"><i class="ri-information-line me-2"></i> Belum Lengkap</span>
			</p>
		</h4>
		
	</div>
</div>

<div class="card p-2 border-0">
	<div class="card-body">

		<form class="row">
			<div class="col-md-12"><h5>Informasi Akun</h5></div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Nama Lengkap</label>
				<input type="text" name="" class="form-control" placeholder="Masukan nama lengkap" value="Yudi Permana">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Email</label>
				<div class="input-group">
					<input type="text" name="" class="form-control" placeholder="Masukan email" value="yudi@cimahikota.go.id">
					<span class="input-group-text" id="basic-addon2">
						<!-- Verified -->
						<i class="ri-checkbox-circle-fill text-success"></i>
						<!-- UnVerified -->
						<!-- <i class="ri-error-warning-fill text-warning"></i> -->
					</span>
				</div>
			</div>
			<div class="col-md-12 mt-4"><h5>Informasi Pribadi</h5></div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Nomor Induk Kependudukan</label>
				<input type="text" name="" class="form-control" placeholder="Masukan nomor induk kependudukan" value="3277123456789012" disabled="disabled">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Nomor Kartu Keluarga</label>
				<input type="text" name="" class="form-control" placeholder="Masukan nomor kartu keluarga" value="3277123456789012" disabled="disabled">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Tempat Lahir</label>
				<input type="text" name="" class="form-control" placeholder="Masukan tempat lahir">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Tanggal Lahir</label>
				<div class="input-group">
					<input type="text" name="" class="form-control datepicker" placeholder="dd/mm/yyyy">
					<span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
				</div>
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Jenis Kelamin</label>
				<select class="form-control form-select">
					<option value="">- Pilih Jenis Kelamin -</option>
					<option>Laki-laki</option>
					<option>Perempuan</option>
				</select>
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Agama</label>
				<select class="form-control form-select">
					<option value="">- Pilih Agama -</option>
					<option>Islam</option>
					<option>Katolik</option>
				</select>
			</div>
			<div class="col-md-12 mt-4"><h5>Informasi Alamat</h5></div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Kelurahan</label>
				<select class="form-control form-select">
					<option value="">- Pilih Kelurahan -</option>
					<optgroup label="Kecamatan Cimahi Utara">
						<option value="">Cibabat</option>
					</optgroup>
					<optgroup label="Kecamatan Cimahi Tengah">
						<option value="">Cimahi</option>
					</optgroup>
					<optgroup label="Kecamatan Cimahi Selatan">
						<option value="">Leuwigajah</option>
					</optgroup>
				</select>
			</div>
			<div class="col-md-3 mb-3">
				<label class="form-label">Rukun Tetangga (RT)</label>
				<input type="text" name="" class="form-control" placeholder="Masukan rukun tetangga">
			</div>
			<div class="col-md-3 mb-3">
				<label class="form-label">Rukun Warga (RW)</label>
				<input type="text" name="" class="form-control" placeholder="Masukan rukun warga">
			</div>
			<div class="col-md-12 mb-3">
				<label class="form-label">Alamat Lengkap</label>
				<textarea class="form-control" placeholder="Tulis alamat lengkap disini"></textarea>
			</div>
			<div class="col-md-12 mt-2">
				<button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
			</div>
		</form>

	</div>
</div>
@endsection