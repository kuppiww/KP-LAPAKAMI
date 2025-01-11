@extends('layouts.user')

@section('title') Form Detail @endsection

@section('content')

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Form Detail</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ url('user/form-detail/submit') }}" method="POST">
                @csrf

                <!-- Nama Layanan -->
                <h5 class="card-title">Layanan</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namaLayanan" class="form-label">Nama Layanan</label>
                        <select class="form-select" id="namaLayanan" name="Nama_Layanan" required>
                            <option value="">Pilih Layanan</option>
                            @foreach($data_layanan as $fal)
                            <option value="{{ $fal->service_id }}">{{ $fal->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Setting Kelurahan -->
                <h5 class="card-title">Setting Kelurahan</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namakelurahan" class="form-label">Nama Kelurahan</label>
                        <select class="form-select" id="namakelurahan" name="Kelurahan" required>
                            <option value="">Pilih Nama Kelurahan</option>
                            @foreach($data_nama_kelurahan as $fal)
                            <option value="{{ $fal->sub_district }}">{{ $fal->sub_district }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="verifikatorKelurahan" class="form-label">Verifikator Kelurahan</label>
                        <div class="dropdown w-100">
                            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="verifikatorKelurahanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Verifikator
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="verifikatorKelurahanDropdown">
                                @foreach($data_verifikator_kelurahan as $fal)
                                <div class="dropdown-item">
                                    <input type="checkbox" name="Nama_verification_kelurahan[]" value="{{ $fal->user_nip }}" id="verifikatorKelurahan{{ $loop->index }}" class="form-check-input me-2">
                                    <label for="verifikatorKelurahan{{ $loop->index }}" class="form-check-label">{{ $fal->user_nip.' - '.$fal->nama }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="ttdKelurahan" class="form-label">Tanda Tangan Kelurahan</label>
                        <select class="form-select" id="ttdKelurahan" name="Nama_Penandatangan_kelurahan" required>
                            <option value="">Pilih Penandatangan</option>
                            @foreach($data_verifikator_kelurahan as $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Setting Kecamatan -->
                <h5 class="card-title">Setting Kecamatan</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namakecamatan" class="form-label">Nama Kecamatan</label>
                        <select class="form-select" id="namakecamatan" name="Kecamatan" required>
                            <option value="">Pilih Nama Kecamatan</option>
                            @foreach($data_nama_kecamatan as $fal)
                            <option value="{{ $fal->district }}">{{ $fal->district }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="verifikatorKecamatan" class="form-label">Verifikator Kecamatan</label>
                        <div class="dropdown w-100">
                            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="verifikatorKecamatanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Verifikator
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="verifikatorKecamatanDropdown">
                                @foreach($data_verifikator_kecamatan as $fal)
                                <div class="dropdown-item">
                                    <input type="checkbox" name="Nama_Verification_kecamatan[]" value="{{ $fal->user_nip }}" id="verifikatorKecamatan{{ $loop->index }}" class="form-check-input me-2">
                                    <label for="verifikatorKecamatan{{ $loop->index }}" class="form-check-label">{{ $fal->user_nip.' - '.$fal->nama }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="ttdKecamatan" class="form-label">Tanda Tangan Kecamatan</label>
                        <select class="form-select" id="ttdKecamatan" name="Nama_Penandatangan_kecamatan" required>
                            <option value="">Pilih Penandatangan</option>
                            @foreach($data_verifikator_kecamatan as $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="No_Surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="No_Surat" name="No_Surat" placeholder="Masukkan Nomor Surat" required>
                    </div>
                </div>

                <!-- Button Submit -->
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection