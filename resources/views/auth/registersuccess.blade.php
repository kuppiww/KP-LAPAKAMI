@extends('layouts.auth')
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
                    <h4 class="text-dark fw-bold mb-1 mt-4">Pendaftaran Berhasil</h4>
                @endif
                <p class="mb-4">Kami mengirimkan email aktivasi melalui email yang anda daftarkan silahkan untuk melakukan
                    pengecekan pada pesan masuk (<i>inbox</i>), jika tidak ada silahkan cek pada spam.</p>
                <a href="{{ url('masuk') }}" class="btn btn-primary rounded-pill px-3">Masuk Sekarang</a>

                <div id="countdown" class="mt-3"></div>
            </div>
            <!-- End Alert Success -->
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
		var id = '{{ Request::segment(3) }}';
		var url = '{{ url("/kirim-ulang-email")}}'+'/'+id;

        var timeleft = 30;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = '<a href="'+ url +'" class="btn btn-secondary rounded-pill px-3">Kirim Ulang Email Aktivasi</a>';
            } else {
                document.getElementById("countdown").innerHTML = "<p>Kirim ulang email aktivasi tunggu " + timeleft + " detik</p>";
            }
            timeleft -= 1;
        }, 1000);
    </script>
@endsection
