@extends('layouts.monitoring')
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
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Warga</th>
                        <th width="15%">Permohonan</th>
                        <th width="15%">Status</th>
                    </tr>
                </thead>
                <tbody>

                    @if (sizeof($services) == 0)
                        <tr>
                            <td align="center" class="text-muted" colspan="5">Tidak ada data tersedia</td>
                        </tr>
                    @else
                        @foreach ($services as $service)
                        @if($service->request_status_id === 'APPROVED' || $service->request_status_id === 'APPROVED_KEC')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td valign="middle">
                                    <ul>
                                        <li>Nama : <b>{{ $service->nama_warga }}</b></li>
                                        <li>Kelurahan : <b>{{ $service->sub_district }}</b></li>
                                    </ul>
                                </td>
                                <td>
                                
                                    <ul>
                                        <li>Permintaan : <b>{{ $service->service_name }}</b></li>
                                        <li>Waktu Pengajuan: <b>{{ date("d M Y H:i:s", strtotime($service->created_at)) }}</b></li>
                                            @php
                                                // Timestamp dari database
                                                $created_at = $service->created_at;
                                                $updated_at = $service->updated_at;

                                                // Mengonversi timestamp menjadi instance Carbon
                                                $created_time = \Carbon\Carbon::parse($created_at);
                                                $updated_time = \Carbon\Carbon::parse($updated_at);

                                                // Menghitung selisih waktu dalam jam
                                                $hours_difference = $updated_time->diffInHours($created_time);
                                                $minutes_difference = $updated_time->diffInMinutes($created_time);

                                            @endphp
                                            
                                            <li>Waktu Selesai: <b>{{ date("d M Y H:i:s", strtotime($service->updated_at)) }}</b> (terselesaikan dalam 
                                                @if($hours_difference == 0)
                                                    {{$minutes_difference}} menit)
                                                @else
                                                    {{$hours_difference}} jam)
                                                @endif
                                            
                                            </li>
                                    </ul>
                                
                                </td>
                                <td valign="middle">
                                    <span class="badge bg-{{ $service->request_status_color }}">{{ $service->request_status_name }}</span>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
