@extends('layouts.auth')
@section('title')
    Masuk
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4 class="text-dark fw-bold mb-1">Masuk Akun</h4>
            <p class="mb-1">Untuk mengakses layanan yang tersedia pada aplikasi anda diwajibkan memiliki akun.</p>

            @if (session('error'))
                <div class="alert bg-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert bg-success mt-3">
                    {{ session('message') }}
                </div>
            @endif

            <form class="row mt-5" id="addForm" method="POST" action="{{ url('/masuk') }}">
                @csrf
                <input type="text" name="client_id" value="{{ $data['client_id'] }}" hidden readonly>
                <input type="text" name="client_secret" value="{{ $data['client_secret'] }}" hidden readonly>
                <input type="text" name="token" value="{{ $data['token'] }}" hidden readonly>
                <input type="hidden" id="recaptcha-token" name="recaptcha_token">
                
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" name="user_username" class="form-control" placeholder="Masukan nomor induk kependudukan">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kata Sandi</label>
                        <a href="{{ url('lupa-sandi') }}" class="float-end"><small>Lupa kata sandi?</small></a>
                        <input type="password" name="user_password" class="form-control" placeholder="Masukan kata sandi">
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4 mb-3">Masuk Aplikasi</button>
                    <a href="{{ route('sso.login') }}">
                        <button type="button" class="btn btn-info px-4" style="color: white">Masuk menggunakan Polakami</button>
                    </a>
                    <p class="mb-3 mt-3">Belum memiliki akun? <a href="{{ url('daftar') }}" class="">Daftar disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade show" id="perhatianModal" tabindex="-1" aria-labelledby="perhatianModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="https://dev-polakami.cimahikota.go.id/images/sign/polakami_sign_up.png" alt="" width="100%">
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary" href="https://polakami.cimahikota.go.id">Kunjungi</a>
                    <button type="button" class="btn btn-light" onclick="hide()" data-bs-dismiss="modal">Nanti</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function hide() {
            var element = document.getElementById("perhatianModal");
            element.classList.remove("show");
            element.style.display = "none";
        }

        $("#addForm").validate({
            rules: {
                user_username: {
                    required: true,
                    number : true,
                    minlength: 16,
                    maxlength: 16,
                },
                user_password: "required",
            },
            messages: {
                user_username: {
                    number : 'NIK hanya boleh berisi angka',
                    required: "Nomor induk kependudukan tidak boleh kosong",
                    minlength: "Nomor induk kependudukan harus 16 digit",
                    maxlength: "Nomor induk kependudukan harus 16 digit",
                },
                user_password: "Kata sandi tidak boleh kosong",
            },
            errorElement: "em",
            errorClass: "invalid-feedback",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                $(element).parents('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('captcha.sitekey') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute();
        });
    </script>
@endsection
