@extends('layouts.user')
@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-12">
            <h4 class="text-dark fw-bold mb-0">Pengaturan</h4>
        </div>
    </div>

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

    <div class="card p-2 border-0">
        <div class="card-body">
            <h5 class="text-dark fw-bold">Ubah Kata Sandi</h5>
            <p>Untuk melakukan perubahan pada kata sandi anda silahkan menggunakan form berikut.</p>

            <form class="row mt-4" id="addForm" method="POST" action="{{ url('/user/pengaturan') }}">
                @csrf
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kata Sandi Sekarang</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Masukan kata sandi">
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kata Sandi Baru</label>
                        <input type="password" name="user_password" id="password" class="form-control"
                            placeholder="Masukan kata sandi">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" name="repassword" class="form-control" placeholder="Masukan konfirmasi">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#addForm").validate({
            rules: {
                current_password: {
                    required: true,
                },
                user_password: {
                    required: true,
                    minlength: 6
                },
                repassword: {
                    equalTo: "#password"
                },
            },
            messages: {
                current_password: {
                    required: "Kata sandi tidak boleh kosong",
                },
                user_password: {
                    required: "Kata sandi baru tidak boleh kosong",
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
