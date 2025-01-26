@extends('layouts.useradmin')
@section('title')
  Beranda Admin
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


  <div class="row mt-4">
    <div class="col-md-8">

      <div class="card border-0 p-1 mb-3">
        <div class="card-body">

          <h5 class="text-dark fw-bold mb-3">Permohonan Layanan Terbaru</h5>

          <table id="table-datas" class="table dt-responsive nowrap w-100 permohonan-table">
            <thead>
              <tr>
                <th>Layanan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            @if (sizeof($requests) == 0)
              <tr>
                <td colspan="2" align="center"><small class="text-muted">Belum ada pengajuan baru</small></td>
              </tr>
            @else
              <tbody>
                @foreach ($requests as $request)
                  <tr>
                    <td>
                      <p class="text-dark">{{ $request->service_name }}
                        <br>
                        <small class="text-muted">{{ DateFormatHelper::dateInFull($request->created_at) }}</small>
                      </p>
                    </td>
                    <td valign="middle">
                      <span
                        class="badge bg-{{ $request->request_status_color }}">{{ $request->request_status_name }}</span>
                    </td>
                    <td>
                      <a href="{{ url('user/services/form-detail') . '/' . $request->request_id }}"
                        class="btn btn-icon btn-light rounded-circle p-1"><i class="ri-arrow-right-line fs-6"></i></a>
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
