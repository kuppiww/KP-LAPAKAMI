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
            <p class="mb-0 text-muted">Surat Keterangan Kelahiran</p>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form id="createForm" method="POST" action="/user/layanan/kelahiran/update/{{ $request->request_id }}"
                enctype="multipart/form-data">
                @csrf
                <!-- Form 1 -->
                <h3>
                    <span class="title_text">Informasi Pemohon</span>
                </h3>
                <fieldset>
                    <div class="fieldset-content">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_warga" class="form-control"
                                    placeholder="Masukan nama lengkap" value="{{ $request->nama_warga }}" readonly>
                            </div>
                            <div class="col-md-12"></div>
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
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="" placeholder="Tulis alamat lengkap disini" disabled="disabled">{{ $request->user_alamat }}</textarea>
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
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Ayah</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" name="nik_ayah" class="form-control"
                                    value="{{ $request_detail->nik_ayah }}" placeholder="Masukan nomor induk kependudukan">
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_ayah" class="form-control"
                                    value="{{ $request_detail->nama_ayah }}" placeholder="Masukan nama lengkap">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir_ayah" class="form-control datepicker"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_lahir_ayah) }}"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Agama</label>
                                <select class="form-control form-select" name="id_agama_ayah">
                                    <option value="">- Pilih Agama -</option>
                                    @if (sizeof($religions) > 0)
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id_religion }}"
                                                {{ $request_detail->id_agama_ayah == $religion->id_religion ? 'selected' : '' }}>
                                                {{ $religion->religion }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control"
                                    value="{{ $request_detail->pekerjaan_ayah }}" placeholder="Masukan pekerjaan">
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat_ayah" placeholder="Tulis alamat lengkap disini">{{ $request_detail->alamat_ayah }}</textarea>
                            </div>
                            <!-- End Info Father -->

                            <!-- Info Mother -->
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Ibu</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" name="nik_ibu" class="form-control"
                                    value="{{ $request_detail->nik_ibu }}"
                                    placeholder="Masukan nomor induk kependudukan">
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_ibu" class="form-control"
                                    value="{{ $request_detail->nama_ibu }}" placeholder="Masukan nama lengkap">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir_ibu" class="form-control datepicker"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_lahir_ibu) }}"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Agama</label>
                                <select class="form-control form-select" name="id_agama_ibu">
                                    <option value="">- Pilih Agama -</option>
                                    @if (sizeof($religions) > 0)
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id_religion }}"
                                                {{ $request_detail->id_agama_ibu == $religion->id_religion ? 'selected' : '' }}>
                                                {{ $religion->religion }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control"
                                    value="{{ $request_detail->pekerjaan_ibu }}" placeholder="Masukan pekerjaan">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat_ibu" placeholder="Tulis alamat lengkap disini">{{ $request_detail->alamat_ibu }}</textarea>
                            </div>
                            <!-- End Into Mother -->

                            <!-- Info Child -->
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Anak</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" name="nik_anak" class="form-control"
                                    value="{{ $request_detail->nik_anak }}"
                                    placeholder="Masukan nomor induk kependudukan">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_anak" class="form-control"
                                    value="{{ $request_detail->nama_anak }}" placeholder="Masukan nama lengkap">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="id_jenkel_anak">
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    @if (sizeof($genders) > 0)
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id_gender }}"
                                                {{ $request_detail->id_jenkel_anak == $gender->id_gender ? 'selected' : '' }}>
                                                {{ $gender->gender }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tmp_lahir_anak" class="form-control"
                                    value="{{ $request_detail->tmp_lahir_anak }}" placeholder="Masukan tempat lahir">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tgl_lahir_anak" class="form-control datepicker"
                                        value="{{ DateFormatHelper::dateNum($request_detail->tgl_lahir_anak) }}"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Anak Ke-<span class="text-danger">*</span></label>
                                <!-- <input type="text" name="urutan_anak" class="form-control" placeholder="Masukan tempat lahir"> -->
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-dark btn-number" disabled="disabled"
                                        data-type="minus" data-field="urutan_anak">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input type="text" name="urutan_anak" class="form-control input-number"
                                        value="{{ $request_detail->urutan_anak }}" placeholder="0" value="1"
                                        min="1" max="99">
                                    <button type="button" class="btn btn-outline-dark btn-number" data-type="plus"
                                        data-field="urutan_anak">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Jam Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="jam_lahir_anak" class="form-control timepicker"
                                        value="{{ $request_detail->jam_lahir_anak }}" placeholder="--:--">
                                    <span class="input-group-text" id="basic-addon2"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                            <!-- End Into Child -->

                            <div class="col-md-12 mt-4">
                                <h5>Informasi Surat Pengantar</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Surat</label>
                                <input type="text" name="no_surat_pengantar" class="form-control"
                                    value="{{ $request->no_surat_pengantar }}" placeholder="Masukan nomor surat">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Surat</label>
                                <div class="input-group">
                                    <input type="text" name="tgl_surat_pengantar" class="form-control datepicker"
                                        value="{{ DateFormatHelper::dateNum($request->tgl_surat_pengantar) }}"
                                        placeholder="dd/mm/yyyy">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Kelurahan</label>
                                <select class="form-control form-select" name="kd_kel" disabled>
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
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Rukun Tetangga (RT)</label>
                                <input type="text" name="rt" class="form-control"
                                    placeholder="Masukan rukun tetangga" value="{{ $request->rt }}" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Rukun Warga (RW)</label>
                                <input type="text" name="rw" class="form-control"
                                    placeholder="Masukan rukun warga" value="{{ $request->rw }}" readonly>
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
                            <div class="col-md-12 mt-4">
                                <h5>Unggah Berkas</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Surat Pengantar RT/RW
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                            <a href="/storage/files/request_birth/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}" target="_blank"
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
                                <label class="form-label">
                                    Kartu Keluarga
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KK')
                                            <a href="/storage/files/request_birth/kk/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_kk" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Kartu Tanda Penduduk (KTP)/Akta Kematian Ayah
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP_AYAH')
                                            <a href="/storage/files/request_birth/ktp_ayah/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp_ayah" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Kartu Tanda Penduduk (KTP)/Akta Kematian Ibu
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP_IBU')
                                            <a href="/storage/files/request_birth/ktp_ibu/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp_ibu" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Buku Nikah Hal 1-3/SPTJM
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_BUKU_NIKAH')
                                            <a href="/storage/files/request_birth/buku_nikah/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_buku_nikah" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    SK Kelahiran dari Rumah Sakit/Bidan/Mengisi SPTJM
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KET_RS')
                                            <a href="/storage/files/request_birth/ket_rs/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ket_rs" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Kartu Tanda Penduduk (KTP) Saksi 1
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP_SAKSI_1')
                                            <a href="/storage/files/request_birth/ktp_saksi_1/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp_saksi_1" class="form-control"
                                    placeholder="Masukan foto KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">
                                    Kartu Tanda Penduduk (KTP) Saksi 2
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP_SAKSI_2')
                                            <a href="/storage/files/request_birth/ktp_saksi_2/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp_saksi_2" class="form-control"
                                    placeholder="Masukan foto KTP">
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
                            <div class="col-md-12 mt-4">
                                <h5>Format Berkas Pendukung</h5>
                            </div>
                            <p class="text-muted">Format pendukung yang dapat anda unduh</p>
                            <p><a href=""><i class="ri-file-download-line text-primary me-2"></i> Unduh SPTJM
                                    Menikah</a></p>
                            <p><a href=""><i class="ri-file-download-line text-primary me-2"></i> Unduh SPTJM
                                    Kelahiran</a></p>
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
                    nik_ayah: {
                        required: true,
                        number: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    nama_ayah: "required",
                    id_agama_ayah: "required",
                    alamat_ayah: "required",
                    pekerjaan_ayah: "required",
                    tgl_lahir_ayah: "required",
                    nik_ibu: {
                        required: true,
                        number: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    nama_ibu: "required",
                    id_agama_ibu: "required",
                    alamat_ibu: "required",
                    pekerjaan_ibu: "required",
                    tgl_lahir_ibu: "required",
                    nik_anak: {
                        number: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    nama_anak: "required",
                    tgl_lahir_anak: "required",
                    jam_lahir_anak: "required",
                    urutan_anak: "required",
                    tmp_lahir_anak: "required",
                    id_jenkel_anak: "required",
                    no_surat_pengantar: "required",
                    tgl_surat_pengantar: "required",
                    f_agreement : "required",
                    f_ktp_ayah: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_ibu: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_saksi_1: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ktp_saksi_2: {
                        extension: "pdf|jpg|jpeg|png",
                    },
                    f_kk: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_buku_nikah: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_ket_rs: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_p_rt_rw: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    }
                },
                messages: {
                    nik_ayah: {
                        number: 'NIK ayah hanya boleh berisi angka',
                        required: "NIK ayah tidak boleh kosong",
                        minlength: "NIK ayah minimal harus 16 karakter",
                        maxlength: "NIK ayah maksimal harus 16 karakter",
                    },
                    nama_ayah: "Nama ayah tidak boleh kosong",
                    id_agama_ayah: "Agama tidak boleh kosong",
                    alamat_ayah: "Alamat ayah tidak boleh kosong",
                    pekerjaan_ayah: "Pekerjaan ayah tidak boleh kosong",
                    tgl_lahir_ayah: "Tanggal lahir ayah tidak boleh kosong",
                    nik_ibu: {
                        number: 'NIK ibu hanya boleh berisi angka',
                        required: "NIK ibu tidak boleh kosong",
                        minlength: "NIK ibu minimal harus 16 karakter",
                        maxlength: "NIK ibu maksimal harus 16 karakter",
                    },
                    nama_ibu: "Nama ibu tidak boleh kosong",
                    id_agama_ibu: "Agama ibu tidak boleh kosong",
                    alamat_ibu: "Alamata ibu tidak boleh kosong",
                    pekerjaan_ibu: "Pekerjaan ibu tidak boleh kosong",
                    tgl_lahir_ibu: "Tanggal lahir ibu tidak boleh kosong",
                    nik_anak: {
                        number: 'NIK anak hanya boleh berisi angka',
                        minlength: "NIK anak minimal harus 16 karakter",
                        maxlength: "NIK anakmaksimal harus 16 karakter",
                    },
                    nama_anak: "Nama tidak boleh kosong",
                    tgl_lahir_anak: "Tanggal lahir tidak boleh kosong",
                    jam_lahir_anak: "Jam lahir anak tidak boleh kosong",
                    urutan_anak: "Urutan anak tidak boleh kosong",
                    tmp_lahir_anak: "Tempat lahir tidak boleh kosong",
                    id_jenkel_anak: "Jenis kelamin harus dipilih",
                    no_surat_pengantar: "No surat pengantar tidak boleh kosong",
                    tgl_surat_pengantar: "Tanggal surat pengantar tidak boleh kosong",
                    f_agreement : "Agreement harap di ceklis",
                    f_ktp_ayah: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_ibu: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_saksi_1: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ktp_saksi_2: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_kk: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_buku_nikah: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_ket_rs: {
                        extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                        filesize: "Ukuran file maksimal 1MB"
                    },
                    f_p_rt_rw: {
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
                    return form.valid();
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
