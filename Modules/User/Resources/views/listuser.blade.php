@extends('layouts.user')
@section('title')
    Pengaturan Akun Masyarakat
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
            <h4 class="text-dark fw-bold mb-0">Pengaturan Akun Masyarakat</h4>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK dan Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->user_username }} <br>
                                <small class="text-muted">{{ $item->user_nama }}</small>
                            </td>
                            <td>
                                {{ $item->user_email }}
                            </td>
                            <td valign="middle">
                                <span class="badge bg-{{ ($item->user_is_active) ? 'success' : 'danger' }}">{{ ($item->user_is_active) ? 'Aktif' : 'Tidak AKtif' }}</span>
                            </td>
                            <td>
                                <a href="{{ url('user/setting/password') . '/' . $item->user_id }}"
                                    class="btn btn-icon btn-light rounded-circle p-1"><i
                                        class="ri-lock-line fs-6"></i></a>
                                <a href="{{ url('user/setting/email') . '/' . $item->user_id }}"
                                    class="btn btn-icon btn-light rounded-circle p-1"><i
                                        class="ri-mail-line fs-6"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        
    </script>
@endsection

