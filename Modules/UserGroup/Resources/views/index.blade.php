@extends('layouts.user')
@section('title')
    Grup Pengguna
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
            <h4 class="text-dark fw-bold mb-0">Grup</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Pengaturan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Grup</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
                data-bs-target="#addModal"><i class="ri-add-circle-line me-2"></i> Tambah Grup</a>
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
                        @foreach ($groups as $group)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="80%">{{ $group->group_name }}</td>
                                <td width="15%">
                                    <a href="javascript:void(0)"  data-id="{{ $group->group_id }}"
                                        class="btn btn-icon btn-warning rounded-circle p-1 btnEdit"><i class="ri-edit-line fs-6"></i></a>
                                    <a href="javascript:void(0)"  data-id="{{ $group->group_id }}" data-url="{{ url('usergroup/delete/'. $group->group_id) }}"
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
                <h5 class="modal-title text-dark">Tambah Grup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('usergroup/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="form-label">ID Grup<span class="text-danger">*</span></label>
                            <input type="text" name="group_id" id="group_id" class="form-control"
                                placeholder="Masukan nama fitur">
                             @if ($errors->has('group_id'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Id grup tidak boleh sama</label>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-label">Nama Grup<span class="text-danger">*</span></label>
                            <input type="text" name="group_name" id="group_name" class="form-control"
                                placeholder="Masukan nama fitur">
                             @if ($errors->has('group_name'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Nama grup tidak boleh sama</label>
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
        $('#group_name').val('');
        $('#group_id').val('');
        $('#addModal form').attr('action', "{{ url('usergroup/store') }}");
        $('#addModal .modal-title').text('Tambah Grup');
		// $('#addModal').modal();
	});

    // check error
    @if (count($errors))
        $('#addModal').modal('show');
    @endif

    $('.btnEdit').click(function(){

        var id  = $(this).attr('data-id');
        var url = "{{ url('usergroup/getdata') }}";

        $('#addModal form').attr('action', "{{ url('usergroup/update') }}" +'/'+ id);

        $.ajax({
            type : 'GET',
            url : url +'/'+ id,
            dataType : 'JSON',
            success : function(data) {
                console.log(data);

                if (data.status == 1) {
                    $('#group_name').val(data.result.group_name);
                    $('#group_id').val(data.result.group_id);
                    $('#addModal .modal-title').text('Ubah Grup');
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
            group_id: "required",
            group_name: "required",
        },
        messages: {
            group_id: "Nama grup tidak boleh kosong",
            group_name: "Nama grup tidak boleh kosong",
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