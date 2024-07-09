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
            <p class="mb-0 text-muted">Surat Keterangan Tidak Mampu</p>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form id="createForm" method="POST" method="POST" action="/user/layanan/sktm/update/{{ $request->request_id }}" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Kebutuhan</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Peruntukan<span class="text-danger">*</span></label>
                                <select class="form-control form-select" id="purpose" name="purpose" disabled>
                                    <option value="">- Pilih Peruntukan -</option>
                                    <option value="1"
                                        {{ $request->service_id == 'REQ_SKTM_EDUCATION' ? 'selected' : '' }}>Sekolah
                                    </option>
                                    <option value="2"
                                        {{ $request->service_id == 'REQ_SKTM_HEALTH' ? 'selected' : '' }}>Kesehatan/Rumah
                                        Sakit</option>
                                    <option value="3"
                                        {{ $request->service_id == 'REQ_SKTM_JUDICIARY' ? 'selected' : '' }}>Pengadilan
                                    </option>
                                    <option value="4" {{ $request->service_id == 'REQ_SKTM_PLN' ? 'selected' : '' }}>
                                        PLN</option>
                                </select>
                            </div>
                            @if ($request->service_id == 'REQ_SKTM_EDUCATION')
                                <!-- Student -->
                                <div class="row mx-0 px-0 d-none form-group" id="studentForm">
                                    <div class="col-md-12 mt-4">
                                        <h5>Informasi Siswa</h5>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nomor Kartu Indonesia Pintar (KIP)</label>
                                        <input type="text" name="no_kip" class="form-control"
                                            value="{{ $request_detail->no_kip }}" placeholder="Masukan nomor KIP">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nama Siswa<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_siswa" class="form-control"
                                            value="{{ $request_detail->nama_siswa }}" placeholder="Masukan nama siswa">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                        <input type="text" name="tmp_lahir_siswa" class="form-control"
                                            value="{{ $request_detail->tmp_lahir_siswa }}"
                                            placeholder="Masukan tempat lahir">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_lahir_siswa" class="form-control datepicker_birth"
                                                value="{{ isset($request_detail->tgl_lahir_siswa) ? DateFormatHelper::dateNum($request_detail->tgl_lahir_siswa) : '' }}"
                                                placeholder="dd/mm/yyyy">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="ri-calendar-line"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Hubungan Keluarga<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="id_hub_kel">
                                            <option value="">- Pilih Hubungan Keluarga -</option>
                                            @if (sizeof($famRelations) > 0)
                                                @foreach ($famRelations as $famRelation)
                                                    <option value="{{ $famRelation->id_hub }}"
                                                        {{ $request_detail->id_hub_kel == $famRelation->id_hub ? 'selected' : '' }}>
                                                        {{ $famRelation->nama_hub }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nama Sekolah<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_sekolah" class="form-control"
                                            value="{{ $request_detail->nama_sekolah }}"
                                            placeholder="Masukan nama sekolah">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Keperluan<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="keperluan_education">
                                            <option value="">- Pilih Keperluan -</option>
                                            @if (sizeof($ketIncapables) > 0)
                                                @foreach ($ketIncapables as $ketIncapable)
                                                    <option value="{{ $ketIncapable->id_ket }}"
                                                        {{ $request_detail->id_ket == $ketIncapable->id_ket ? 'selected' : '' }}>
                                                        {{ $ketIncapable->ket }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!-- End Student -->
                            @elseif($request->service_id == 'REQ_SKTM_HEALTH')
                                <!-- Patient -->
                                <div class="row mx-0 px-0 d-none" id="patientForm">
                                    <div class="col-md-12 mt-4">
                                        <h5>Informasi Pasien</h5>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="swithisSelf" name="peruntukan" @if($request_detail->peruntukan) checked @endif>
                                            <label class="form-check-label" for="swithisSelf"><p class="mb-0">Untuk keperluan diri sendiri</p></label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nomor Kartu Indonesia Pintar (KIP)</label>
                                        <input type="text" name="no_kip_health" class="form-control"
                                            value="{{ $request_detail->no_kip }}" placeholder="Masukan nomor KIP">
                                    </div> -->
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nomor Jamkesmas</label>
                                        <input type="text" name="no_jamkesmas" class="form-control"
                                            value="{{ $request_detail->no_jamkesmas }}"
                                            placeholder="Masukan nomor jamkesmas">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nama Pasien<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_pasien" class="form-control"
                                            value="{{ $request_detail->nama_pasien }}" placeholder="Masukan nomor KIP">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                        <input type="text" name="tmp_lahir_pasien" class="form-control"
                                            value="{{ $request_detail->tmp_lahir_pasien }}"
                                            placeholder="Masukan tempat lahir">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_lahir_pasien" class="form-control datepicker_birth"
                                                value="{{ isset($request_detail->tgl_lahir_pasien) ? DateFormatHelper::dateNum($request_detail->tgl_lahir_pasien) : '' }}"
                                                placeholder="dd/mm/yyyy">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="ri-calendar-line"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Nama Rumah Sakit<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="id_rumkit">
                                            <option value="">- Pilih Rumah Sakit -</option>
                                            @if (sizeof($hospitals) > 0)
                                                @foreach ($hospitals as $hospital)
                                                    <option value="{{ $hospital->id_hospital }}"
                                                        {{ $request_detail->id_rumkit == $hospital->id_hospital ? 'selected' : '' }}>
                                                        {{ $hospital->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label">Hubungan Keluarga<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="id_hub_kel">
                                            <option value="">- Pilih Hubungan Keluarga -</option>
                                            @if (sizeof($famRelations) > 0)
                                                @foreach ($famRelations as $famRelation)
                                                    <option value="{{ $famRelation->id_hub }}"
                                                        {{ $request_detail->id_hub_kel == $famRelation->id_hub ? 'selected' : '' }}>
                                                        {{ $famRelation->nama_hub }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!-- End Patient -->
                            @else
                                <div class="col-md-6 mb-3 d-none form-group" id="otherForm">
                                    <label class="form-label">Keperluan<span class="text-danger">*</span></label>
                                    <input type="text" name="keperluan" class="form-control"
                                        value="{{ $request_detail->keperluan }}" placeholder="Masukan keperluan">
                                </div>
                            @endif
                            <div class="col-md-12 mt-4">
                                <h5>Informasi Surat Pengantar RT/RW</h5>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Nomor Surat<span class="text-danger">*</span></label>
                                <input type="text" name="no_surat_pengantar" class="form-control"
                                    placeholder="Masukan nomor surat" value="{{ $request->no_surat_pengantar }}">
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label">Tanggal Surat<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="tgl_surat_pengantar" class="form-control datepicker"
                                        placeholder="dd/mm/yyyy"
                                        value="{{ DateFormatHelper::dateIn($request->tgl_surat_pengantar) }}">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="ri-calendar-line"></i></span>
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
                                                    {{ $request->kd_kel == $sub_district->kd_sub_district ? 'selected' : '' }}>
                                                    {{ $sub_district->sub_district }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Rukun Tetangga (RT)<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control"
                                    placeholder="Masukan rukun tetangga" value="{{ $request->rt }}"
                                    disabled="disabled">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Rukun Warga (RW)<span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control"
                                    placeholder="Masukan rukun warga" value="{{ $request->rw }}" disabled="disabled">
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kartu Tanda Penduduk (KTP)<span
                                        class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KTP')
                                            <a href="/storage/files/request_sktm/ktp/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_ktp" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kartu Keluarga<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_KK')
                                            <a href="/storage/files/request_sktm/kk/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_kk" class="form-control"
                                    placeholder="Masukan KTP">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Surat Pengantar RT/RW<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                            <a href="/storage/files/request_sktm/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}" target="_blank"
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Surat Pernyataan<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_PERNYATAAN')
                                            <a href="/storage/files/request_sktm/surat_pernyataan/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_pernyataan" class="form-control"
                                    placeholder="Masukan surat pernyataan">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 d-none" id="schoolRequirement">
                                <label class="form-label">Surat Rekomendasi Sekolah<span class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_REKOMENDASI_SEKOLAH')
                                            <a href="/storage/files/request_sktm/rekom_sekolah/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_rekom_sekolah" class="form-control"
                                    placeholder="Masukan surat rekomendasi">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 d-none" id="referenceRequirement">
                                <label class="form-label">Surat Rujukan Puskesmas/Rumah Sakit<span
                                        class="text-danger">*</span>
                                    @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_RUJUKAN_RS')
                                            <a href="/storage/files/request_sktm/rujukan_rs/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                    @endforeach
                                </label>
                                <input type="file" name="f_rujukan_rs" class="form-control"
                                    placeholder="Masukan surat rujukan">
                                <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                            </div>
                            <div class="col-md-6 mb-3 d-none" id="cardRequirement">
                                <label class="form-label">Kartu Jamkesmas< @foreach ($request_docs as $request_doc)
                                        @if ($request_doc->request_attachment_note == 'FILE_JAMKESMAS')
                                            <a href="/storage/files/request_sktm/jamkesmas/{{ $request_doc->request_attachment_file }}" target="_blank"
                                                class="bg-light ms-2 text-primary p-1 px-2 rounded-2 ms-2">
                                                <i class="ri-arrow-right-up-line"></i> Lihat File
                                            </a>
                                        @endif
                                        @endforeach
                                </label>
                                <input type="file" name="f_jamkesmas" class="form-control"
                                    placeholder="Masukan kartu jamkesmas">
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
                    purpose: "required",
                    keperluan: "required",
                    keperluan_education: "required",
                    nama_siswa: "required",
                    tmp_lahir_siswa: "required",
                    tgl_lahir_siswa: "required",
                    id_hub_kel: "required",
                    nama_sekolah: "required",
                    nama_pasien: 'required',
                    tmp_lahir_pasien: "required",
                    tgl_lahir_pasien: "required",
                    id_rumkit: "required",
                    no_kip: {
                        minlength: 6
                    },
                    no_kip_health: {
                        number: true
                    },
                    no_jamkesmas: {
                        number: true
                    },
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
                    f_pernyataan: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_rekom_sekolah: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_rujukan_rs: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    },
                    f_jamkesmas: {
                        extension: "pdf|jpg|jpeg|png",
                        filesize: 1024000
                    }
                },
                messages: {
                    purpose: "Peruntukan harus dipilih",
                    keperluan: "Keperluan harus di isi",
                    keperluan_education: "Keperluan harus di isi",
                    nama_siswa: "Nama siswa harus diisi",
                    tmp_lahir_siswa: "Tempat lahir siswa harus diisi",
                    tgl_lahir_siswa: "Tanggal lahir siswa harus diisi",
                    id_hub_kel: "Hubungan keluarga harus dipilih",
                    nama_sekolah: "Nama sekolah harus diisi",
                    nama_pasien: 'Nama pasien harus diisi',
                    tmp_lahir_pasien: "Tempat lahir pasien harus diisi",
                    tgl_lahir_pasien: "Tanggal lahir pasien ahrus diisi",
                    id_rumkit: "Rumah sakit harus dipilih",
                    no_surat_pengantar: "No surat pengantar",
                    tgl_surat_pengantar: "Tanggal surat pengantar",
                    f_agreement : "Agreement harap di ceklis",
                    no_kip: {
                        minlength: "No KIP minimal harus 6 karakter",
                    },
                    no_kip_health: {
                        number: "Harus berisi angka",
                    },
                    no_jamkesmas: {
                        number: "Harus berisi angka",
                    },
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
                    f_pernyataan: {
                        extension: "pdf|jpge|jpeg|png",
                        filesize: 1024000
                    },
                    f_rekom_sekolah: {
                        extension: "pdf|jpge|jpeg|png",
                        filesize: 1024000
                    },
                    f_rujukan_rs: {
                        extension: "pdf|jpge|jpeg|png",
                        filesize: 1024000
                    },
                    f_jamkesmas: {
                        extension: "pdf|jpge|jpeg|png",
                        filesize: 1024000
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

                var id = $("#purpose").val();

                if (id == 1) {
                    $('#studentForm').removeClass('d-none');
                    $('#patientForm').addClass('d-none');
                    $('#otherForm').addClass('d-none');

                    $('#schoolRequirement').removeClass('d-none');
                    $('#referenceRequirement').addClass('d-none');
                    $('#cardRequirement').addClass('d-none');
                } else if (id == 2) {
                    $('#studentForm').addClass('d-none');
                    $('#patientForm').removeClass('d-none');
                    $('#otherForm').addClass('d-none');

                    $('#schoolRequirement').addClass('d-none');
                    $('#referenceRequirement').removeClass('d-none');
                    $('#cardRequirement').removeClass('d-none');
                } else {
                    $('#studentForm').addClass('d-none');
                    $('#patientForm').addClass('d-none');
                    $('#otherForm').removeClass('d-none');

                    $('#schoolRequirement').addClass('d-none');
                    $('#referenceRequirement').addClass('d-none');
                    $('#cardRequirement').addClass('d-none');
                }

            })
            // $('#purpose').change(function() {

            //     var id = $(this).val();

            //     if (id == 1) {
            //         $('#studentForm').removeClass('d-none');
            //         $('#patientForm').addClass('d-none');
            //         $('#otherForm').addClass('d-none');

            //         $('#schoolRequirement').removeClass('d-none');
            //         $('#referenceRequirement').addClass('d-none');
            //         $('#cardRequirement').addClass('d-none');
            //     } else if (id == 2) {
            //         $('#studentForm').addClass('d-none');
            //         $('#patientForm').removeClass('d-none');
            //         $('#otherForm').addClass('d-none');

            //         $('#schoolRequirement').addClass('d-none');
            //         $('#referenceRequirement').removeClass('d-none');
            //         $('#cardRequirement').removeClass('d-none');
            //     } else {
            //         $('#studentForm').addClass('d-none');
            //         $('#patientForm').addClass('d-none');
            //         $('#otherForm').removeClass('d-none');

            //         $('#schoolRequirement').addClass('d-none');
            //         $('#referenceRequirement').addClass('d-none');
            //         $('#cardRequirement').addClass('d-none');
            //     }

            // });

            $('#swithisSelf').change(function(){

                var nama_pasien = "@if($request->service_id == 'REQ_SKTM_HEALTH') {{ $request_detail->nama_pasien }} @else @endif";
                var tmp_lahir_pasien = "@if($request->service_id == 'REQ_SKTM_HEALTH') {{ $request_detail->tmp_lahir_pasien }} @else @endif";
                var tgl_lahir_pasien = "@if($request->service_id == 'REQ_SKTM_HEALTH') {{ DateFormatHelper::dateNum($user->tgl_lahir_pasien) }} @else @endif";

                if($(this).is(':checked')){
                    $('#nama_pasien').val("{{ $user->user_nama }}");
                    $('#tmp_lahir_pasien').val("{{ $user->user_tmp_lahir }}");
                    $('#tgl_lahir_pasien').val("{{ DateFormatHelper::dateNum($user->user_tgl_lahir) }}");

                    $('#nama_pasien').attr('readonly', 'readonly');
                    $('#tmp_lahir_pasien').attr('readonly', 'readonly');
                    $('#tgl_lahir_pasien').attr('readonly', 'readonly');

                    $('#id_hub_kel_rs').addClass('d-none');

                }
                else{
                    $('#nama_pasien').val(nama_pasien);
                    $('#tmp_lahir_pasien').val(tmp_lahir_pasien);
                    $('#tgl_lahir_pasien').val(tgl_lahir_pasien);

                    $('#nama_pasien').removeAttr('readonly');
                    $('#tmp_lahir_pasien').removeAttr('readonly');
                    $('#tgl_lahir_pasien').removeAttr('readonly');

                    $('#id_hub_kel_rs').removeClass('d-none');

                }

            });

        })(jQuery);
    </script>
@endsection
