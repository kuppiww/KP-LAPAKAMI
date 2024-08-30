@extends('layouts.user')

@section('title') Form Detail @endsection

@section('content')
<div class="container py-5">
    <h2>Form Detail</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ url('user/form-detail/submit') }}" method="POST">
                @csrf

                <!-- Nama Layanan -->
                <h5 class="card-title">Layanan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaLayanan" class="form-label">Nama Layanan</label>
                        <select class="form-select" id="namaLayanan" name="nama_layanan" required>
                            <option value="">Pilih Layanan</option>
                            @foreach($data_layanan as $key => $fal)
                            <option value="{{ $fal->service_id }}">{{ $fal->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Setting Kelurahan -->
                <h5 class="card-title">Setting Kelurahan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaKelurahan" class="form-label">Nama Kelurahan</label>
                        <input type="text" class="form-control" id="namaKelurahan" name="nama_kelurahan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKelurahan" class="form-label">Verifikator Kelurahan</label>
                        <div class="dropdown" style="width: 100%;">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="verifikatorKelurahanDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                                Pilih Verifikator
                            </button>
                            <div class="dropdown-menu" aria-labelledby="verifikatorKelurahanDropdown" style="width: 100%;">
                                @foreach($data_verifikator_kelurahan as $key => $fal)
                                <div class="dropdown-item">
                                    <input type="checkbox" name="verifikator_kelurahan[]" value="{{ $fal->user_nip }}" id="verifikatorKelurahan{{ $key }}" class="form-check-input me-2">
                                    <label for="verifikatorKelurahan{{ $key }}" class="form-check-label">{{ $fal->user_nip.' - '.$fal->nama }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ttdKelurahan" class="form-label">Tanda Tangan Kelurahan</label>
                        <select class="form-select" id="ttdKelurahan" name="ttd_kelurahan" required>
                            <option value="">Pilih Penandatangan</option>
                            @foreach($data_verifikator_kelurahan as $key => $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Setting Kecamatan -->
                <h5 class="card-title">Setting Kecamatan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaKecamatan" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" id="namaKecamatan" name="nama_kecamatan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKecamatan" class="form-label">Verifikator Kecamatan</label>
                        <div class="dropdown" style="width: 100%;">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="verifikatorKecamatanDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                                Pilih Verifikator
                            </button>
                            <div class="dropdown-menu" aria-labelledby="verifikatorKecamatanDropdown" style="width: 100%;">
                                @foreach($data_verifikator_kecamatan as $key => $fal)
                                <div class="dropdown-item">
                                    <input type="checkbox" name="verifikator_kecamatan[]" value="{{ $fal->user_nip }}" id="verifikatorKecamatan{{ $key }}" class="form-check-input me-2">
                                    <label for="verifikatorKecamatan{{ $key }}" class="form-check-label">{{ $fal->user_nip.' - '.$fal->nama }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ttdKecamatan" class="form-label">Tanda Tangan Kecamatan</label>
                        <select class="form-select" id="ttdKecamatan" name="ttd_kecamatan" required>
                            <option value="">Pilih Penandatangan</option>
                            @foreach($data_verifikator_kecamatan as $key => $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
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