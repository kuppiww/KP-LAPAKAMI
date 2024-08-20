@extends('layouts.useradmin')
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
            <h4 class="text-dark fw-bold mb-0">Permohonan</h4>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">
            <table id="table-datas" class="table dt-responsive nowrap w-100 permohonan-table">
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
                    {{-- @foreach ($requests as $request)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td>
                                {{ $request->service_name }} <br>
                                <small class="text-muted">{{ DateFormatHelper::dateInFull($request->created_at) }}</small>
                            </td>
                            <td>
                                {{ $request->nama_warga }}<br>
                                <small class="text-muted">{{ $request->nik }}</small>
                            </td>
                            <td valign="middle">
                                <span
                                    class="badge bg-{{ $request->request_status_color }}">{{ $request->request_status_name }}</span>
                            </td>
                            <td>
                                <a href="{{ url('user/layanan/detail') . '/' . $request->request_id . '/' . $request->service_id }}"
                                    class="btn btn-icon btn-light rounded-circle p-1"><i
                                        class="ri-arrow-right-line fs-6"></i></a>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Buat Permohonan Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addForm" action="{{ url('user/layanan/buat') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-muted">Pilih layanan yang anda ajukan</p>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control form-select" name="service_id">
                                    @if (sizeof($services) == 0)
                                        <option value="">- Belum Ada Layanan -</option>
                                    @else
                                        <option value="">- Pilih Layanan -</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->service_id }}" @if(!$service->is_active) disabled="disabled" @endif>
                                                {{ $service->service_name }}
                                            </option>
                                        @endforeach
                                    @endif
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
    </div> --}}
    <!-- End Modal -->
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('.permohonan-table').DataTable({
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
                ajax: "{!! route('permohonan.list') !!}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'service_name', name: 'service_name'},
                    {data: 'nama_warga', name: 'nama_warga'},
                    {data: 'request_status_name', name: 'request_status_name'},
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endsection