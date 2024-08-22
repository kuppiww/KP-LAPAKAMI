@extends('layouts.userblank')
@section('title')
    Verifikasi Permohonan Layanan
@endsection
<?php use App\Helpers\DateFormatHelper; use App\Helpers\Masking; ?>


@section('content')
    <!-- Back Button -->
    <div class="mb-4 d-flex align-items-center">
        <a href="{{ url('verification') }}" class="btn btn-lg btn-icon btn-light rounded-circle py-1 me-3">
            <i class="ri-arrow-left-line"></i>
        </a>
        <a href="{{ url('verification') }}" class="d-inline-block">Kembali</a>
    </div>
    <!-- End Back Button -->

    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="text-dark fw-bold mb-0">Detail Permohonan Layanan</h4>
            <p class="mb-0 text-muted">{{ $request->service_name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                <div class="alert alert-warning" role="alert">
                    Permohonan ini sudah ditolak
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card p-2 border-0">
                <div class="card-body">
                    {{-- <form action="{{ url('/user/layanan/sktm/updatepermohonan/'.$request->request_id) }}" id="formUbah" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-title">Informasi Pemohon</div>
                            </div>
                            <hr style="border-top: 2px solid rgba(0, 0, 0, 0.3);">
                            <div class="col-md-4">
                                <p>
                                    <label class="form-label">NIK</label><br>
                                    {{ Masking::number($request->nik, 4) }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <label class="form-label">Nomor Kartu Keluarga</label><br>
                                    {{ Masking::number($request->no_kk, 4) }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <label class="form-label">Nama Lengkap</label><br>
                                    {{ $request->nama_warga }}
                                </p>
                            </div>
    
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">No Surat Pengantar</label><br>
                                        {{ $request->no_surat_pengantar }}
                                    </p>
                                @else
                                    <label class="form-label">No Surat Pengantar</label>
                                    <input type="text" class="form-control" name="no_surat_pengantar" id="no_surat_pengantar" value="{{ $request->no_surat_pengantar }}" >
                                @endif
                            </div>
    
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Tanggal Surat Pengantar</label><br>
                                        {{ DateFormatHelper::dateIn($request->tgl_surat_pengantar) }}
                                    </p>
                                @else
                                    <label class="form-label">Tanggal Surat Pengantar</label>
                                    <input type="date" class="form-control" name="tgl_surat_pengantar" id="tgl_surat_pengantar" value="{{ $request->tgl_surat_pengantar }}" >
                                @endif
                            </div>
                            
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Jenis Kelamin</label><br>
                                        {{ $request->gender }}
                                    </p>
                                @else
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-control" name="gender" id="gender">
                                        @foreach ($listJK as $item)
                                            <option {{ ($item->id_gender) == $request->id_jenkel ? 'selected' : ''}} value="{{ $item->id_gender }}">{{ $item->gender }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Tempat Lahir</label><br>
                                        {{ $request->tmp_lahir }}
                                    </p>
                                @else
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" value="{{ $request->tmp_lahir }}">
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Tanggal Lahir</label><br>
                                        {{ DateFormatHelper::dateIn($request->tgl_lahir) }}
                                    </p>
                                @else
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ $request->tgl_lahir }}" >
                                @endif
                            </div>
                            <div class="col-md-4">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Agama</label><br>
                                        {{ $request->religion }}
                                    </p>
                                @else
                                    <label class="form-label">Agama</label>
                                    <select class="form-control" name="religion" id="religion">
                                        @foreach ($listReligion as $items)
                                            <option {{ ($items->id_religion) == $request->id_agama ? 'selected' : ''}} value="{{ $items->id_religion }}">{{ $items->religion }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Pekerjaan</label><br>
                                        {{ $request->pekerjaan }}
                                    </p>
                                @else
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ $request->pekerjaan }}" >
                                @endif
                            </div>
    
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">RT</label><br>
                                        {{ $request->rt }}
                                    </p>
                                @else
                                    <label class="form-label">RT</label>
                                    <input type="text" class="form-control" name="rt" id="rt" value="{{ $request->rt }}" >
                                @endif
                            </div>
    
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">RW</label><br>
                                        {{ $request->rw }}
                                    </p>
                                @else
                                    <label class="form-label">RW</label>
                                    <input type="text" class="form-control" name="rw" id="rw" value="{{ $request->rw }}" >
                                @endif
                            </div>
    
                            <div class="col-md-4 form-group">
                                <p>
                                    <label class="form-label">Alamat Lengkap</label><br>
                                    {{ $request->user_alamat }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="card-title">Informasi Pasien</div>
                            </div>
                            <hr style="border-top: 2px solid rgba(0, 0, 0, 0.3);">
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Nama Pasien</label><br>
                                        {{ $request_detail->nama_pasien }}
                                    </p>
                                @else
                                    <label class="form-label">Nama Pasien</label>
                                    <input class="form-control" type="text" name="nama_pasien" id="nama_pasien" value="{{ $request_detail->nama_pasien }}" >
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Tempat Lahir Pasien</label><br>
                                        {{ $request_detail->tmp_lahir_pasien }}
                                    </p>
                                @else
                                    <label class="form-label">Tempat Lahir Pasien</label>
                                    <input type="text" class="form-control" name="tmp_lahir_pasien" id="tmp_lahir_pasien" value="{{ $request_detail->tmp_lahir_pasien }}">
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Tanggal Lahir Pasien</label><br>
                                        {{ DateFormatHelper::dateIn($request_detail->tgl_lahir_pasien) }}
                                    </p>
                                @else
                                    <label class="form-label">Tanggal Lahir Pasien</label>
                                    <input type="date" class="form-control" name="tgl_lahir_pasien" id="tgl_lahir_pasien" value="{{ $request_detail->tgl_lahir_pasien }}" >
                                @endif
                            </div>

                            <div class="col-md-4">
                                @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                    <p>
                                        <label class="form-label">Rumah Sakit</label><br>
                                        {{ $request_detail->name }}
                                    </p>
                                @else
                                    <label class="form-label">Rumah Sakit</label>
                                    <select class="form-control" name="id_rumkit" id="id_rumkit">
                                        @foreach ($listHospitals as $items)
                                            <option {{ ($items->id_hospital) == $request_detail->id_rumkit ? 'selected' : ''}} value="{{ $items->id_hospital }}">{{ $items->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                        @endif
                    </form> --}}
                    
                    <form action="{{ url('/operator/sktm/updatepermohonan/'.$request->request_id) }}" id="formUbah" method="POST">
                        @csrf
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
                                <button class="nav-link" id="pills-pasien-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-pasien" type="button" role="tab" aria-controls="pills-pasien"
                                    aria-selected="false">Informasi Pasien</button>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <label class="form-label">Nomor Induk Kependudukan</label><br>
                                            {{ Masking::number($request->nik, 4) }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <label class="form-label">Nomor Kartu Keluarga</label><br>
                                            {{ Masking::number($request->no_kk, 4) }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <label class="form-label">Nama Lengkap</label><br>
                                            {{ $request->nama_warga }}
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Alamat Lengkap</label><br>
                                            {{ $request->user_alamat }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Jenis Kelamin</label><br>
                                                {{ $request->gender }}
                                            </p>
                                        @else
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="form-control" name="gender" id="gender">
                                                @foreach ($listJK as $item)
                                                    <option {{ ($item->id_gender) == $request->id_jenkel ? 'selected' : ''}} value="{{ $item->id_gender }}">{{ $item->gender }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Tempat Lahir</label><br>
                                                {{ $request->tmp_lahir }}
                                            </p>
                                        @else
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" value="{{ $request->tmp_lahir }}">
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Tanggal Lahir</label><br>
                                                {{ DateFormatHelper::dateIn($request->tgl_lahir) }}
                                            </p>
                                        @else
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ $request->tgl_lahir }}" >
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Agama</label><br>
                                                {{ $request->religion }}
                                            </p>
                                        @else
                                            <label class="form-label">Agama</label>
                                            <select class="form-control" name="religion" id="religion">
                                                @foreach ($listReligion as $items)
                                                    <option {{ ($items->id_religion) == $request->id_agama ? 'selected' : ''}} value="{{ $items->id_religion }}">{{ $items->religion }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Pekerjaan</label><br>
                                                {{ $request->pekerjaan }}
                                            </p>
                                        @else
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ $request->pekerjaan }}" >
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-service" role="tabpanel" aria-labelledby="pills-profile-tab"
                                tabindex="0">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5 class="text-dark">Informasi Surat Pengantar</h5>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Nomor Surat Pengantar</label><br>
                                                {{ $request->no_surat_pengantar }}
                                            </p>
                                        @else
                                            <label class="form-label">No Surat Pengantar</label>
                                            <input type="text" class="form-control" name="no_surat_pengantar" id="no_surat_pengantar" value="{{ $request->no_surat_pengantar }}" >
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Tanggal Surat Pengantar</label><br>
                                                {{ DateFormatHelper::dateIn($request->tgl_surat_pengantar) }}
                                            </p>
                                        @else
                                            <label class="form-label">Tanggal Surat Pengantar</label>
                                            <input type="date" class="form-control" name="tgl_surat_pengantar" id="tgl_surat_pengantar" value="{{ $request->tgl_surat_pengantar }}" >
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Rukun Tetangga (RT)</label><br>
                                                {{ $request->rt }}
                                            </p>
                                        @else
                                            <label class="form-label">Rukun Tetangga (RT)</label>
                                            <input type="text" class="form-control" name="rt" id="rt" value="{{ $request->rt }}" >
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Rukun Warga (RW)</label><br>
                                                {{ $request->rw }}
                                            </p>
                                        @else
                                            <label class="form-label">Rukun Warga (RW)</label>
                                            <input type="text" class="form-control" name="rw" id="rw" value="{{ $request->rw }}" >
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <label class="form-label">Kelurahan</label><br>
                                            {{ $request->sub_district }}
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-pasien" role="tabpanel" aria-labelledby="pills-pasien-tab"
                                tabindex="0">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5 class="text-dark">Informasi Pasien</h5>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Untuk keperluan diri sendiri</label><br>
                                            {{ $request_detail->peruntukan == 1 ? 'Ya' : 'Tidak' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED') --}}
                                            <p>
                                                <label class="form-label">Nama Pasien</label><br>
                                                {{ isset ($request_detail->nama_pasien) ? $request_detail->nama_pasien : null }}
                                            </p>
                                        {{-- @else
                                            <label class="form-label">Nama Pasien</label>
                                            <input class="form-control" type="text" name="nama_pasien" id="nama_pasien" value="{{ $request_detail->nama_pasien }}" >
                                        @endif --}}
                                    </div>

                                    <div class="col-md-6">
                                        <p>
                                            <label class="form-label">No Jamkesmas</label><br>
                                            {{ isset ($request_detail->no_jamkesmas) ? $request_detail->no_jamkesmas : '-' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Hubungan Keluarga</label><br>
                                                {{ isset ($request_detail->nama_hub) ? $request_detail->nama_hub : null }}

                                            </p>
                                        @else
                                            <label class="form-label">Hubungan Keluarga</label>
                                            <select class="form-control" name="id_hub_kel" id="id_hub_kel">
                                                @foreach ($listHubKel as $item)
                                                    <option {{ ($item->id_hub) == $request_detail->id_hub_kel ? 'selected' : ''}} value="{{ $item->id_hub }}">{{ $item->nama_hub }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <p>
                                            <label class="form-label">Nomor KIP</label><br>
                                            {{ isset ($request_detail->no_kip) ? $request_detail->no_kip : '-' }}
                                        </p>
                                    </div> -->

                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Tanggal Lahir</label><br>
                                                {{ isset ($request_detail->tgl_lahir_pasien) ? DateFormatHelper::dateIn($request_detail->tgl_lahir_pasien) : null }}

                                            </p>
                                        @else
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir_pasien" id="tgl_lahir_pasien" value="{{ $request_detail->tgl_lahir_pasien }}" >
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Tempat Lahir</label><br>
                                                {{ isset ($request_detail->tmp_lahir_pasien) ? $request_detail->tmp_lahir_pasien : null }}

                                            </p>
                                        @else
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tmp_lahir_pasien" id="tmp_lahir_pasien" value="{{ $request_detail->tmp_lahir_pasien }}">
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-6">
                                        @if ($request->request_status_id == 'REJECTED_FINAL' || $request->request_status_id == 'REJECTED')
                                            <p>
                                                <label class="form-label">Nama Rumah Sakit</label><br>
                                                {{ isset ($request_detail->name) ? $request_detail->name : null }}
                                            </p>
                                        @else
                                            <label class="form-label">Rumah Sakit</label>
                                            <select class="form-control" name="id_rumkit" id="id_rumkit">
                                                @foreach ($listHospitals as $items)
                                                    <option {{ ($items->id_hospital) == $request_detail->id_rumkit ? 'selected' : ''}} value="{{ $items->id_hospital }}">{{ $items->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                            <div class="text-right mt-2">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-2 border-0 mb-2">
                <div class="card-body">
                    {{-- <h5 class="text-dark mb-1 text-center">Dokumen Hasil</h5> --}}
                    <p class="text-muted text-center">Dokumen hasil tanda tangan elektronik</p>

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
                    <div class="timeline-status" style="overflow-y: scroll;height: 130px;">

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
                                    @if($log->request_status_id == "REJECTED_FINAL" || $log->request_status_id == "REJECTED")
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

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card p-2 border-0">
                <div class="card-body">
                    <div class="row">
                        @foreach ($request_docs as $request_doc)
                            @if ($request_doc->request_attachment_note == 'FILE_KTP')
                                <div class="col-md-6">
                                    <label class="form-label">Kartu Tanda Penduduk (KTP) Pemohon</label><br>
                                    <embed src="/storage/files/request_sktm/ktp/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/ktp/276a216d0c89bb8f83b9eb62520b5a77.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">NIK</label><br>
                                                {{ $request->nik }}
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
                                        <div class="col-md-12">
                                            <p>
                                                <label class="form-label">Alamat Lengkap</label><br>
                                                {{ $request->user_alamat }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input id="check_file_ktp" type="checkbox" name="check_file_ktp" value="false"/>
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_RT_RW')
                                <div class="col-md-6">
                                    <label class="form-label">Surat Pengantar RT/RW</label><br>
                                    <embed src="/storage/files/request_sktm/pengantar_rt_rw/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/pengantar_rt_rw/0594fbba65401d1c9d9fb797fd6dc00a.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
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
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_rt_rw" id="check_file_rt_rw" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_KK')
                                <div class="col-md-6">
                                    <label class="form-label">Kartu Keluarga</label><br>
                                    <embed src="/storage/files/request_sktm/kk/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/kk/548eff2310c79d03c9dd10c75285d881.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">NIK</label><br>
                                                {{ $request->nik }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">No KK</label><br>
                                                {{ $request->no_kk }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">Nama Lengkap</label><br>
                                                {{ $request->nama_warga }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_kk" id="check_file_kk" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_PERNYATAAN')
                                <div class="col-md-6">
                                    <label class="form-label">Surat Pernyataan</label><br>
                                    <embed src="/storage/files/request_sktm/surat_pernyataan/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/surat_pernyataan/bc13e47d6f5e8d2f232a8f880cd9b248.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">NIK</label><br>
                                                {{ $request->nik }}
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
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_pernyataan" id="check_file_pernyataan" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_REKOMENDASI_SEKOLAH')
                                <div class="col-md-6">
                                    <label class="form-label">Surat Rekomendasi Sekolah</label><br>
                                    <embed src="/storage/files/request_sktm/rekom_sekolah/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                </div>
                                <div class="col-md-5"></div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_rekomendasi_sekolah" id="check_file_rekomendasi_sekolah" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_RUJUKAN_RS')
                                <div class="col-md-6">
                                    <label class="form-label">Surat Rujukan Rumah Sakit</label><br>
                                    <embed src="/storage/files/request_sktm/rujukan_rs/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/rujukan_rs/aaaeb4c21500d20d200b8ba9eef373d0.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
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
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">Hubungan Keluarga</label><br>
                                                {{ isset ($request_detail->nama_hub) ? $request_detail->nama_hub : null }}
    
                                            </p>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <p>
                                                <label class="form-label">Nama Rumah Sakit</label><br>
                                                {{ isset ($request_detail->name) ? $request_detail->name : null }}
    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_rujukan_rs" id="check_file_rujukan_rs" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @elseif ($request_doc->request_attachment_note == 'FILE_JAMKESMAS')
                                <div class="col-md-6">
                                    <label class="form-label">Jamkesmas</label><br>
                                    <embed src="/storage/files/request_sktm/jamkesmas/{{ $request_doc->request_attachment_file }}" class="w-100" width="" height="300" type="application/pdf">
                                    {{-- <embed src="{{ url('https://lapakami.cimahikota.go.id/backend/tidak-mampu-rs/pdf/pengantar_rt_rw/0594fbba65401d1c9d9fb797fd6dc00a.jpg') }}" class="w-100" width="" height="300" type="application/pdf"> --}}
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label"></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>
                                                <label class="form-label">No Jamkesmas</label><br>
                                                {{ $request_detail->no_jamkesmas }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <label class="form-label">Nama Lengkap</label><br>
                                                {{ $request->nama_warga }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <label class="form-label">Jenis Kelamin</label><br>
                                                {{ $request->gender }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <label class="form-label">Tempat Lahir</label><br>
                                                {{ $request->tmp_lahir }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <label class="form-label">Tanggal Lahir</label><br>
                                                {{ DateFormatHelper::dateIn($request->tgl_lahir) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($request->request_status_id != 'REJECTED_FINAL' && $request->request_status_id != 'REJECTED')
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                            <input type="checkbox" name="check_file_jamkesmas" id="check_file_jamkesmas" value="false">
                                            <label for=""></label>
                                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                            <defs>
                                            <filter id="goo-12">
                                                <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                                <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            @endif
                            <hr class="mt-2" style="border-top: 2px solid rgba(0, 0, 0, 0.3);">
                        @endforeach
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="modal-title">Preview Surat</div>
                                </div>
                                <div class="card-body">
                                    <embed src="{{ url('operator/sktm/pdf/'. $request->request_id .'/sktm') }}" class="w-100" width="" height="500" type="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="modal-title">Daftar Verifikator</div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Urutan</th>
                                                <th>Pegawai</th>
                                                <th>Unit Kerja / Instansi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listVerifikator as $listVer)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $listVer->nama }} {{ $listVer->jabatan }}</td>
                                                    <td>Kelurahan {{ $listVer->unit_kel }}</td>
                                                    <td>...</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="modal-title">Daftar Penandatangan</div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Urutan</th>
                                                <th>Pegawai</th>
                                                <th>Unit Kerja / Instansi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listTTE as $list_tte)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $list_tte->nama }} {{ $list_tte->jabatan }}</td>
                                                    <td>Kelurahan Cibeber</td>
                                                    <td>...</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end" id="div_btn">
                            
                        </div>
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

    <div class="modal fade" id="modalPDF" tabindex="-1" aria-labelledby="modalPDFLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">{{ $request->service_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed src="{{ url('operator/sktm/pdf/'. $request->request_id .'/sktm') }}" class="w-100" width="" height="500" type="application/pdf">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <a type="button" class="btn btn-primary" href="{{ url('backend/'. $request->slug_simkel .'/besign-pdf/'. $request->request_file) }}" download>Unduh</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Tolak Permohonan {{ $request->service_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/operator/sktm/tolak/'.$request->request_id) }}" id="formTolak" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Tulis Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" >Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTangguhkan" tabindex="-1" aria-labelledby="modalTangguhkanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Tangguhkan Permohonan {{ $request->service_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/operator/sktm/tangguhkan/'.$request->request_id) }}" id="formTangguhkan" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label class="form-label">Tulis Keterangan</label>
                                <textarea class="form-control" name="keteranganTangguhkan" id="keteranganTangguhkan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" >Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('script')
    <script type="text/javascript">
        $("#formTolak").validate({
            rules: {
                keterangan: {
                    required: true
                },
            },
            messages: {
                keterangan: {
                    required: "Keterangan tidak boleh kosong"
                },
            },
            errorElement: "em",
            errorClass: "invalid-feedback",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                $(element).parents('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });

        $("#formTangguhkan").validate({
            rules: {
                keteranganTangguhkan: {
                    required: true
                },
            },
            messages: {
                keteranganTangguhkan: {
                    required: "Keterangan tidak boleh kosong"
                },
            },
            errorElement: "em",
            errorClass: "invalid-feedback",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                $(element).parents('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });

        $("#formUbah").validate({
            rules: {
                no_surat_pengantar : {
                    required: true
                },
                tgl_surat_pengantar : {
                    required: true
                },
                gender : {
                    required: true
                },
                tmp_lahir : {
                    required: true
                },
                tgl_lahir : {
                    required: true
                },
                religion : {
                    required: true
                },
                pekerjaan : {
                    required: true
                },
                rt : {
                    required: true,
                    number: true,
                    minlength: 3,
                    maxlength: 3
                },
                rw : {
                    required: true,
                    number: true,
                    minlength: 3,
                    maxlength: 3
                },
            },
            messages: {
                no_surat_pengantar : {
                    required: "No Surat Pengantar tidak boleh kosong"
                },
                tgl_surat_pengantar : {
                    required: "tgl surat pengantar tidak boleh kosong"
                },
                gender : {
                    required: "Jenis Kelamin tidak boleh kosong"
                },
                tmp_lahir : {
                    required: "Tempat lahir tidak boleh kosong"
                },
                tgl_lahir : {
                    required: "Tanggal Lahir tidak boleh kosong"
                },
                religion : {
                    required: "Agama tidak boleh kosong"
                },
                pekerjaan : {
                    required: "Pekerjaan tidak boleh kosong"
                },
                rt : {
                    required: "RT tidak boleh kosong",
                    number : "RT harus diisi angka",
                    minlength : "RT harus 3 angka",
                    maxlength : "RT harus 3 angka",
                },
                rw : {
                    required: "RW tidak boleh kosong",
                    number : "RW harus diisi angka",
                    minlength : "RW harus 3 angka",
                    maxlength : "RW harus 3 angka",
                },
            },
            errorElement: "em",
            errorClass: "invalid-feedback",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                $(element).parents('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    </script>
    <script type="text/javascript">
        var jmlhDocs = '{{ count($request_docs) }}';
        let jmlhCeklis = 0;
        var id = '{{ $request->request_id }}';
        var status = '{{ $request->request_status_id }}';

        if (status === 'PROCCESS' || status === 'PROCCESS_KEC') {
            jmlhCeklis = jmlhDocs;
            setChecklist('check_file_ktp');
            setChecklist('check_file_rt_rw');
            setChecklist('check_file_kk');
            setChecklist('check_file_pernyataan');
            setChecklist('check_file_rekomendasi_sekolah');
            setChecklist('check_file_rujukan_rs');
            setChecklist('check_file_jamkesmas');
            setButton();
        }

        function setChecklist(id) {
            var element = document.getElementById(id);
            if (element !== null) {
                $("#".id).attr('value', 'true');
                document.getElementById(id).checked = true;
            }
        }

        $("#check_file_ktp").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_rt_rw").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_kk").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_pernyataan").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_rekomendasi_sekolah").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_rujukan_rs").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        $("#check_file_jamkesmas").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
                jmlhCeklis++;
            } else {
                $(this).attr('value', 'false');
                if (jmlhCeklis != 0) {
                    jmlhCeklis--;
                }
            }
            setButton();
            console.log(jmlhDocs+' = '+jmlhCeklis);
        });

        function setButton() {
            if (jmlhCeklis == jmlhDocs) {
                // hide tombol tolak dan tnagguhkan
                // show tombol sesuai
                if (status === 'PROCCESS_KEC' || status === 'PROCCESS') {
                    document.getElementById('div_btn').innerHTML = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPDF" id="btn_preview">Preview</button>';
                } else {
                    document.getElementById('div_btn').innerHTML = '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPDF" id="btn_preview">Preview</button>&nbsp;&nbsp;<a href="/operator/sktm/sesuai/'+id+'" ><button class="btn btn-primary" id="btn_sesuai">Sesuai</button></a>';
                }
            } else {
                // show tombol tolak dan tnagguhkan
                // hode tombol sesuai
                document.getElementById('div_btn').innerHTML = "<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalTolak' id='btn_tolak'>Tolak</button>&nbsp;&nbsp;<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalTangguhkan' id='btn_tangguhkan'>Tangguhkan</button>";
            }
        }

    </script>
@endsection

<style>
    /* For Desktop View */
    @media screen and (min-width: 1024px) {
        .checkbox-wrapper-12 {
            margin-top: 130px;
        }
    }

    /* For Tablet View */
    @media screen and (min-device-width: 768px) 
        and (max-device-width: 1024px) {
        .checkbox-wrapper-12 {
            margin-top: 130px;
        }
    }

  .checkbox-wrapper-12 {
    position: relative;
  }
  .checkbox-wrapper-12 > svg {
    position: absolute;
    top: -130%;
    left: -170%;
    width: 110px;
    pointer-events: none;
  }
  .checkbox-wrapper-12 * {
    box-sizing: border-box;
  }
  .checkbox-wrapper-12 input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-tap-highlight-color: transparent;
    cursor: pointer;
    margin: 0;
  }
  .checkbox-wrapper-12 input[type="checkbox"]:focus {
    outline: 0;
  }
  .checkbox-wrapper-12 .cbx {
    width: 24px;
    height: 24px;
    top: calc(50vh - 12px);
    left: calc(50vw - 12px);
  }
  .checkbox-wrapper-12 .cbx input {
    position: absolute;
    top: 0;
    left: 0;
    width: 24px;
    height: 24px;
    border: 2px solid #bfbfc0;
    border-radius: 50%;
  }
  .checkbox-wrapper-12 .cbx label {
    width: 24px;
    height: 24px;
    background: none;
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-filter: url("#goo-12");
    filter: url("#goo-12");
    transform: trasnlate3d(0, 0, 0);
    pointer-events: none;
  }
  .checkbox-wrapper-12 .cbx svg {
    position: absolute;
    top: 5px;
    left: 4px;
    z-index: 1;
    pointer-events: none;
  }
  .checkbox-wrapper-12 .cbx svg path {
    stroke: #fff;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 19;
    stroke-dashoffset: 19;
    transition: stroke-dashoffset 0.3s ease;
    transition-delay: 0.2s;
  }
  .checkbox-wrapper-12 .cbx input:checked + label {
    animation: splash-12 0.6s ease forwards;
  }
  .checkbox-wrapper-12 .cbx input:checked + label + svg path {
    stroke-dashoffset: 0;
  }
  @-moz-keyframes splash-12 {
    40% {
      background: #4285f4;
      box-shadow: 0 -18px 0 -8px #4285f4, 16px -8px 0 -8px #4285f4, 16px 8px 0 -8px #4285f4, 0 18px 0 -8px #4285f4, -16px 8px 0 -8px #4285f4, -16px -8px 0 -8px #4285f4;
    }
    100% {
      background: #4285f4;
      box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
    }
  }
  @-webkit-keyframes splash-12 {
    40% {
      background: #4285f4;
      box-shadow: 0 -18px 0 -8px #4285f4, 16px -8px 0 -8px #4285f4, 16px 8px 0 -8px #4285f4, 0 18px 0 -8px #4285f4, -16px 8px 0 -8px #4285f4, -16px -8px 0 -8px #4285f4;
    }
    100% {
      background: #4285f4;
      box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
    }
  }
  @-o-keyframes splash-12 {
    40% {
      background: #4285f4;
      box-shadow: 0 -18px 0 -8px #4285f4, 16px -8px 0 -8px #4285f4, 16px 8px 0 -8px #4285f4, 0 18px 0 -8px #4285f4, -16px 8px 0 -8px #4285f4, -16px -8px 0 -8px #4285f4;
    }
    100% {
      background: #4285f4;
      box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
    }
  }
  @keyframes splash-12 {
    40% {
      background: #4285f4;
      box-shadow: 0 -18px 0 -8px #4285f4, 16px -8px 0 -8px #4285f4, 16px 8px 0 -8px #4285f4, 0 18px 0 -8px #4285f4, -16px 8px 0 -8px #4285f4, -16px -8px 0 -8px #4285f4;
    }
    100% {
      background: #4285f4;
      box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
    }
  }
</style>
