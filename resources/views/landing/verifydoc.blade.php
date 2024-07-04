@extends('layouts.app')
@section('title') Verifikasi Dokumen @endsection

@section('content')
<!-- Guide -->
<div class="py-6">
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center mx-auto">

				<img src="{{ asset('assets/img/lapakami-icon-verify.png') }}" height="80px" alt="Icon Verify" class="mb-4" />

				<h2 class="fw-bold text-dark">Verifikasi Dokumen</h2>
				<p class="text-muted mb-0">Cek keaslian dokumen yang anda miliki disini</p>

				@if (session('error'))
	                <div class="alert bg-danger mt-3">
	                    {{ session('error') }}
	                </div>
	            @endif

				<form class="row mt-4" action="{{ url('verifikasi-dokumen/hasil') }}" id="addForm">
					<div class="col-md-12 mb-3 form-group">
						<input type="text" name="key" class="form-control" placeholder="Masukan nomor ID dokumen">
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary px-4 w-100">
							<i class="ri-checkbox-circle-line me-2"></i>
							Verifikasi Sekarang
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Guide -->
@endsection

@section('script')
    <script type="text/javascript">
        $("#addForm").validate({
            rules: {
                key: "required",
            },
            messages: {
                key: "ID dokumen tidak boleh kosong",
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