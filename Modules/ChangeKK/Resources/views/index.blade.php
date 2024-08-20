@extends('layouts.useradmin')
@section('title')
    Ubah Kartu Keluarga
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
            <h4 class="text-dark fw-bold mb-0">Permohonan Ubah Nomor KK</h4>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">
            <table id="table-datas" class="table dt-responsive nowrap w-100 kk-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Nomor Kartu Keluarga</th>
                        <th>Lampiran KK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('.kk-table').DataTable({
                language: {
                    "url": "{{ url('assets/json/datatable-id.json') }}",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                searchable:true,
                ajax: "{!! route('kk.list') !!}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_nik', name: 'user_nik'},
                    {data: 'kk_baru', name: 'kk_baru'},
                    {data: 'kk_file', name: 'kk_file'},
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endsection