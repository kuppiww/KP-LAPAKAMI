@extends('layouts.user')
@section('title')
    Beranda
@endsection

@section('content')
    @if (session('error'))
        <div class="alert bg-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert bg-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (!$user->user_is_comp_profile)
        <div class="card border-0 p-2 bg-warning">
            <div class="card-body">
                <i class="ri-information-line float-start fs-2 me-3 text-white"></i>
                <h5 class="text-white fw-bold mb-1">Informasi</h5>
                <p class="mb-0 text-white">Untuk melakukan pengajuan layanan anda harus melengkapi profil anda terlebih
                    dahulu</p>
            </div>
        </div>
    @endif


    <div class="row mt-4">
        <div class="col-md-8">

            <div class="card border-0 p-1 mb-3">
                <div class="card-body">

                    <h5 class="text-dark fw-bold mb-3">Permohonan Layanan Terakhir</h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        @if (sizeof($requests) == 0)
                            <tr>
                                <td colspan="2" align="center"><small class="text-muted">Belum pernah mengajukan permohonan</small></td>
                            </tr>
                        @else
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>
                                            <a href="/user/layanan/detail/{{$request->request_id}}/{{ $request->service_id }}" class="text-dark">{{ $request->service_name }} </a><br>
                                            <small
                                                class="text-muted">{{ DateFormatHelper::dateInFull($request->created_at) }}</small>
                                        </td>

                                        <td valign="middle">
                                            <span
                                                class="badge bg-{{ $request->request_status_color }}">{{ $request->request_status_name }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>

                </div>
            </div>

            <!-- <a href="" class="btn btn-pri	mary w-100 rounded-pill">Buat Permohonan Baru</a> -->
        </div>
        <div class="col-md-4">

            <div class="card border-0 p-2">
                <div class="card-body">

                    <h5 class="text-dark fw-bold mb-3">Statistik Layanan</h5>

                    <div class="row mb-3">
                        <div class="col-9">
                            <p class="mb-0">Pengajuan</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="mb-0">{{ $counts['submitted'] }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-9">
                            <p class="mb-0">Verifikasi Berkas</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="mb-0">{{ $counts['verified'] }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-9">
                            <p class="mb-0">Pembuatan Dokumen</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="mb-0">{{ $counts['proccess'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <p class="mb-0">Selesai</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="mb-0">{{ $counts['approved'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
