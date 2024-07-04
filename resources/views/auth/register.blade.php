@extends('layouts.auth')
@section('title')
    Pendaftaran
@endsection

@section('content')
    <h4 class="text-dark fw-bold mb-1">Pendaftaran Akun</h4>
    <p class="mb-1">Untuk mengakses layanan yang tersedia pada aplikasi anda diwajibkan memiliki akun.</p>

    @if ($errors->any())
        <div class="alert bg-danger mt-3">
            {{ implode('', $errors->all(':message')) }}
        </div>
    @endif

    <form class="row mt-5" id="addForm" method="POST" action="{{ url('/daftar/store') }}">
        @csrf
        <input type="text" name="client_id" value="{{ $data['client_id'] }}" hidden readonly>
        <input type="text" name="client_secret" value="{{ $data['client_secret'] }}" hidden readonly>
        <input type="text" name="token" value="{{ $data['token'] }}" hidden readonly>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Nomor Induk Kependudukan</label>
                <input type="text" name="user_nik" class="form-control" placeholder="Masukan nomor induk kependudukan">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Nomor Kartu Keluaga</label>
                <input type="text" name="user_kk" class="form-control" placeholder="Masukan nomor kartu keluarga">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="user_nama" class="form-control" placeholder="Masukan nama lengkap">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" name="user_email" class="form-control" placeholder="Masukan email">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Masukan kata sandi">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="repassword" class="form-control" placeholder="Masukan konfirmasi">
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-primary px-4">Buat Akun</button>
            <p class="mb-0 mt-3">Sudah memiliki akun? <a href="{{ url('masuk') }}" class="">Masuk disini</a></p>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $("#addForm").validate({
            rules: {
                user_nik: {
                    required: true,
                    number : true,
                    minlength: 16,
                    maxlength: 16
                },
                user_kk: {
                    required: true,
                    number : true,
                    minlength: 16,
                    maxlength: 16
                },
                user_nama: "required",
                user_email: {
                    required: true,
                    email: true
                },
                user_password: {
                    required: true,
                    minlength: 6
                },
                repassword: {
                    equalTo: "#user_password"
                },
            },
            messages: {
                user_nik: {
                    number : 'NIK hanya boleh berisi angka',
                    required: "NIK tidak boleh kosong",
                    minlength: "NIK minimal harus 16 karakter",
                    maxlength: "NIK maksimal harus 16 karakter",
                },
                user_kk: {
                    number : 'Nomor Kartu keluarga hanya boleh berisi angka',
                    required: "Nomor kartu keluarga tidak boleh kosong",
                    minlength: "Nomor kartu keluarga minimal harus 16 karakter",
                    maxlength: "Nomor kartu keluarga maksimal harus 16 karakter",
                },
                user_nama: "Nama tidak boleh kosong",
                user_email: {
                    required: "Email tidak boleh kosong",
                    email: "Format email tidak valid"
                },
                user_password: {
                    required: "Kata sandi tidak boleh kosong",
                    minlength: "Kata sandi minimal 6 karakter",
                },
                repassword: {
                    equalTo: "Ulang kata sandi tidak sesuai"
                },
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
@endsection
