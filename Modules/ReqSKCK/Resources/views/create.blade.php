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
		<p class="mb-0 text-muted">Surat Pengantar Keterangan Catatan Kepolisian</p>
	</div>
</div>

<div class="card p-2 border-0">
	<div class="card-body">

		<form id="createForm" method="POST" action="/user/layanan/skck/buat" enctype="multipart/form-data">
			@csrf
			<!-- Form 1 -->
			<h3>
                <span class="title_text">Informasi Pemohon</span>
            </h3>
            <fieldset>
                <div class="fieldset-content">
                	<div class="row">
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
							<input type="text" name="nik" class="form-control"
								placeholder="Masukan nomor induk kependudukan" value="{{ $user->user_nik }}"
								disabled="disabled">
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Nomor Kartu Keluarga<span class="text-danger">*</span></label>
							<input type="text" name="no_kk" class="form-control"
								placeholder="Masukan nomor kartu keluarga" value="{{ $user->user_kk }}"
								disabled="disabled">
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
							<input type="text" name="nama_warga" class="form-control"
								placeholder="Masukan nama lengkap" value="{{ $user->user_nama }}" disabled="disabled">
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
							<select class="form-control form-select" disabled="disabled" name="id_jenkel">
								<option value="">- Pilih Jenis Kelamin -</option>
								@if (sizeof($genders) > 0)
									@foreach ($genders as $gender)
										<option value="{{ $gender->id_gender }}"
											{{ $user->user_id_jenkel == $gender->id_gender ? 'selected' : '' }}>
											{{ $gender->gender }}</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Masukan tempat lahir"
								value="{{ $user->user_tmp_lahir }}" disabled="disabled" name="tmp_lahir">
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="text" name="tgl_lahir" class="form-control datepicker"
									placeholder="dd/mm/yyyy" value="{{ isset($user->user_tgl_lahir) ? DateFormatHelper::dateNum($user->user_tgl_lahir) : '' }}" readonly>
								<span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
							</div>
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Agama<span class="text-danger">*</span></label>
							<select class="form-control form-select" name="id_agama" disabled="disabled">
								<option value="">- Pilih Agama -</option>
								@if (sizeof($religions) > 0)
									@foreach ($religions as $religion)
										<option value="{{ $religion->id_religion }}"
											{{ $user->user_id_agama == $religion->id_religion ? 'selected' : '' }}>
											{{ $religion->religion }}</option>
									@endforeach
								@endif
							</select>
						</div>
						
						<div class="col-md-6 mb-3 form-group">
							<div class="form-group">
								<label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
								<input type="text" name="pekerjaan" class="form-control" value="{{ $user->user_pekerjaan }}"
									placeholder="Masukan pekerjaan" disabled="disabled">
							</div>
						</div>
						<div class="col-md-12 mb-3 form-group">
							<div class="form-group">
								<label class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
								<textarea class="form-control" placeholder="Tulis alamat lengkap disini" disabled="disabled">{{ $user->user_alamat }}</textarea>
							</div>
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
                		<div class="col-md-12 mt-4"><h5>Informasi Surat Pengantar</h5></div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label class="form-label">Nomor Surat<span class="text-danger">*</span></label>
								<input type="text" name="no_surat_pengantar" class="form-control"
									placeholder="Masukan nomor surat">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label class="form-label">Tanggal Surat<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="text" name="tgl_surat_pengantar" class="form-control datepicker"
										placeholder="dd/mm/yyyy">
									<span class="input-group-text" id="basic-addon2"><i
											class="ri-calendar-line"></i></span>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label class="form-label">Kelurahan<span class="text-danger">*</span></label>
								<select class="form-control form-select" name="kd_kel" disabled="disabled">
									<option value="kd_kel">- Pilih Kelurahan -</option>
									@if (sizeof($sub_districts) > 0)
										@foreach ($sub_districts as $sub_district)
											<option value="{{ $sub_district->kd_sub_district }}"
												{{ $user->kd_kel == $sub_district->kd_sub_district ? 'selected' : '' }}>
												{{ $sub_district->sub_district }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-label">Rukun Tetangga (RT)<span class="text-danger">*</span></label>
								<input type="text" name="rt" class="form-control"
									placeholder="Masukan rukun tetangga" value="{{ $user->user_rt }}"
									readonly>
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-label">Rukun Warga (RW)<span class="text-danger">*</span></label>
								<input type="text" name="rw" class="form-control"
									placeholder="Masukan rukun warga" value="{{ $user->user_rw }}"
									readonly>
							</div>
						</div>
						<div class="col-md-12 mt-4"><h5>Informasi Lainnya</h5></div>
						<div class="col-md-12 mb-3 form-group">
							<label class="form-label">Keperluan<span class="text-danger">*</span></label>
							<input type="text" name="keperluan" class="form-control" placeholder="Masukan keperluan">
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
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span></label>
							<input type="file" name="f_ktp" class="form-control"
								placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Kartu Keluarga<span class="text-danger">*</span></label>
							<input type="file" name="f_kk" class="form-control"
								placeholder="Masukan foto KTP">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-6 mb-3 form-group">
							<label class="form-label">Surat Pengantar RT/RW<span class="text-danger">*</span></label>
							<input type="file" name="f_p_rt_rw" class="form-control"
								placeholder="Masukan foto surat pengantar">
							<small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
						</div>
						<div class="col-md-12 form-check" style="padding-left: 0.8em;">
							<div class="alert alert-success ck-form" role="alert" style="background-color: #fff;border-color: #dee2e6;--bs-alert-padding-x: 1.7rem;">
								<input type="checkbox" name="f_agreement" class="form-check-input" >
								<label class="form-check-label">
									Saya menerima segala isi <a href="{{ url('kebijakan-privasi') }}" target="blank" >Kebijakan Privasi</a> dan {{env('REDAKSI_AGREEMENT')}}
								</label>
							</div>
						</div>

						<!-- Sample Attachment -->
                            @if(sizeof($attach_samples) > 0)
                                <div class="col-md-12 mt-4">
                                    <h5>Format Berkas Pendukung</h5>
                                </div>
                                <p class="text-muted">Format pendukung yang dapat anda unduh</p>

                                @foreach($attach_samples as $sample)
                                    <p>
                                        <a href="{{ url('storage/files/service/'. $sample->example_file) }}" download>
                                            <i class="ri-file-download-line text-primary me-2"></i> 
                                            Unduh {{ $sample->service_requirement_name }}
                                        </a>
                                    </p>
                                @endforeach
                            @endif
                            <!-- End Sample Attachment -->
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
                rules: {
                    keperluan: "required",
					no_surat_pengantar : "required",
					tgl_surat_pengantar : "required",
					f_agreement : "required",
					f_ktp: {
						required: true,
						extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
					},
					f_kk :{
						required: true,
						extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
					},
					f_p_rt_rw:{
						required: true,
						extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
					},
                },
                messages: {
                    keperluan: "Keperluan tidak boleh kosong",				
					no_surat_pengantar : "No surat pengantar RT RW tidak boleh kosong",
					tgl_surat_pengantar : "Tanggal surat pengantar RT RW tidak boleh kosong",
					f_agreement : "Agreement harap di ceklis",
					f_ktp: {
						required: "KTP tidak boleh kosong",
						extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
					},
					f_kk :{
						required: "KK tidak boleh kosong",
						extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
					},
					f_p_rt_rw:{
						required: "Surat RT RW tidak boleh kosong",
						extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
					},
                },
                errorElement: "em",
                errorClass: "invalid-feedback",
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parents('.form-group').append(error);
					$(element).parents('.ck-form').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
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
                    // return form.valid();

                    if (currentIndex < newIndex) {
                        return form.valid();
                    }
                    else {
                        $(this).validate().settings.ignore = ".ignore-validation";
                        return true;
                    }
                },
                onFinishing: function(event, currentIndex) {
                    form.validate().settings.ignore = ":disabled";
                    // console.log(getCurrentIndex);
                    return form.valid();
                },
                onFinished: function(event, currentIndex) {
                    // alert('Sumited');
					var labelText = $('#createForm').find('a[href="#finish"]').text();
                    $('#createForm').find('a[href="#previous"]').remove();
                    $('#createForm').find('a[href="#finish"]').text( labelText.replace("Kirim Permohonan", "Loading...") );
                    $('#createForm').find('a[href="#finish"]').css("pointer-events", "none" );
                    $('#createForm').find('a[href="#finish"]').css("background", "#e5e5e5" );
                    $('#createForm').find('a[href="#finish"]').attr( 'href', '#' );
                    $("#createForm").submit();
                },
                // onInit : function (event, currentIndex) {
                //     event.append('demo');
                // }
            });

        })(jQuery);
    </script>
@endsection