@extends('layouts.user')
@section('title')
    Profil
@endsection
<?php use App\Helpers\DateFormatHelper; ?>


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
        <div class="col-md-12">
            <h4 class="text-dark fw-bold mb-0 align-items-center d-flex">
                <span>Profil</span>
                @if ($user->user_is_comp_profile)
                    <p class="mb-0 d-inline-block ms-2">
                        <span class="badge bg-success rounded-pill px-3"><i class="ri-check-line me-2"></i> Sudah
                            Lengkap</span>
                    </p>
                @else
                    <p class="mb-0 d-inline-block ms-2">
                        <span class="badge bg-warning rounded-pill px-3"><i class="ri-information-line me-2"></i> Belum
                            Lengkap</span>
                    </p>
                @endif

            </h4>

        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <form class="row mt-5" id="addForm" method="POST" action="{{ url('/user/profil') }}">
                @csrf
                <div class="col-md-12">
                    <h5>Informasi Akun</h5>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" name="user_nama" value="{{ $user->user_nama }}" class="form-control"
                            placeholder="Masukan nama lengkap">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="user_email" class="form-control" placeholder="Masukan email"
                                value="{{ $user->user_email }}">
                            <span class="input-group-text" id="basic-addon2">
                                @if ($user->user_email_is_activate)
                                    <!-- Verified -->
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                @else
                                    <!-- UnVerified -->
                                    <i class="ri-error-warning-fill text-warning"></i>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <h5>Informasi Pribadi</h5>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">
                            Nomor Induk Kependudukan<span class="text-danger">*</span> 
                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#infoModal">
                                <i class="ri-information-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Klik untuk lihat penjelasan"></i>
                            </button>
                        </label>
                        <input type="text" name="user_nik" class="form-control"
                            placeholder="Masukan nomor induk kependudukan" value="{{ $user->user_nik }}"
                            readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">
                            Nomor Kartu Keluarga<span class="text-danger">*</span>
                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#formModal"> 
                                <i class="ri-information-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Klik untuk lihat penjelasan">klik ganti nomor kartu keluarga </i>
                            </button>
                        </label>
                        <input type="text" name="user_kk" class="form-control" placeholder="Masukan nomor kartu keluarga"
                            value="{{ $user->user_kk }}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir<span class="text-danger">*</span></label>
                        <input type="text" name="user_tmp_lahir" class="form-control" placeholder="Masukan tempat lahir"
                            value="{{ $user->user_tmp_lahir }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="birthdate" class="form-control datepicker_birth"
                                placeholder="dd/mm/yyyy" value="{{ isset($user->user_tgl_lahir) ? DateFormatHelper::dateNum($user->user_tgl_lahir) : '' }}">
                            <span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="user_id_jenkel">
                            <option value="">- Pilih Jenis Kelamin -</option>
                            @if (sizeof($genders) > 0)
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id_gender }}" {{($user->user_id_jenkel == $gender->id_gender) ? 'selected' :''}}>{{ $gender->gender }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Agama<span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="user_id_agama">
                            <option value="">- Pilih Agama -</option>
                            @if (sizeof($religions) > 0)
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id_religion }}" {{($user->user_id_agama == $religion->id_religion) ? 'selected' : ''}}>{{ $religion->religion }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">No. Telepon<span class="text-danger">*</span></label>
                        <input type="text" name="user_phone" class="form-control" placeholder="Masukan nomor telepon"
                            value="{{ $user->user_phone }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kewarganegaraan<span class="text-danger">*</span></label>
                        <input type="text" name="user_kewarganegaraan" value="{{$user->user_kewarganegaraan}}" class="form-control" placeholder="Masukan kewarganegaraan">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
                        <input type="text" name="user_pekerjaan" value="{{$user->user_pekerjaan}}" class="form-control" placeholder="Masukan pekerjaan">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Status Kawin <span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="id_merried_status" id="district">
                            <option value="">- Pilih status -</option>
                            @if (sizeof($merried_stats) > 0)
                            @foreach ($merried_stats as $merried_stat)
                                <option value="{{ $merried_stat->id_merried_status }}"
                                    {{ $user->id_merried_status == $merried_stat->id_merried_status ? 'selected' : '' }}>
                                    {{ $merried_stat->merried_status }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <h5>Informasi Alamat</h5>
                </div>

                {{-- <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="swithisCimahi">
                        <label class="form-check-label" for="swithisCimahi"><p class="mb-0">Saya bukan warga Kota Cimahi</p></label>
                    </div>
                </div> --}}
                
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="kd_kel" id="district">
                            <option value="">- Pilih Kelurahan -</option>
                            @if(sizeof($districts) > 0) 
                                @foreach($districts as $districts)
                                    <optgroup label="{{ $districts->district }}">
                                        @if(sizeof($sub_districts) > 0) 
                                            @foreach($sub_districts as $sub_district)
                                                @if($sub_district->kd_district == $districts->kd_district) 
                                                    <option value="{{ $sub_district->kd_sub_district }}" {{($user->kd_kel == $sub_district->kd_sub_district) ? 'selected' : ''}}>{{ $sub_district->sub_district }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label class="form-label">Rukun Tetangga (RT)<span class="text-danger">*</span></label>
                        <input type="text" name="rt" class="form-control" placeholder="Masukan RT"
                            value="{{ $user->user_rt }}">
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label class="form-label">Rukun Warga (RW)<span class="text-danger">*</span></label>
                        <input type="text" name="rw" class="form-control" placeholder="Masukan RW"
                            value="{{ $user->user_rw }}">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="user_alamat" placeholder="Tulis alamat lengkap disini">{{ $user->user_alamat }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Informasi Perubahan NIK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Jika terjadi kesalahan NIK pada saat pendaftaran Anda tidak dapat merubahnya secara langsung melalui profil, tetapi Anda dapat menghubungi pihak berwenang melalui email yang anda daftarkan pada saat pendaftaran akun lapakami dan dikirim ke alamat <b>lapakami@cimahikota.go.id</b> dengan melampirkan hasil scan atau foto Kartu Keluarga </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Perubahan Nomor KK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('ubah-kk/simpan') }}" id="formUbahKK" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Jika terjadi kesalahan Nomor KK, Anda tidak dapat merubahnya secara langsung melalui profil, tetapi Anda dapat merubah melalui form dibawah ini dengan melampirkan hasil scan atau foto Kartu Keluarga </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Nomor KK Baru<span class="text-danger">*</span></label>
                                    <input type="text" name="kk_baru" id="kk_baru" class="form-control" placeholder="Masukan Nomor KK" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Scan atau Foto KK Baru<span class="text-danger">*</span></label>
                                    <input type="file" name="f_change_kk" id="f_change_kk" class="form-control" >
                                    <small class="form-note">File .jpg, .jpeg, .png, .pdf, Maksimal 1MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Ajukan Permohonan</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('script')
    <script type="text/javascript">
        $("#addForm").validate({
            rules: {
                user_nama: "required",
                user_email: {
                    required: true,
                    email: true
                },
                user_tmp_lahir: "required",
                user_tgl_lahir: "required",
                user_id_jenkel: "required",
                user_id_agama: "required",
                user_kewarganegaraan: "required",
                user_pekerjaan: "required",
                id_merried_status: "required",
                user_phone: {
                    required : true,
                    number : true,
                    maxlength : 13
                },
                rt: {
                    required : true,
                    number : true,
                    maxlength : 3
                },
                rw: {
                    required : true,
                    number : true,
                    maxlength : 3
                },
                kd_kel: "required",
                user_alamat: "required"
            },
            messages: {
                user_nama: "Nama tidak boleh kosong",
                user_email: {
                    required: "Email tidak boleh kosong",
                    email: "Format email tidak sesuai"
                },
                user_tmp_lahir: "Tempat lahir tidak boleh kosong",
                user_tgl_lahir: "Tanggal lahir tidak boleh kosong",
                user_id_jenkel: "Jenis kelamin harus dipilih",
                user_id_agama: "Agama harus dipilih",
                user_kewarganegaraan: "Kewarganegaraan tidak boleh kosong",
                user_pekerjaan: "Pekerjaan tidak boleh kosong",
                id_merried_status: "Status kawin harus diisi",
                user_phone: {
                    required : "Nomor telpon tidak boleh kosong",
                    number : "Nomor telpon harus angka",
                    maxlength : "Nomor telpon maksimal 13 angka"
                },
                rt: {
                    required: "RT tidak boleh kosong",
                    number : "Hanya boleh diisi angka",
                    maxlength: "Maksimal 3 digit"
                },
                rw: {
                    required: "RW tidak boleh kosong",
                    number : "Hanya boleh diisi angka",
                    maxlength: "Maksimal 3 digit"
                },
                kd_kel: "Kelurahan harus dipilih",
                user_alamat: "Alamat tidak boleh kosong",

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

        $("#formUbahKK").validate({
            rules: {
                kk_baru: {
                    required: true,
                    number : true,
                    maxlength : 16,
                    minlength : 16
                },
                f_change_kk: {
                    required: true,
                    extension: "pdf|jpg|jpeg|png",
                    filesize: 1024000
                }
            },
            messages: {
                kk_baru: {
                    required: "Nomor KK tidak boleh kosong",
                    number : "Hanya boleh diisi angka",
                    maxlength : "Nomor KK harus 16 angka",
                    minlength : "Nomor KK harus 16 angka"
                },
                f_change_kk: {
                    required: "KK tidak boleh kosong",
                    extension: "Hanya boleh mengunggah .pdf, .jpeg, .png",
                    filesize: "Ukuran file maksimal 1MB"
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

        $('#swithisCimahi').change(function(){

            if($(this).is(':checked')){
                $('#district').attr('disabled', 'disabled');;
            }
            else{
                $('#district').removeAttr('disabled');
            }

        });
    </script>
@endsection
