@extends('layouts.useradmin')
@section('title')
    Pengaturan Email Pengguna
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
            <h4 class="text-dark fw-bold mb-0">Pengaturan Email Pengguna</h4>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">
            <div class="card-title">Data Akun Masyarakat</div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Nomor Induk Kependudukan</label>
                    <p>{{ $user->user_username }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <p>{{ $user->user_nama }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <p>{{ $user->user_email }}</p>
                </div>
            </div>
            <form id="changeForm" method="POST" action="/user/setting/changeemail" enctype="multipart/form-data">
                @csrf
                <input type="text" name="user_id" class="form-control" value="{{ $user->user_id }}" readonly hidden >
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Masukan email">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Ubah Email</button>
                </div>
            </form>
            
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#changeForm").validate({
            rules: {
                user_email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                user_email: {
                    required: "Email tidak boleh kosong",
                    email: "Format email tidak valid"
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

