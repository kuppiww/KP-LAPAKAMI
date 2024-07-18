@extends('layouts.userblank')
@section('title')
    Buat Permohonan Layanan
@endsection

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
            <p class="mb-0 text-muted">Surat Keterangan Keramaian</p>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form id="createForm" method="POST" action="/user/layanan/izin-keramaian/update/{{ $request->request_id }}"
                enctype="multipart/form-data">
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
                                    placeholder="Masukan nomor induk kependudukan" value="{{ $request->nik }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Kartu Keluarga<span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" class="form-control"
                                    placeholder="Masukan nomor kartu keluarga" value="{{ $request->no_kk }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" name="nama_warga" class="form-control"
                                    placeholder="Masukan nama lengkap" value="{{ $request->nama_warga }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="id_jenkel" disabled>
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    @if (sizeof($genders) > 0)
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id_gender }}"
                                                {{ $request->id_jenkel == $gender->id_gender ? 'selected' : '' }}>
                                                {{ $gender->gender }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" placeholder="Masukan tempat lahir"
                                    value="{{ $request->tmp_lahir }}" disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy"
                                        value="{{ isset($request->tgl_lahir) ? DateFormatHelper::dateNum($request->tgl_lahir) : '' }}"
                                        readonly>
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
                                                {{ $request->id_agama == $religion->id_religion ? 'selected' : '' }}>
                                                {{ $religion->religion }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="{{ $request->pekerjaan }}" placeholder="Masukan pekerjaan"
                                        disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
                                    <textarea class="form-control" placeholder="Tulis alamat lengkap disini" disabled="disabled">{{ $request->user_alamat }}</textarea>
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
                        <div class="row align-items-center">
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Surat Pengantar</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <div class="form-group">
                                    <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                                    <input type="text" name="no_surat_pengantar" class="form-control"
                                        value="{{ $request->no_surat_pengantar }}" placeholder="Masukan nomor surat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="tgl_surat_pengantar" class="form-control datepicker"
                                            value="{{ DateFormatHelper::dateNum($request->tgl_surat_pengantar) }}"
                                            placeholder="dd/mm/yyyy">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="ri-calendar-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Kelurahan</label>
                                    <select class="form-control form-select" name="kd_kel" disabled="disabled">
                                        <option value="kd_kel">- Pilih Kelurahan -</option>
                                        @if (sizeof($sub_districts) > 0)
                                            @foreach ($sub_districts as $sub_district)
                                                <option value="{{ $sub_district->kd_sub_district }}"
                                                    {{ $request->kd_kel == $sub_district->kd_sub_district ? 'selected' : '' }}>
                                                    {{ $sub_district->sub_district }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Rukun Tetangga (RT)</label>
                                    <input type="text" name="rt" class="form-control"
                                        placeholder="Masukan rukun tetangga" value="{{ $request->rt }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">

                                    <label class="form-label">Rukun Warga (RW)</label>
                                    <input type="text" name="rw" class="form-control"
                                        placeholder="Masukan rukun warga" value="{{ $request->rw }}" readonly>
                                </div>
                            </div>

                            <!-- Activity -->
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Kegiatan</h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Kegiatan<span class="text-danger">*</span></label>
                                    <input type="text" name="kegiatan" class="form-control"
                                        value="{{ $request_detail->kegiatan }}" placeholder="Masukan nama kegiatan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Kegiatan<span class="text-danger">*</span></label>
                                <div class="form-check form-switch d-inline-block ms-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="swithmoreday">
                                    <label class="form-check-label" for="swithmoreday">
                                        <p class="mb-0"><small>Lebih dari 1 hari</small></p>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="tgl_kegiatan"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_kegiatan) }}"
                                        class="form-control datepicker_activity" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 d-none form-group" id="moreday">
                                <label class="form-label">Tanggal Akhir Kegiatan<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_kegiatan_akhir"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_kegiatan_akhir) }}"
                                        class="form-control datepicker_activity" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 from-group">
                                <label class="form-label">Waktu Kegiatan<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="waktu" class="form-control timepicker"
                                        value="{{ $request_detail->waktu }}" placeholder="--:--">
                                    <span class="input-group-text">s/d</span>
                                    <input type="text" name="waktu_akhir" class="form-control timepicker"
                                        value="{{ $request_detail->waktu_akhir }}" placeholder="--:--">
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                            <!-- End Activity -->

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
                                <label class="form-label">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP')
                                            <a href="/storage/files/request_crowd/ktp/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Keluarga<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KK')
                                            <a href="/storage/files/request_crowd/kk/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_kk" class="form-control"
                                    placeholder="Masukan Kartu Keluarga">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Surat Pengantar RT/RW<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                            <a href="/storage/files/request_crowd/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_p_rt_rw" class="form-control"
                                    placeholder="Masukan foto surat pengantar">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Surat Pemberitahuan Tetangga
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_PEMBERITAHUAN_TETANGGA')
                                            <a href="/storage/files/request_crowd/pemberitahuan_tetangga/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_pemberitahuan_tetangga" class="form-control"
                                    placeholder="Masukan foto surat pengantar">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Proposal Kegiatan
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_PROPOSAL')
                                            <a href="/storage/files/request_crowd/proposal/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_proposal" class="form-control"
                                    placeholder="Masukan foto surat pengantar">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Surat Keterangan Panitia
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_PANITIA')
                                            <a href="/storage/files/request_crowd/panitia/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_panitia" class="form-control"
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
                            @if (sizeof($attach_samples) > 0)
                                <div class="col-md-12 mt-4">
                                    <h5>Format Berkas Pendukung</h5>
                                </div>
                                <p class="text-muted">Format pendukung yang dapat anda unduh</p>

                                @foreach ($attach_samples as $sample)
                                    <p>
                                        <a href="{{ url('storage/files/service/' . $sample->example_file) }}" download>
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
                    kegiatan: "required",
                    tgl_kegiatan: "required",
                    tgl_kegiatan_akhir: "required",
                    waktu: "required",
                    waktu_akhir: "required",
                    no_surat_pengantar: "required",
                    tgl_surat_pengantar: "required",
                    f_agreement : "required",
                    f_ktp: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_kk: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_p_rt_rw: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_pemberitahuan_tetangga: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_proposal: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_panitia: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },

                },
                messages: {
                    kegiatan: "Nama kegiatan tidak boleh kosong",
                    tgl_kegiatan: "Tanggal kegiatan tidak boleh kosong",
                    tgl_kegiatan_akhir: "Tanggal akhir kegiatan tidak boleh kosong",
                    waktu: "Waktu kegiatan tidak boleh kosong",
                    waktu_akhir: "Waktu akhir kegiatan tidak boleh kosong",
                    no_surat_pengantar: "No surat pengantar RT RW tidak boleh kosong",
                    tgl_surat_pengantar: "Tanggal surat pengantar RT RW tidak boleh kosong",
                    f_agreement : "Agreement harap di ceklis",
                    f_ktp: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_kk: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_p_rt_rw: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_pemberitahuan_tetangga: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_proposal: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_panitia: {
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
                    } else {
                        $(this).validate().settings.ignore = ".ignore-validation";
                        return true;
                    }
                },
                onFinishing: function(event, currentIndex) {
                    form.validate().settings.ignore = ":disabled,:hidden";
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

            // Change Purpose
            $(document).ready(function() {
                var req_awal = {{ $request_detail->tgl_kegiatan }};
                var req_akhir = {{ $request_detail->tgl_kegiatan_akhir }};

                if (req_awal != req_akhir) {
                    $('#moreday').removeClass('d-none');
                    $('#swithmoreday').prop('checked', true);
                } else {
                    $('#moreday').addClass('d-none');
                    $('#swithmoreday').prop('checked', false);
                }

                $('#swithmoreday').change(function() {
                    if ($(this).is(':checked')) {

                        $('#moreday').removeClass('d-none');
                    } else {
                        $('#moreday').addClass('d-none');
                    }
                });

            });

            $('.datepicker_activity').datepicker({
                format: 'dd/mm/yyyy',
                uiLibrary: 'bootstrap5',
                startDate: '01/01/1945',
                // endDate: '0d'
            });

        })(jQuery);
    </script>
@endsection
