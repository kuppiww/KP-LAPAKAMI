@extends('layouts.auth')
@section('title') Reset Kata Sandi @endsection

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		<!-- Form Reset -->
		<h4 class="text-dark fw-bold mb-1">Reset Kata Sandi</h4>
		<p class="mb-1">Silahkan atur kata sandi baru anda.</p>

		<form class="row mt-5" id="addForm" method=POST action="/reset-sandi">
		@csrf
		<input type="hidden" name="id" value="{{$id}}" >
		<input type="hidden" name="token" value="{{$token}}">

			<div class="col-md-12 mb-3 form-group">
				<label class="form-label">Kata Sandi Baru</label>
				<input type="password" name="user_password" id="user_password" class="form-control" placeholder="Masukan kata sandi">
			</div>
			<div class="col-md-12 mb-3 form-group">
				<label class="form-label">Konfirmasi Kata Sandi</label>
				<input type="password" name="repassword" class="form-control" placeholder="Masukan konfirmasi">
			</div>
			<div class="col-md-12 mt-4">
				<button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
			</div>
		</form>
		<!-- End Form Reset -->

		<!-- Alert Success -->
		<!-- <div class="text-center">
			<i class="ri-checkbox-circle-fill text-success display-1"></i>
			<h4 class="text-dark fw-bold mb-1 mt-4">Perubahan Berhasil</h4>
			<p class="mb-4">Kata sandi baru anda berhasil disimpan, silahkan masuk kembali ke aplikasi.</p>
			<a href="{{ url('masuk') }}" class="btn btn-primary rounded-pill px-3">Masuk Sekarang</a>
		</div> -->
		<!-- End Alert Success -->
	</div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#addForm").validate({
            rules: {
                user_password: {
                    required: true,
                    minlength: 6
                },
                repassword: {
                    equalTo: "#user_password"
                },
            },
            messages: {
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
