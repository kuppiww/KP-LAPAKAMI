@extends('layouts.user')
@section('title')
    Fitur
@endsection

@section('content')
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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
            <h4 class="text-dark fw-bold mb-0">Fitur</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Pengaturan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Fitur</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
                data-bs-target="#addModal"><i class="ri-add-circle-line me-2"></i> Tambah Fitur</a>
        </div>
    </div>
    <!-- basic table -->
    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="80%">Nama</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="80%">{{ $module->module_name }}</td>
                                <td width="15%">
                                    <a href="javascript:void(0)"  data-id="{{ $module->module_id }}"
                                        class="btn btn-icon btn-warning rounded-circle p-1 btnEdit"><i class="ri-edit-line fs-6"></i></a>
                                    <a href="javascript:void(0)"  data-id="{{ $module->module_id }}" data-url="{{ url('sysmodule/delete/'. $module->module_id) }}"
                                            class="btn btn-icon btn-danger rounded-circle p-1 btnDelete"><i class="ri-eraser-line fs-6"></i></a>

                                    </a>
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
                <h5 class="modal-title text-dark">Tambah Fitur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('sysmodule/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="form-label">ID Fitur<span class="text-danger">*</span></label>
                            <input type="text" name="module_id" id="module_id" class="form-control"
                                placeholder="Masukan ID nama fitur">
                             @if ($errors->has('module_id'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Fitur tidak boleh sama</label>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group">
                            <label class="form-label">Nama Fitur<span class="text-danger">*</span></label>
                            <input type="text" name="module_name" id="module_name" class="form-control"
                                placeholder="Masukan nama fitur">
                             @if ($errors->has('module_name'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Fitur tidak boleh sama</label>
                                </span>
                            @endif
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
        $('#module_name').val('');
        $('#module_id').val('');
        $('#addModal form').attr('action', "{{ url('sysmodule/store') }}");
        $('#addModal .modal-title').text('Tambah Fitur');
		// $('#addModal').modal('show');
	});

     // check error
    @if (count($errors))
        $('#addModal').modal('show');
    @endif

    $('.btnEdit').click(function(){

        var id  = $(this).attr('data-id');
        var url = "{{ url('sysmodule/getdata') }}";

        $('#addModal form').attr('action', "{{ url('sysmodule/update') }}" +'/'+ id);

        $.ajax({
            type : 'GET',
            url : url +'/'+ id,
            dataType : 'JSON',
            success : function(data) {
                console.log(data);

                if (data.status == 1) {
                    $('#module_name').val(data.result.module_name);
                    $('#module_id').val(data.result.module_id);
                    $('#addModal .modal-title').text('Ubah Fitur');
                    $('#addModal').modal('show');
                }    
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data'); 
            }
        });

    });

    var form = $("#addForm");

    $("#addForm").validate({
        rules: {
            module_name: "required",
            module_id: "required",
        },
        messages: {
            module_name: "Nama Fitur tidak boleh kosong",
            module_id: "Fitur ID boleh kosong",
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

@endsection