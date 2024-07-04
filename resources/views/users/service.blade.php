@extends('layouts.user')
@section('title')
    Layanan
@endsection

@section('content')
    @if (session('error'))
        <div class="alert bg-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert bg-success mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="text-dark fw-bold mb-0">Layanan</h4>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="ri-add-circle-line me-2"></i> Buat Permohonan</a>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Pemohon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            Surat Keterangan Keramaian <br>
                            <small class="text-muted">20 Januari 2023 10:00</small>
                        </td>
                        <td>
                            Yudi Permana<br>
                            <small class="text-muted">3277123456789012</small>
                        </td>
                        <td valign="middle">
                            <span class="badge bg-info">Pengajuan</span>
                        </td>
                        <td valign="middle">
                            <a href="{{ url('user/layanan/detail') }}" class="btn btn-icon btn-light rounded-circle p-1"><i
                                    class="ri-arrow-right-line fs-6"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            Surat Keterangan Kelahiran <br>
                            <small class="text-muted">20 Januari 2023 10:00</small>
                        </td>
                        <td>
                            Yudi Permana<br>
                            <small class="text-muted">3277123456789012</small>
                        </td>
                        <td valign="middle">
                            <span class="badge bg-success">Selesai</span>
                        </td>
                        <td>
                            <a href="{{ url('user/layanan/detail') }}" class="btn btn-icon btn-light rounded-circle p-1"><i
                                    class="ri-arrow-right-line fs-6"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Buat Permohonan Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('user/layanan/buat/penduduk') }}">
                    <div class="modal-body">
                        <p class="text-muted">Pilih layanan yang anda ajukan</p>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control form-select">
                                    <option>- Pilih Layanan -</option>
                                    <option value="">Surat Keterangan Penduduk</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Buat Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection
