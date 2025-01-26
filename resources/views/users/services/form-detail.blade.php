@extends('layouts.useradmin')

@section('title')
Form Detail
@endsection

@section('content')
<div class="container py-5">
  <a href="{{ url('user/admin') }}" class="btn btn-primary mb-3">Kembali</a>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Form Detail</h2>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">

      <form action="{{ url('user/services/form-detail') }}" method="POST">
        @csrf

        <h5 class="card-title">Layanan</h5>

        <div class="col-md-6 mb-3">
          <label for="No_Surat" class="form-label">Nomor Surat</label>
          <input type="text" class="form-control" id="No_Surat" name="No_Surat" value="{{ $no_surat }}"
            placeholder="Masukkan Nomor Surat" required readonly>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="namaLayanan" class="form-label">Nama Layanan</label>
            <select class="form-select" id="namaLayanan" name="Nama_Layanan" required>
              <option value="">Pilih Layanan</option>
              @foreach ($data_layanan as $fal)
              <option value="{{ $fal->service_id }}">{{ $fal->service_name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <h5 class="card-title">Setting Kelurahan</h5>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="namakelurahan" class="form-label">Nama Kelurahan</label>
            <select class="form-select" id="namakelurahan" name="Kelurahan" required>
              <option value="">Pilih Nama Kelurahan</option>
              @foreach ($data_nama_kelurahan as $fal)
              <option value="{{ $fal->sub_district }}">{{ $fal->sub_district }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="verifikatorKelurahan" class="form-label">Verifikator Kelurahan</label>
            <select class="form-select" id="verifikatorKelurahan" name="Nama_verification_kelurahan" required>
              <option value="">Pilih Verifikator</option>
              @foreach ($data_verifikator_kelurahan as $fal)
              <option value="{{ $fal->user_nip }}">{{ $fal->user_nip . ' - ' . $fal->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label for="ttdKelurahan" class="form-label">Tanda Tangan Kelurahan</label>
            <select class="form-select" id="ttdKelurahan" name="Nama_Penandatangan_kelurahan" required>
              <option value="">Pilih Penandatangan</option>
              @foreach ($data_verifikator_kelurahan as $fal)
              <option value="{{ $fal->user_id }}">{{ $fal->user_nip . ' - ' . $fal->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <h5 class="card-title">Setting Kecamatan</h5>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="namakecamatan" class="form-label">Nama Kecamatan</label>
            <select class="form-select" id="namakecamatan" name="Kecamatan" required>
              <option value="">Pilih Nama Kecamatan</option>
              @foreach ($data_nama_kecamatan as $fal)
              <option value="{{ $fal->district }}">{{ $fal->district }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="verifikatorKecamatan" class="form-label">Verifikator Kecamatan</label>
            <select class="form-select" id="verifikatorKecamatan" name="Nama_Verification_kecamatan" required>
              <option value="">Pilih Verifikator</option>
              @foreach ($data_verifikator_kecamatan as $fal)
              <option value="{{ $fal->user_nip }}">{{ $fal->user_nip . ' - ' . $fal->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label for="ttdKecamatan" class="form-label">Tanda Tangan Kecamatan</label>
            <select class="form-select" id="ttdKecamatan" name="Nama_Penandatangan_kecamatan" required>
              <option value="">Pilih Penandatangan</option>
              @foreach ($data_verifikator_kecamatan as $fal)
              <option value="{{ $fal->user_id }}">{{ $fal->user_nip . ' - ' . $fal->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>

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