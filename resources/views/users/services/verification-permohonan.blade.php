@extends('layouts.user')

@section('title')
Verification Permohonan
@endsection

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Verification Permohonan</h1>

    <div class="card bg-white mb-4">
        <div class="card-body">
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
                <embed src="{{ asset('assets/files/632d1bfd-66e6-4b03-8f48-7e60d696b66f_signed.pdf') }}" class="w-100" width="" height="500" type="application/pdf">
            </div>
        </div>
    </div>

    <!-- Tabel Verification -->
    <div class="card bg-white mb-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Tabel Verification</h5>
            <a href="{{ url('user/verification-permohonan/add') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Instansi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($verifications as $index => $verification)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $verification->pegawai }}</td>
                        <td>{{ $verification->instansi }}</td>
                        <td>
                            @if($verification->status == 'tolak')
                            <span class="badge bg-danger">Tolak</span>
                            @elseif($verification->status == 'belum')
                            <span class="badge bg-secondary">Belum</span>
                            @elseif($verification->status == 'setuju')
                            <span class="badge bg-success">Setuju</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ url('user/verification-permohonan/delete/' . $verification->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Penandatangan Elektronik (TTE) -->
    <div class="card bg-white mb-4">
        <div class="card-header">
            <h5>Tabel Penandatangan Elektronik (TTE)</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Instansi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tte as $index => $penandatangan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penandatangan->pegawai }}</td>
                        <td>{{ $penandatangan->instansi }}</td>
                        <td>
                            @if($penandatangan->status == 'tolak')
                            <span class="badge bg-danger">Tolak</span>
                            @elseif($penandatangan->status == 'belum')
                            <span class="badge bg-secondary">Belum</span>
                            @elseif($penandatangan->status == 'setuju')
                            <span class="badge bg-success">Setuju</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Histori Status -->
    <div class="card bg-white mb-4">
        <div class="card-header">
            <h5>Histori Status</h5>
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
                <li class="d-flex align-items-start mb-3">
                    <span class="me-2">
                        <i class="ri-record-circle-fill fs-6 text-primary"></i>
                    </span>
                    <div>
                        <strong>Senin, 19 Desember 2024</strong>
                        <p>Penandatangan TTE</p>
                        <p class="mb-0">
                            <strong>Detail Penandatangan:</strong> Nama: Budi Santoso, NIP: 1234567890
                        </p>
                    </div>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <span class="me-2">
                        <i class="ri-record-circle-fill fs-6 text-secondary"></i>
                    </span>
                    <div>
                        <strong>Selasa, 22 September 2024</strong>
                        <p>Paraf 1</p>
                        <p class="mb-0">
                            <strong>Detail:</strong> Nama: Joko Widodo, Jabatan: Presiden, Instansi: Pemerintah
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection