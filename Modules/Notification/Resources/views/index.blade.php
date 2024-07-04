@extends('layouts.user')
@section('title')
    Pemberitahuan
@endsection
<?php use App\Helpers\DateFormatHelper; ?>


@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-12">
            <h4 class="text-dark fw-bold mb-0">Pemberitahuan</h4>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">
            @if(sizeof($notifications) == 0)
                <div class="notif-list">
                    <p class="text-muted mb-0 text-center">Tidak ada pemberitahuan tersedia</p>
                </div>
            @else
                @foreach ($notifications as $notification)
                    <div class="notif-list">
                        <p class="fw-semibold mb-0"><a href="/user/pemberitahuan/baca/{{ $notification->notification_id }}" class="@if($notification->notification_is_read) text-muted @else text-dark @endif">{{ $notification->service_name }}</a></p>
                        <p class="mb-0 @if($notification->notification_is_read) text-muted @endif">{{ $notification->notification_note }}</p>
                        <p class="mb-0"><small
                        class="text-muted">{{ DateFormatHelper::dateInFull($notification->created_at) }}</small></p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>


    <nav class="mt-4">
        <ul class="pagination justify-content-center ">

            @if(sizeof($notifications) > 0)
                @if($total_page > 5 || app('request')->input('page') == null || app('request')->input('page') == '1')
                    <li class="page-item"><a class="page-link" href=""><i class="ri-arrow-left-s-line"></i></a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}page={{ $paging-1 }}"><i class="ri-arrow-left-s-line"></i></a></li>
                @endif

                @for ($i = 1; $i <= $total_page; $i++)
                    <li class="page-item @if ($paging == $i) active @endif">
                        <a class="page-link" href="{{ $url }}page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor

                @if($total_page > 5)
                    <li class="page-item"><a class="page-link" href=""><i class="ri-arrow-right-s-line"></i></a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}page={{ $paging+1 }}"><i class="ri-arrow-right-s-line"></i></a></li>
                @endif
            @endif
    </nav>
@endsection
