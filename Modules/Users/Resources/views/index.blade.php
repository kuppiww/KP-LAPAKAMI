@extends('layouts.user')
@section('title')
    Pengguna
@endsection

@section('content')

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
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
            <h4 class="text-dark fw-bold mb-0">Pengguna</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Pengguna</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
                data-bs-target="#addModal"><i class="ri-add-circle-line me-2"></i> Tambah Pengguna</a>
        </div>
    </div>
    <!-- basic table -->
    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama</th>
                        <th width="20%">Nama Pengguna</th>
                        <th width="20%">Email</th>
                        <th width="20%">Grup</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                      @foreach ($users as $user)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td width="20%">{{ $user->user_name }}</td>
                            <td width="20%">{{ $user->user_nip }}</td>
                            <td width="20%">{{ $user->user_email }}</td>
                            <td width="20%">{{ $user->group_name }}</td>
                            <td width="15%">
                                <a href="javascript:void(0)"  data-id="{{ $user->user_id }}"
                                    class="btn btn-icon btn-warning rounded-circle p-1 btnEdit"><i class="ri-edit-line fs-6"></i></a>
                                <a href="javascript:void(0)"  data-id="{{ $user->user_id }}" data-url="{{ url('sysusers/delete/'. $user->user_id) }}"
                                        class="btn btn-icon btn-danger rounded-circle p-1 btnDelete"><i class="ri-eraser-line fs-6"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>

   
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('sysusers/store')}}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control" name="user_nip" id="user_nip" placeholder="Masukan nip" value = "{{ old('user_nip') }}">
                                @if ($errors->has('user_nip'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">NIP tidak valid atau sudah didaftarkan</label>
                                    </span>
                                 @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Masukan nama" value = "{{ old('user_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" name="user_phone" id="user_phone" placeholder="Masukan no telp" value = "{{ old('user_phone') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Masukan email" value = "{{ old('user_email') }}">
                                @if ($errors->has('user_email'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">email tidak valid atau sudah didaftarkan</label>
                                    </span>
                                 @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                                                            <option value="{{ $sub_district->kd_sub_district }}">{{ $sub_district->sub_district }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Grup</label>
                                <select class="form-control" name="group_id" id="group_id">
                                    <option value="">- Pilih Grup -</option>
                                    @if(sizeof($groups) > 0) 
                                        @foreach($groups as $group)
                                            <option value="{{ $group->group_id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kata Sandi</label>
                                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Masukan kata sandi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ulangi Kata Sandi</label>
                                <input type="password" class="form-control" id="repassword" placeholder="Masukan ulang kata sandi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->




@section('script')
<script type="text/javascript">
	$('.btnAdd').click(function(){
        $('#user_nip').val('');
        $('#user_name').val('');
        $('#user_phone').val('');
        $('#user_email').val('');
        $('#kd_kel').val('');
        $('#password').val('');
        $('#repassword').val('');
        $('#group_id').val('');
        $('#username').val('');
        $('.addModal form').attr('action', "{{ url('sysusers/store') }}");
        $('.addModal .modal-title').text('Tambah Pengguna');
		// $('.addModal').modal();
	});

    // check error
    @if (count($errors))
        $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function(){

        var id  = $(this).attr('data-id');
        var url = "{{ url('sysusers/getdata') }}";

        $('#addModal form').attr('action', "{{ url('sysusers/update') }}" +'/'+ id);

        $.ajax({
            type : 'GET',
            url : url +'/'+ id,
            dataType : 'JSON',
            success : function(data) {
                console.log(data);

                if (data.status == 1) {
                    $('#user_nip').val(data.result.user_nip);
			        $('#user_name').val(data.result.user_name);
			        $('#user_phone').val(data.result.user_phone);
			        $('#user_email').val(data.result.user_email);
			        $('#kd_kel').val(data.result.kd_kel);
			        $('#user_name').val(data.result.user_name);
			        $('#group_id').val(data.result.group_id);
			        $('#username').val(data.result.username);
                    $('#addModal .modal-title').text('Ubah Pengguna');
                    $('#addModal').modal('show');
                }          
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data'); 
            }
        });

    });

    $("#addForm").validate( {
        rules: {
            user_nip: "required",
            user_name: "required",
            user_phone: "required",
            kd_kel: "required",
            user_email: {
            	required: true,
            	email: true
            },

            user_password: "required",
            repassword: {
            	equalTo: "#user_password"
            },
            group_id: "required",
        },
        messages: {
            user_nip: "NIP tidak boleh kosong",
            user_name: "Nama tidak boleh kosong",
            user_phone: "No telp tidak boleh kosong",
            kd_kel: "Kelurahan tidak boleh kosong",
            user_email: {
            	required: "Email tidak boleh kosong",
            	email: "Format email tidak valid"
            },
            user_password: "Kata sandi tidak boleh kosong",
            repassword: {
            	equalTo: "Ulang kata sandi tidak sesuai"
            },
            group_id: "Grup harus dipilih",
        },
        errorElement: "em",
        errorClass: "invalid-feedback",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            $(element).parents('.form-group').append(error);
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass("is-valid").removeClass("is-invalid");
        }
    });
</script>
@endsection

@endsection