@extends('layouts.userblank')
@section('title') Buat Permohonan Layanan @endsection

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
		<h4 class="text-dark fw-bold mb-0">Buat Permohonan Layanan</h4>
		<p class="mb-0 text-muted">Surat Keterangan Kelahiran</p>
	</div>
</div>

<div class="card p-2 border-0">
	<div class="card-body">

		<form id="createForm" method="POST">
			<!-- Form 1 -->
			<h3>
                <span class="title_text">Informasi Pemohon</span>
            </h3>
            <fieldset>
                <div class="fieldset-content">
                	<div class="row">
                		<div class="col-md-6 mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nama lengkap" value="Yudi Permana" disabled="disabled">
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Induk Kependudukan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor induk kependudukan" value="3277123456789012" disabled="disabled">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Kartu Keluarga</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor kartu keluarga" value="3277123456789012" disabled="disabled">
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Alamat Lengkap</label>
							<textarea class="form-control" placeholder="Tulis alamat lengkap disini" disabled="disabled">Jl. Raden Demang Hardjakusumah Blok Jati Cihanjuang No.1, Kelurahan Cibabat, Kec. Cimahi Utara, Kota Cimahi</textarea>
						</div>
					</div>
				</div>

				<div class="fieldset-footer">
                    <span>Formulir 1 dari 3</span>
                </div>
			</fieldset>
			<!-- End Form 1 -->

			<!-- Form 2 -->
			<h3>
                <span class="title_text">Informasi Layanan</span>
            </h3>
            <fieldset>
                <div class="fieldset-content">
                	<div class="row">
                		<!-- Info Father -->
                		<div class="col-md-12 mt-4"><h5>Informasi Ayah</h5></div>
                		<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Induk Kependudukan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor induk kependudukan">
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nama lengkap">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Tanggal Lahir</label>
							<div class="input-group">
								<input type="text" name="" class="form-control datepicker" placeholder="dd/mm/yyyy">
								<span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Agama</label>
							<select class="form-control form-select">
								<option value="">- Pilih Agama -</option>
								<option selected>Islam</option>
								<option>Katolik</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Pekerjaan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan pekerjaan">
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Alamat Lengkap</label>
							<textarea class="form-control" placeholder="Tulis alamat lengkap disini"></textarea>
						</div>
						<!-- End Info Father -->

						<!-- Info Mother -->
						<div class="col-md-12 mt-4"><h5>Informasi Ibu</h5></div>
                		<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Induk Kependudukan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor induk kependudukan">
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nama lengkap">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Tanggal Lahir</label>
							<div class="input-group">
								<input type="text" name="" class="form-control datepicker" placeholder="dd/mm/yyyy">
								<span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Agama</label>
							<select class="form-control form-select">
								<option value="">- Pilih Agama -</option>
								<option selected>Islam</option>
								<option>Katolik</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Pekerjaan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan pekerjaan">
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Alamat Lengkap</label>
							<textarea class="form-control" placeholder="Tulis alamat lengkap disini"></textarea>
						</div>
						<!-- End Into Mother -->

						<!-- Info Child -->
						<div class="col-md-12 mt-4"><h5>Informasi Anak</h5></div>
                		<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Induk Kependudukan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor induk kependudukan">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nama lengkap">
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
							<label class="form-label">Agama</label>
							<select class="form-control form-select">
								<option value="">- Pilih Agama -</option>
								<option selected>Islam</option>
								<option>Katolik</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Pekerjaan</label>
							<input type="text" name="" class="form-control" placeholder="Masukan pekerjaan">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Anak Ke-</label>
							<input type="text" name="" class="form-control" placeholder="Masukan tempat lahir">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Jam Lahir</label>
							<div class="input-group">
								<input type="text" name="" class="form-control timepicker" placeholder="--:--">
								<span class="input-group-text" id="basic-addon2"><i class="ri-time-line"></i></span>
							</div>
						</div>
						<!-- End Into Child -->

                		<div class="col-md-12 mt-4"><h5>Informasi Surat Pengantar</h5></div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Nomor Surat</label>
							<input type="text" name="" class="form-control" placeholder="Masukan nomor surat">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Tanggal Surat</label>
							<div class="input-group">
								<input type="text" name="" class="form-control datepicker" placeholder="dd/mm/yyyy">
								<span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Kelurahan</label>
							<select class="form-control form-select" disabled="">
								<option value="">- Pilih Kelurahan -</option>
								<option selected>Leuwigajah</option>
								<option>Perempuan</option>
							</select>
						</div>
						<div class="col-md-3 mb-3">
							<label class="form-label">Rukun Tetangga (RT)</label>
							<input type="text" name="" class="form-control" placeholder="Masukan rukun tetangga" value="1" disabled="disabled">
						</div>
						<div class="col-md-3 mb-3">
							<label class="form-label">Rukun Warga (RW)</label>
							<input type="text" name="" class="form-control" placeholder="Masukan rukun warga" value="2" disabled="disabled">
						</div>
						
					</div>
				</div>

				<div class="fieldset-footer">
                    <span>Formulir 2 dari 3</span>
                </div>
			</fieldset>
			<!-- End Form 2 -->

			<!-- Form 3 -->
			<h3>
                <span class="title_text">Berkas Persyaratan</span>
            </h3>
            <fieldset>
                <div class="fieldset-content">
                	<div class="row">
                		<div class="col-md-12 mt-4"><h5>Unggah Berkas</h5></div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Surat Pengantar RT/RW</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto surat pengantar">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Kartu Keluarga</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Kartu Tanda Penduduk (KTP)/Akta Kematian Ayah</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Kartu Tanda Penduduk (KTP)/Akta Kematian Ibu</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Buku Nikah Hal 1-3/SPTJM</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto SK Kelahiran dari Rumah Sakit/Bidan/Mengisi SPTMJ</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Kartu Tanda Penduduk (KTP) Saksi 1</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Foto Kartu Tanda Penduduk (KTP) Saksi 2</label>
							<input type="file" name="" class="form-control" placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-12 mt-4"><h5>Format Berkas Pendukung</h5></div>
						<p class="text-muted">Format pendukung yang dapat anda unduh</p>
						<p><a href=""><i class="ri-file-download-line text-primary me-2"></i> Unduh SPTJM Menikah</a></p>
						<p><a href=""><i class="ri-file-download-line text-primary me-2"></i> Unduh SPTJM Kelahiran</a></p>
					</div>
				</div>

				<div class="fieldset-footer">
                    <span>Formulir 3 dari 3</span>
                </div>
			</fieldset>
			<!-- End Form 3 -->
		</form>

	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	(function($) {

	    var form = $("#createForm");
	    form.validate({
	        errorPlacement: function errorPlacement(error, element) {
	            element.before(error);
	        },
	        rules: {
	            username: {
	                required: true,
	            }
	        },
	        messages : {
	            email: {
	                email: 'Not a valid email address <i class="zmdi zmdi-info"></i>'
	            }
	        },
	        onfocusout: function(element) {
	            $(element).valid();
	        },
	    });
	    form.steps({
	        headerTag: "h3",
	        bodyTag: "fieldset",
	        transitionEffect: "slideLeft",
	        labels: {
	            previous: 'Sebelumnya',
	            next: 'Selanjutnya',
	            finish: 'Kirim Permohonan',
	            current: ''
	        },
	        titleTemplate: '<div class="title"><span class="number">#index#</span>#title#</div>',
	        onStepChanging: function(event, currentIndex, newIndex) {
	            form.validate().settings.ignore = ":disabled,:hidden";
	            // console.log(form.steps("getCurrentIndex"));
	            return form.valid();
	        },
	        onFinishing: function(event, currentIndex) {
	            form.validate().settings.ignore = ":disabled";
	            console.log(getCurrentIndex);
	            return form.valid();
	        },
	        onFinished: function(event, currentIndex) {
	            alert('Sumited');
	        },
	        // onInit : function (event, currentIndex) {
	        //     event.append('demo');
	        // }
	    });

	})(jQuery);
</script>
@endsection