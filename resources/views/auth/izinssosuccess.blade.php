@extends('layouts.authsso')
@section('title')
    Pendaftaran Berhasil
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
			@if (session('message'))
                <div class="alert bg-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
            <!-- Alert Success -->
            <div class="text-center">
                @if (session('message') != "Anda sudah pernah mendaftar, silahkan cek email untuk melakukan aktivasi")
                    <i class="ri-checkbox-circle-fill text-success display-1"></i>
                    <h4 class="text-dark fw-bold mb-1 mt-4">Izin akses berhasil</h4>
                @endif
                <p class="mb-4">Selamat anda berhasil mendapatkan izin akses aplikasi Lapakami. 
                    Halaman ini akan otomatis diarahkan masuk ke dalam aplikasi Lapakami. Jika tidak, klik tombol dibawah ini </p>
                <a href="{{ env('APP_URL').'/login-sso'}}" class="btn btn-primary rounded-pill px-3">Masuk Sekarang</a>
                <div id="countdown" class="mt-3"></div>
            </div>
            <!-- End Alert Success -->
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
		var id = '{{ Request::segment(3) }}';
		var url = '{{ env("APP_URL")}}'+'/login-sso';

        var timeleft = 10;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = '<p>Mengarahkan ke dalam aplikasi<br>Loading...</p>';
                window.location.href = url
            } else {
                document.getElementById("countdown").innerHTML = "<p>Halaman ini akan mengarahkan langsung masuk aplikasi Lapakami, tunggu " + timeleft + " detik</p>";
            }
            timeleft -= 1;
        }, 1000);
    </script>
@endsection
