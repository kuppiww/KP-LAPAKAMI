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
                    <div class="col-md-6 mb-3 form-gr">
                        <label for="namaLayanan" class="form-label">Nama Layanan</label>
                        <select class="form-select" id="namaLayanan" name="nama_layanan">
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
                        <input type="text" class="form-control" id="namaKelurahan" name="nama_kelurahan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKelurahan" class="form-label">Verifikator Kelurahan</label>
                        <select class="form-select" id="verifikatorKelurahan" name="verifikator_kelurahan">
                            <option value="">Pilih Verifikator</option>
                            @foreach($data_verifikator_kelurahan as $key => $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ttdKelurahan" class="form-label">Tanda Tangan Kelurahan</label>
                        <select class="form-select" id="ttdKelurahan" name="ttd_kelurahan">
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
                        <input type="text" class="form-control" id="namaKecamatan" name="nama_kecamatan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKecamatan" class="form-label">Verifikator Kecamatan</label>
                        <select class="form-select" id="verifikatorKecamatan" name="verifikator_kecamatan">
                            <option value="">Pilih Verifikator</option>
                            @foreach($data_verifikator_kecamatan as $key => $fal)
                            <option value="{{ $fal->user_id }}">{{ $fal->user_nip.' - '.$fal->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ttdKecamatan" class="form-label">Tanda Tangan Kecamatan</label>
                        <select class="form-select" id="ttdKecamatan" name="ttd_kecamatan">
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