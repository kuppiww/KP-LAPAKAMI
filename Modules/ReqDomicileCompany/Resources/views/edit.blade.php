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
            <p class="mb-0 text-muted">Surat Keterangan Domisili Perusahaan</p>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form id="createForm" method="POST"
                action="/user/layanan/domisili-perusahaan/update/{{ $request->request_id }}" enctype="multipart/form-data">
                @csrf
                <!-- Form 1 -->
                <h3>
                    <span class="title_text">Informasi Pemohon</span>
                </h3>
                <fieldset>
                    <div class="fieldset-content">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" name="nik" class="form-control"
                                    placeholder="Masukan nomor induk kependudukan" value="{{ $request->nik }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Kartu Keluarga</label>
                                <input type="text" name="no_kk" class="form-control"
                                    placeholder="Masukan nomor kartu keluarga" value="{{ $request->no_kk }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_warga" class="form-control"
                                    placeholder="Masukan nama lengkap" value="{{ $request->nama_warga }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-control form-select" disabled="disabled" name="id_jenkel">
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
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Masukan tempat lahir"
                                    value="{{ $request->tmp_lahir }}" readonly name="tmp_lahir">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy"
                                        value="{{ DateFormatHelper::dateNum($request->tgl_lahir) }}" readonly>
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
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
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" class="form-control" readonly
                                        placeholder="Masukan kewarganegaraan"
                                        value="{{ $request_detail->kewarganegaraan }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="{{ $request->pekerjaan }}" readonly placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" placeholder="Tulis alamat lengkap disini" readonly>{{ $request->user_alamat }}</textarea>
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
                            <!-- <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Masa Berlaku<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="masa_berlaku"
                                        value="{{ $request_detail->masa_berlaku }}" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div> -->

                            <div class="col-md-12 mt-4 ">
                                <h5>Informasi Perusahaan</h5>
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Nama Perusahaan<span class="text-danger">*</span></label>
                                <input type="text" name="nama_perusahaan" value="{{ $request_detail->nama_perusahaan }}"
                                    class="form-control" placeholder="Masukan nama perusahaan">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jenis Usaha<span class="text-danger">*</span></label>
                                <input type="text" name="jenis_usaha" value="{{ $request_detail->jenis_usaha }}"
                                    class="form-control" placeholder="Masukan jenis usaha">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Notaris<span class="text-danger">*</span></label>
                                <input type="text" name="notaris" value="{{ $request_detail->notaris }}"
                                    class="form-control" placeholder="Masukan notaris">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">No. Akta Notaris<span class="text-danger">*</span></label>
                                <input type="text" name="no_akta_notaris" value="{{ $request_detail->no_akta_notaris }}"
                                    class="form-control" placeholder="Masukan nomor akta notaris">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Akta Notaris<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_akta_notaris"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_akta_notaris) }}"
                                        class="form-control datepicker" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jumlah Karyawan<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="jml_karyawan"
                                        value="{{ $request_detail->jml_karyawan }}" class="form-control"
                                        placeholder="Masukan jumlah karyawan">
                                    <span class="input-group-text" id="basic-addon2"><small>Orang</small></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jam Kerja<span class="text-danger">*</span></label>
                                <input type="text" name="jam_kerja" value="{{ $request_detail->jam_kerja }}"
                                    class="form-control" placeholder="Masukan jam kerja">
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Alamat Usaha<span class="text-danger">*</span></label>
                                <textarea class="form-control" placeholder="Tulis alamat usaha disini" name="alamat">{{ $request_detail->alamat }}</textarea>
                            </div>

                            <div class="col-md-12 mt-4">
                                <h5>Informasi Lainnya</h5>
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Keperluan<span class="text-danger">*</span></label>
                                <input type="text" name="keperluan" value="{{ $request_detail->keperluan }}"
                                    class="form-control" placeholder="Masukan keperluan">
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
                                <label class="form-label">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP')
                                            <a href="/storage/files/request_company/ktp/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp" class="form-control" placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Akta Pendirian Perusahaan/Akta Notaris Perusahaan/SK-KEMENKUMHAM<span
                                        class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_PENDIRIAN')
                                            <a href="/storage/files/request_company/pendirian/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_pendirian" class="form-control"
                                    placeholder="Masukan akta pendirian perusahaan">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 5MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Surat Pengantar RT/RW<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                            <a href="/storage/files/request_company/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_p_rt_rw" class="form-control"
                                    placeholder="Masukan surat pengantar">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Sewa Penyewa/Bukti Kepemilikan Tempat<span
                                        class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_SEWA_KEPEMILIKAN')
                                            <a href="/storage/files/request_company/sewa_kepemilkan/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_sewa_kepemilikan" class="form-control"
                                    placeholder="Masukan bukti sewa">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Surat Keterangan Tidak Keberatan Tanah/Rumah Dipakai Usaha
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_DENAH')
                                            <a href="/storage/files/request_company/keterangan_rumah/{{ $request_doc->request_attachment_file }}"
                                                target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_keterangan_rumah" class="form-control"
                                    placeholder="Masukan surat keterangan tidak keberatan">
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
                    // masa_berlaku: "required",
                    nama_perusahaan: "required",
                    jenis_usaha: "required",
                    notaris: "required",
                    tgl_akta_notaris: "required",
                    no_akta_notaris: "required",
                    jam_kerja: "required",
                    jml_karyawan: {
                        required: true,
                        number: true
                    },
                    alamat: "required",
                    no_surat_pengantar: "required",
                    tgl_surat_pengantar: "required",
                    f_agreement : "required",
                    keperluan: "required",
                    f_ktp: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_pendirian: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 5120000
                    },
                    f_p_rt_rw: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_sewa_kepemilikan: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_keterangan_rumah: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    }
                },
                messages: {
                    // masa_berlaku: "Masa berlaku tidak boleh kosong",
                    nama_perusahaan: "Nama organisasi tidak boleh kosong",
                    jenis_usaha: "Jenis usaha tidak boleh kosong",
                    notaris: "Notaris tidak boleh kosong",
                    tgl_akta_notaris: "Tanggal notaris tidak boleh kosong",
                    no_akta_notaris: "No akta notaris usaha tidak boleh kosong",
                    jam_kerja: "Jam kerja tidak boleh kosong",
                    jml_karyawan: {
                        required: "Jumlah anggota tidak boleh kosong",
                        number: "Harus berisi angka"
                    },
                    alamat: "Alamat tidak boleh kosong",
                    keperluan: "Keperluan tidak boleh kosong",
                    no_surat_pengantar: "No surat pengantar RT RW tidak boleh kosong",
                    tgl_surat_pengantar: "Tanggal surat pengantar RT RW tidak boleh kosong",
                    f_agreement : "Agreement harap di ceklis",
                    f_ktp: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_pendirian: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 5MB"
                    },
                    f_p_rt_rw: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_sewa_kepemilikan: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_keterangan_rumah: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    }
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
