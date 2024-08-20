@extends('layouts.user')

@section('title')
Verification Permohonan
@endsection

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Verification Permohonan</h1>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <label for="nomorSurat" class="form-label">Nomor Surat:</label>
            <input type="text" id="nomorSurat" class="form-control" value="{{ $nomor_surat }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label for="layanan" class="form-label">Layanan:</label>
            <input type="text" id="layanan" class="form-control" value="{{ $layanan }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tanggalSurat" class="form-label">Tanggal Surat:</label>
            <input type="text" id="tanggalSurat" class="form-control" value="{{ $tanggal_surat }}" readonly>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="mt-4">Preview PDF</h5>
        <!-- <embed src="{{ url('https://drive.cimahikota.go.id/s/pSS7BQ2YTsfe3Wy')}}" type="application/pdf" width="100%" height="600px" /> -->
        <embed src="{{ asset('assets/files/632d1bfd-66e6-4b03-8f48-7e60d696b66f_signed.pdf') }}" class="w-100" width="" height="500" type="application/pdf">
    </div>
</div>
@endsection