@extends('layouts.user')

@section('title') Form Detail @endsection

@section('content')
<div class="container py-5">
    <h2>Form Detail</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ url('user/form-detail/submit') }}" method="POST">
                @csrf

                <h5 class="card-title">Setting Kelurahan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaLayanan" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="namaLayanan" name="nama_layanan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="namaKelurahan" class="form-label">Nama Kelurahan</label>
                        <input type="text" class="form-control" id="namaKelurahan" name="nama_kelurahan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="namaKecamatan" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" id="namaKecamatan" name="nama_kecamatan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKelurahan" class="form-label">Verifikator</label>
                        <select class="form-select" id="verifikatorKelurahan" name="verifikator_kelurahan">
                            <option selected>Pilih Verifikator</option>
                            <option value="1">Verifikator 1</option>
                            <option value="2">Verifikator 2</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ttdKelurahan" class="form-label">Tanda Tangan</label>
                        <select class="form-select" id="ttdKelurahan" name="ttd_kelurahan">
                            <option selected>Pilih Tanda Tangan</option>
                            <option value="1">Tanda Tangan 1</option>
                            <option value="2">Tanda Tangan 2</option>
                        </select>
                    </div>
                </div>

                <h5 class="card-title">Setting Kecamatan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="verifikatorKecamatan" class="form-label">Verifikator</label>
                        <select class="form-select" id="verifikatorKecamatan" name="verifikator_kecamatan">
                            <option selected>Pilih Verifikator</option>
                            <option value="1">Verifikator 1</option>
                            <option value="2">Verifikator 2</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ttdKecamatan" class="form-label">Tanda Tangan</label>
                        <select class="form-select" id="ttdKecamatan" name="ttd_kecamatan">
                            <option selected>Pilih Tanda Tangan</option>
                            <option value="1">Tanda Tangan 1</option>
                            <option value="2">Tanda Tangan 2</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
