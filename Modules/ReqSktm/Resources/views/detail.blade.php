@extends('layouts.userblank')
@section('title')
    Detail Permohonan Layanan
@endsection
<?php use App\Helpers\DateFormatHelper; use App\Helpers\Masking; ?>


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
        <div class="col-md-6">
            <h4 class="text-dark fw-bold mb-0">Detail Permohonan Layanan</h4>
            <p class="mb-0 text-muted">{{ $request->service_name }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            @if ($request->request_status_id == 'SUBMITED' || $request->request_status_id == 'REJECTED')
                <a href="/user/layanan/sktm/ubah/{{ $request->request_id }}" class="btn btn-warning">
                    <i class="ri-pencil-line me-2"></i> Ubah Permohonan
                </a>
            @endif
            @if ($request->request_status_id == 'SUBMITED')
                <a href="javascript:void(0)" data-url="/user/layanan/sktm/batal/{{ $request->request_id }}" class="btn btn-danger btnCancelReq">
                    <i class="ri-close-circle-line me-2"></i> Batalkan Permohonan
                </a>

            @endif  
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card p-2 border-0">
                <div class="card-body">

                    <!-- Tab Action -->
                    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-user-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-user" type="button" role="tab" aria-controls="pills-user"
                                aria-selected="true">Informasi Pemohon</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-service-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-service" type="button" role="tab" aria-controls="pills-service"
                                aria-selected="false">Informasi Layanan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-requirement-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-requirement" type="button" role="tab"
                                aria-controls="pills-requirement" aria-selected="false">Berkas Persyaratan</button>
                        </li>
                    </ul>
                    <!-- End Tab Action -->

                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Tab 1. Informasi Pemohon -->
                        <div class="tab-pane fade show active" id="pills-user" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Nomor Induk Kependudukan</label><br>
                                        {{ Masking::number($request->nik, 4) }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Nomor Kartu Keluarga</label><br>
                                        {{ Masking::number($request->no_kk, 4) }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Nama Lengkap</label><br>
                                        {{ $request->nama_warga }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Jenis Kelamin</label><br>
                                        {{ $request->gender }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Tempat Lahir</label><br>
                                        {{ $request->tmp_lahir }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Tanggal Lahir</label><br>
                                        {{ DateFormatHelper::dateIn($request->tgl_lahir) }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Agama</label><br>
                                        {{ $request->religion }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Pekerjaan</label><br>
                                        {{ $request->pekerjaan }}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <label class="form-label">Alamat Lengkap</label><br>
                                        {{ $request->user_alamat }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Tab 1. Informasi Pemohon -->

                        <!-- Tab 2. Informasi Layanan -->
                        <div class="tab-pane fade" id="pills-service" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h5 class="text-dark">Informasi Surat Pengantar</h5>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Nomor Surat</label><br>
                                        {{ $request->no_surat_pengantar }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Tanggal Surat</label><br>
                                        {{ DateFormatHelper::dateIn($request->tgl_surat_pengantar) }}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <label class="form-label">Kelurahan</label><br>
                                        {{ $request->sub_district }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Rukun Tetangga (RT)</label><br>
                                        {{ $request->rt }}

                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="form-label">Rukun Warga (RW)</label><br>
                                        {{ $request->rw }}
                                    </p>
                                </div>
                                @if ($request->service_id == 'REQ_SKTM_EDUCATION')
                                    {{-- infomasi siswa --}}
                                    <div class="col-md-12 mb-3">
                                        <h5 class="text-dark">Informasi Siswa</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Nama Siswa</label><br>
                                            {{isset ($request_detail->nama_siswa) ? $request_detail->nama_siswa : null}}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Nomor KIP</label><br>
                                            {{ isset ($request_detail->no_kip) ? $request_detail->no_kip : '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Tanggal Lahir</label><br>
											{{isset ($request_detail->tgl_lahir_siswa) ? DateFormatHelper::dateIn($request_detail->tgl_lahir_siswa) : null}}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Tempat Lahir Siswa</label><br>
											{{ isset ($request_detail->tmp_lahir_siswa) ? $request_detail->tmp_lahir_siswa : null }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Hubungan Keluarga</label><br>
											{{ isset ($request_detail->nama_hub) ? $request_detail->nama_hub : null }}
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Nama Sekolah</label><br>
											{{ isset ($request_detail->nama_sekolah) ? $request_detail->nama_sekolah : null }}
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Keperluan</label><br>
											{{ isset ($request_detail->ket) ? $request_detail->ket : null }}
                                        </p>
                                    </div>
                                    {{-- end informasi siswa --}}
                                @elseif ($request->service_id == 'REQ_SKTM_HEALTH')
                                    {{-- infomasi pasien --}}
                                    <div class="col-md-12 mb-3">
                                        <h5 class="text-dark">Informasi Pasien</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Untuk keperluan diri sendiri</label><br>
                                            {{ $request_detail->peruntukan == 1 ? 'Ya' : 'Tidak' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Nama Pasien</label><br>
											{{ isset ($request_detail->nama_pasien) ? $request_detail->nama_pasien : null }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">No Jamkesmas</label><br>
                                            {{ isset ($request_detail->no_jamkesmas) ? $request_detail->no_jamkesmas : '-' }}
                                        </p>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Nomor KIP</label><br>
											{{ isset ($request_detail->no_kip) ? $request_detail->no_kip : '-' }}
                                        </p>
                                    </div> -->
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Tanggal Lahir</label><br>
											{{ isset ($request_detail->tgl_lahir_pasien) ? DateFormatHelper::dateIn($request_detail->tgl_lahir_pasien) : null }}

                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Tempat Lahir Pasien</label><br>
											{{ isset ($request_detail->tmp_lahir_pasien) ? $request_detail->tmp_lahir_pasien : null }}

                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Hubungan Keluarga</label><br>
											{{ isset ($request_detail->nama_hub) ? $request_detail->nama_hub : null }}

                                        </p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Nama Rumah Sakit</label><br>
											{{ isset ($request_detail->name) ? $request_detail->name : null }}

                                        </p>
                                    </div>
                                    {{-- end informasi health --}}
                                @else
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Keperluan</label><br>
											{{isset ($request_detail->keperluan) ? $request_detail->keperluan : null }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- End Tab 2. Informasi Layanan -->

                        <!-- Tab 3. Berkas Persyaratan -->
                        <div class="tab-pane fade" id="pills-requirement" role="tabpanel"
                            aria-labelledby="pills-contact-tab" tabindex="0">
                            <div class="row">
                                @foreach ($request_docs as $request_doc)
                                    <div class="col-md-6">
                                        <p>
                                            @if ($request_doc->request_attachment_note == 'FILE_KTP')
                                                <label class="form-label">Kartu Tanda Penduduk (KTP)
                                                    Pemohon</label><br>
                                                <a href="javascript:void(0)" data-title="Kartu Tanda Penduduk (KTP)" data-src="/storage/files/request_sktm/ktp/{{ $request_doc->request_attachment_file }}"
                                                     class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> KTP Pemohon</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                                <label class="form-label">Surat Pengantar RT/RW</label><br>
                                                <a href="javascript:void(0)" data-title="Surat Pengantar RT/RW" data-src="/storage/files/request_sktm/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}"
                                                    class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Surat pengantar</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_KK')
                                                <label class="form-label">Kartu Keluarga</label><br>
                                                <a href="javascript:void(0)" data-title="Kartu Keluarga" data-src="/storage/files/request_sktm/kk/{{ $request_doc->request_attachment_file }}"
                                                    class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Kartu Keluarga</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_PERNYATAAN')
                                                <label class="form-label">Surat Pernyataan</label><br>
                                                <a href="javascript:void(0)" data-title="Surat Pernyataan" data-src="/storage/files/request_sktm/surat_pernyataan/{{ $request_doc->request_attachment_file }}"
                                                     class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Surat Pernyataan</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_REKOMENDASI_SEKOLAH')
                                                <label class="form-label">Surat Rekomendasi Sekolah</label><br>
                                                <a href="javascript:void(0)" data-title="Surat Rekomendasi Sekolah" data-src="/storage/files/request_sktm/rekom_sekolah/{{ $request_doc->request_attachment_file }}"
                                                     class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Surat Rekomendasi</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_RUJUKAN_RS')
                                                <label class="form-label">Surat Rujukan Rumah Sakit</label><br>
                                                <a href="javascript:void(0)" data-title="Surat Rujukan Rumah Sakit" data-src="/storage/files/request_sktm/rujukan_rs/{{ $request_doc->request_attachment_file }}"
                                                    class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Surat Rujukan RS</a>
                                            @elseif ($request_doc->request_attachment_note == 'FILE_JAMKESMAS')
                                                <label class="form-label">Jamkesmas</label><br>
                                                <a href="javascript:void(0)" data-title="Jamkesmas" data-src="/storage/files/request_sktm/jamkesmas/{{ $request_doc->request_attachment_file }}"
                                                     class="btn btn-light btnStreamModal"><i
                                                        class="ri-image-line me-2"></i> Jamkesmas</a>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Tab 3. Berkas Persyaratan -->
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-2 border-0 mb-4">
                <div class="card-body">
                    <h5 class="text-dark mb-1 text-center">Dokumen Hasil</h5>
                    <p class="text-muted text-center">Dokumen hasil permohonan anda dapat diunduh disini</p>

                    @if ((!$request->service_is_kec && $request->request_status_id == 'APPROVED') || ($request->service_is_kec && $request->request_status_id == 'APPROVED_KEC'))
                        <!-- Available -->
                        <a href="javascript:void(0)" class="btn btn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#downloadModal"><i class="ri-file-search-line me-2"></i> Lihat Dokumen</a>
                        <!-- End Available -->
                    @else
                        <!-- Not Available -->
                        <a href="" class="btn btn-danger disabled w-100"><i class="ri-file-forbid-line me-2"></i>
                            Belum tersedia</a>
                        <!-- End Not Available -->
                    @endif

                </div>
            </div>
            <div class="card p-2 border-0">
                <div class="card-body">
                    <h5 class="text-dark text-center mb-2">Status Pelayanan</h5>
                    <div class="timeline-status">

                        @foreach ($logs as $log)
                            <div class="tl-item @if($loop->iteration == 1) active @endif">
                                @if ($loop->iteration === 1)
                                    <div class="tl-dot b-warning"></div>
                                @else
                                    <div class="tl-dot b-danger"></div>
                                @endif
                                <div class="tl-content w-100">
                                    @if ($loop->iteration === 1)
                                        <p class="mb-1 text-dark fw-semibold">{{ $log->request_status_name }}</p>
                                    @else
                                        <p class="mb-1">{{ $log->request_status_name }}</p>
                                    @endif
                                    @if($log->request_status_id == "REJECTED")
                                        <div class="tl-date text-muted">{{ $log->request_log_note }}</div>
                                    @endif
                                    <div class="tl-date text-muted">{{ DateFormatHelper::dateInFull($log->created_at) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">{{ $request->service_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed src="{{ url('backend/'. $request->slug_simkel .'/besign-pdf/'. $request->request_file) }}" class="w-100" width="" height="500" type="application/pdf">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <a type="button" class="btn btn-primary" href="{{ url('backend/'. $request->slug_simkel .'/besign-pdf/'. $request->request_file) }}" download>Unduh</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection
