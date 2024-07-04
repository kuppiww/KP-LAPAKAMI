@extends('layouts.auth')
@section('title')
    Lupa Kata Sandi
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <h4 class="text-dark fw-bold mb-1">Lupa Kata Sandi</h4>
            <p class="mb-1">Permohonan untuk pengaturan kata sandi anda akan dikirim melalui email yang terdaftar.</p>

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

            <form class="row mt-5" action="/lupa-sandi" method="POST" id="addForm">
                @csrf
                <div class="col-md-12 mb-3">
                    <label class="form-label">Nomor Induk Kependudukan</label>
                    <input type="text" name="user_username" class="form-control" placeholder="Masukan nomor induk kependudukan">
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Kirim Permohonan</button>
                    <p class="mb-3 mt-3">Kembali ke halaman <a href="{{ url('masuk') }}" class="">masuk disini</a>
                    </p>
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
            },
            messages: {
                user_username: {
                    number : 'NIK hanya boleh berisi angka',
                    required: "Nomor induk kependudukan tidak boleh kosong",
                    minlength: "Nomor induk kependudukan harus 16 digit",
                    maxlength: "Nomor induk kependudukan harus 16 digit",
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
