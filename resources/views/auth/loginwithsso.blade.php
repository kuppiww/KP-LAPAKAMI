@extends('layouts.authsso')
@section('title')
    Masuk
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="alert bg-warning">
                <h5 class="text-white fw-bold mb-1">Untuk mengaktifkan fitur SSO pada aplikasi lapakami Anda diwajibkan 
                    melakukan aktifasi fitur SSO terlebih dahulu. 
                    Aktifasi hanya dilakukan satu kali.</h5>
            </div>

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
                
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" name="user_username" class="form-control" value="{{ $data['nik'] }}" placeholder="Masukan nomor induk kependudukan">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kata Sandi</label>
                        <input type="password" name="user_password" class="form-control" placeholder="Masukan kata sandi">
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4 mb-3">Aktifkan layanan lapakami</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
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
@endsection
