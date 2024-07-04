@extends('layouts.userblank')
@section('title')
    Buat Permohonan Layanan
@endsection
<?php use App\Helpers\DateFormatHelper; ?>

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
            <p class="mb-0 text-muted">Surat Keterangan Kematian</p>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form id="createForm" method="POST" action="/user/layanan/kematian/buat" enctype="multipart/form-data">
                @csrf
                <!-- Form 1 -->
                <h3>
                    <span class="title_text">Informasi Pemohon</span>
                </h3>
                <fieldset>
                    <div class="fieldset-content">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" placeholder="Masukan nama lengkap"
                                    value="{{ $user->user_nama }}" disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="id_jenkel" disabled>
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
                            <div class="col-md-12"></div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control"
                                    placeholder="Masukan nomor induk kependudukan" value="{{ $user->user_nik }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Kartu Keluarga<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control"
                                    placeholder="Masukan nomor kartu keluarga" value="{{ $user->user_kk }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" placeholder="Masukan tempat lahir"
                                    value="{{ $user->user_tmp_lahir }}" disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy"
                                        value="{{ isset($user->user_tgl_lahir) ? DateFormatHelper::dateNum($user->user_tgl_lahir) : '' }}"
                                        disabled="disabled">
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Agama<span class="text-danger">*</span></label>
                                <select class="form-control form-select" disabled name="id_agama">
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control"
                                    value="{{ $user->user_pekerjaan }}" placeholder="Masukan pekerjaan" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
                                <textarea class="form-control" placeholder="Tulis alamat lengkap disini" readonly>{{ $user->user_alamat }}</textarea>
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
                                <h5>Informasi Surat Pengantar RT RW</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Surat<span class="text-danger">*</span></label>
                                <input type="text" name="no_surat_pengantar" class="form-control"
                                    placeholder="Masukan nomor surat">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Surat<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_surat_pengantar" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kelurahan<span class="text-danger">*</span></label>
                                <select name="kd_kel" class="form-control form-select" disabled>
                                    <option value="">- Pilih Kelurahan -</option>
                                    @if (sizeof($sub_districts) > 0)
                                        @foreach ($sub_districts as $sub_district)
                                            <option value="{{ $sub_district->kd_sub_district }}"
                                                {{ $user->kd_kel == $sub_district->kd_sub_district ? 'selected' : '' }}>
                                                {{ $sub_district->sub_district }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 mb-3 form-group">
                                <label class="form-label">Rukun Tetangga (RT)<span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control"
                                    placeholder="Masukan rukun tetangga" value="{{ $user->user_rt }}" readonly>
                            </div>
                            <div class="col-md-3 mb-3 form-group">
                                <label class="form-label">Rukun Warga (RW)<span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control"
                                    placeholder="Masukan rukun warga" value="{{ $user->user_rw }}" readonly>
                            </div>

                            <div class="col-md-12 mt-4">
                                <h5>Informasi Meninggal</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">NIK Warga Meninggal<span class="text-danger">*</span></label>
                                    <input type="text" name="nik_warga_meninggal" class="form-control"
                                        placeholder="Masukan NIK">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nama Warga Meninggal<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_warga_meninggal" class="form-control"
                                        placeholder="Masukan Nama">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tempat Lahir Warga Meninggal<span class="text-danger">*</span></label>
                                    <input type="text" name="tmp_lahir_warga_meninggal" class="form-control"
                                        placeholder="Masukan Tempat">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Lahir Warga Meninggal<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir_warga_meninggal" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="jk_warga_meninggal">
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    @if (sizeof($genders) > 0)
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id_gender }}">
                                                {{ $gender->gender }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Agama<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="id_agama_warga_meninggal">
                                    <option value="">- Pilih Agama -</option>
                                    @if (sizeof($religions) > 0)
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id_religion }}">
                                                {{ $religion->religion }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Pekerjaan Warga Meninggal<span class="text-danger">*</span></label>
                                    <input type="text" name="pekerjaan_warga_meninggal" class="form-control"
                                        placeholder="Masukan Pekerjaan">
                            </div>
                            <div class="col-md-12 mb-12 form-group">
                                <label class="form-label">Alamat Warga Meninggal<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat_warga_meninggal" class="form-control"
                                        placeholder="Masukan Alamat">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <div class="form-group">
                                    <label class="form-label">Status Perkawinan<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="id_status_kawin">
                                        <option value="">- Pilih Status -</option>
                                        @if (sizeof($merried_stats) > 0)
                                            @foreach ($merried_stats as $merried_stat)
                                                <option value="{{ $merried_stat->id_merried_status }}">
                                                    {{ $merried_stat->merried_status }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Meninggal<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_kematian" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 form-group">
                                <label class="form-label">Jam Meninggal<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="jam_kematian" class="form-control timepicker"
                                        placeholder="--:--">
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Lokasi Meninggal<span class="text-danger">*</span></label>
                                <input type="text" name="lokasi_kematian" class="form-control"
                                    placeholder="Masukan lokasi">
                            </div>
                            <div class="col-md-3 mb-3 form-group">
                                <label class="form-label">Usia Saat Meninggal<span class="text-danger">*</span></label>
                                <input type="text" name="usia_kematian" class="form-control"
                                    placeholder="Masukan usia">
                            </div>
                            
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Penyebab Meninggal<span class="text-danger">*</span></label>
                                <input type="text" name="penyebab_kematian" class="form-control"
                                    placeholder="Masukan penyebab">
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Keperluan<span class="text-danger">*</span></label>
                                <input type="text" name="keperluan" class="form-control"
                                    placeholder="Masukan keperluan">
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
                                <label class="form-label">Surat Pengantar RT/RW<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_p_rt_rw" class="form-control"
                                    placeholder="Masukan surat pengantar">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Tanda Penduduk (KTP) Yang Meninggal<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_ktp_meninggal" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Keluarga (KK) Yang Meninggal<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_kk_meninggal" class="form-control"
                                    placeholder="Masukan KK">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Tanda Penduduk (KTP) Pelapor<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_ktp" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Tanda Penduduk (KTP) Saksi 1<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_ktp_saksi_1" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kartu Tanda Penduduk (KTP) Saksi 2<span
                                        class="text-danger">*</span></label>
                                <input type="file" name="f_ktp_saksi_2" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Buku Nikah Hal 1-3 (jika sudah menikah)</label>
                                <input type="file" name="f_buku_nikah" class="form-control"
                                    placeholder="Masukan buku menikah">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">SPTJM kematian/ surat keterangan kematian dari rumah sakit<span
                                    class="text-danger">*</span></label>
                                <input type="file" name="f_sptjm_kematian" class="form-control"
                                    placeholder="Masukan sptjm kematian / surat keterangan kematian dari rumah sakit">
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
                    no_surat_pengantar: "required",
                    tgl_surat_pengantar: "required",
                    f_agreement : "required",
                    tgl_kematian: "required",
                    jam_kematian: "required",
                    nik_warga_meninggal: {
                        required: true,
                        number : true,
                        minlength: 16,
                        maxlength: 16
                    },
                    nama_warga_meninggal: "required",
                    tmp_lahir_warga_meninggal: "required",
                    tgl_lahir_warga_meninggal: "required",
                    jk_warga_meninggal: "required",
                    id_agama_warga_meninggal: "required",
                    pekerjaan_warga_meninggal: "required",
                    alamat_warga_meninggal: "required",
                    lokasi_kematian: "required",
                    usia_kematian: {
                        required: true,
                        number: true
                    },
                    penyebab_kematian: "required",
                    keperluan: "required",
                    f_p_rt_rw: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_meninggal: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_kk_meninggal: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_saksi_1: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_saksi_2: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_buku_nikah: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_sptjm_kematian: {
                        required: true,
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    }
                },
                messages: {
                    tgl_kematian: "tanggal kematian tidak boleh kosong",
                    jam_kematian: "Jam kematian tidak boleh kosong",
                    lokasi_kematian: "Lokasi kematian tidak boleh kosong",
                    nama_warga_meninggal: "Nama warga tidak boleh kosong",
                    nik_warga_meninggal: {
                        number : 'NIK hanya boleh berisi angka',
                        required: "NIK tidak boleh kosong",
                        minlength: "NIK minimal harus 16 karakter",
                        maxlength: "NIK maksimal harus 16 karakter"
                    },
                    tmp_lahir_warga_meninggal: "Tempat lahir warga tidak boleh kosongired",
                    tgl_lahir_warga_meninggal: "Tanggal lahir warga tidak boleh kosong",
                    jk_warga_meninggal: "Jenis kelamin warga tidak boleh kosong",
                    id_agama_warga_meninggal: "Agama warga tidak boleh kosong",
                    pekerjaan_warga_meninggal: "Pekerjaan warga tidak boleh kosong",
                    alamat_warga_meninggal: "alamat warga tidak boleh kosong",
                    usia_kematian: {
                        required: "Usia kematian tidak boleh kosong",
                        number: "harus berisi angka"
                    },
                    penyebab_kematian: "Penybab kematian tidak boleh kosong",
                    keperluan: "Keperluan tidak boleh kosong",
                    no_surat_pengantar: "No surat pengantar tidak boleh kosong",
                    tgl_surat_pengantar: "Tanggal surat pengantar tidak boleh kosong",
                    f_agreement : "Agreement harap di ceklis",
                    f_p_rt_rw: {
                        required: "Surat keterangan RT RW tidak boleh kosong",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_meninggal: {
                        required: "KTP meninggal tidak boleh kososng",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_kk_meninggal: {
                        required: "KK meninggal tidak boleh kososng",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp: {
                        required: "KTP pemohon tidak boleh kososng",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_saksi_1: {
                        required: "KTP saksi tidak boleh kososng",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_saksi_2: {
                        required: "KTP saksi tidak boleh kosong",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_buku_nikah: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_sptjm_kematian: {
                        required: "SPTJM Kematian tidak boleh kosong",
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    }
                },
                errorElement: "em",
                errorClass: "invalid-feedback",
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parent('.form-group').append(error);
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
                    $("#createForm").submit();
                },
                // onInit : function (event, currentIndex) {
                //     event.append('demo');
                // }
            });

        })(jQuery);
    </script>
@endsection
