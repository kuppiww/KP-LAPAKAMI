@extends('layouts.user')
@section('title')
    Menu
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
        <h4 class="text-dark fw-bold mb-0">Task</h4>
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('') }}" class="text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-muted">Setting</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Task</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
            data-bs-target="#addModal"><i class="ri-add-circle-line me-2"></i> Tambah Task</a>
    </div>
</div>


<div class="card p-2 border-0">
    <div class="card-body">

        <table id="dataTable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="40%">Module</th>
                    <th width="40%">Task</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td width="80%">{{ $task->module_name }}</td>
                            <td width="80%">{{ $task->task_name }}</td>
                            <td width="15%">
                                <a href="javascript:void(0)"  data-id="{{ $task->task_id }}"
                                    class="btn btn-icon btn-warning rounded-circle p-1 btnEdit"><i class="ri-edit-line fs-6"></i></a>
                                <a href="javascript:void(0)"  data-id="{{ $task->task_id }}" data-url="{{ url('systask/delete/'. $task->task_id) }}"
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

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Tambah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('systask/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                        	<div class="col-md-12">
                                <div class="form-group">
                                    <label>Modul<span class="text-danger">*</span></label>
                                    <select class="form-control" name="module_id" id="module_id">
                                    	<option value="">- Pilih Modul -</option>
                                    	@if(sizeof($modules) > 0) 
                                    		@foreach($modules as $module)
                                    			<option value="{{ $module->module_id }}">{{ $module->module_name }}</option>
                                    		@endforeach
                                    	@endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Task<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="task_name" id="task_name">
                                    	<!-- <option value="">- Pilih Task -</option> -->
                                    	<option value="index">Index</option>
                                    	<option value="create">Create</option>
                                    	<option value="edit">Edit</option>
                                    	<option value="delete">Delete</option>
                                    	<option value="view">View</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add -->

@section('script')
<script type="text/javascript">
	$('.btnAdd').click(function(){
        $('#module_id').val('');
        $('#task_name').val('');
        $('#addModal form').attr('action', "{{ url('systask/store') }}");
        $('#addModal .modal-title').text('Tambah Task');
		// $('#addModal').modal();
	});

    $('.btnEdit').click(function(){

        var id  = $(this).attr('data-id');
        var url = "{{ url('systask/getdata') }}";

        $('#addModal form').attr('action', "{{ url('systask/update') }}" +'/'+ id);

        $.ajax({
            type : 'GET',
            url : url +'/'+ id,
            dataType : 'JSON',
            success : function(data) {
                console.log(data);

                if (data.status == 1) {

                    $('#module_id').val(data.result.module_id);
                    $('#task_name').val(data.result.task_name);
                    $('#addModal .modal-title').text('Ubah Task');
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
            module_id: "required",
            task_name: "required",
        },
        messages: {
            module_id: "Modul harus dipilih",
            task_name: "Task harus dipilih",
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