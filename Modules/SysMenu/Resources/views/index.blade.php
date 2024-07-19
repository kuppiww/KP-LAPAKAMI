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
            <h4 class="text-dark fw-bold mb-0">Menu</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Setting</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal"
                data-bs-target="#addModal"><i class="ri-add-circle-line me-2"></i> Tambah Menu</a>
        </div>
    </div>
    <!-- basic table -->
    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Menu</th>
                        <th width="15%">Modul</th>
                        <th width="20%">URL</th>
                        <th width="15%">Parent</th>
                        <th width="10%">Posisi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                                @php
                                    $parent = "-";

                                    if(!empty($menu->menu_name_parent)) $parent = $menu->menu_name_parent;

                                    $module = "-";

                                    if(!empty($menu->module_name)) $module = $menu->module_name;

                                @endphp

                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    <td width="20%">{{ $menu->menu_name }}</td>
                                    <td width="20%">{{ $module }}</td>
                                    <td width="20%">{{ $menu->menu_url }}</td>
                                    <td width="15%">{{ $parent }}</td>
                                    <td width="15%">{{ $menu->menu_position }}</td>
                                    <td width="15%">
                                        <a href="javascript:void(0)"  data-id="{{ $menu->menu_id }}"
                                            class="btn btn-icon btn-warning rounded-circle p-1 btnEdit"><i class="ri-edit-line fs-6"></i></a>
                                        <a href="javascript:void(0)"  data-id="{{ $menu->menu_id }}" data-url="{{ url('sysmenu/delete/'. $menu->menu_id) }}"
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
            <form action="{{ url('sysmenu/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_name" id="menu_name" placeholder="Masukan nama menu">
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label>Fitur </label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>URL <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_url" id="menu_url" placeholder="Masukan alamat URL">
                                    <small>Untuk menu parent diisi: javascript:void(0)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub menu ? <span class="text-danger">*</span></label>
                                    <select name="menu_is_sub" id="menu_is_sub" class="form-control">
                                    	<option value="0">Bukan</option>
                                    	<option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ikon</label>
                                    <div class="input-group">
                                    	<input type="text" class="form-control" name="menu_icon" id="menu_icon" placeholder="Masukan kode ikon">
                                    	<div class="input-group-append">
                                            <a href="https://feathericons.com/" class="btn btn-outline-secondary" target="blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Menu Parent</label>
                                    <select class="form-control" name="menu_parent_id" id="menu_parent_id" disabled="disabled">
                                    	<option value="">- Pilih Menu -</option>
                                    	@if(sizeof($parents) > 0) 
                                    		@foreach($parents as $parent)
                                    			<option value="{{ $parent->menu_id }}">{{ $parent->menu_name }}</option>
                                    		@endforeach
                                    	@endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Posisi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_position" id="menu_position" placeholder="Masukan posisi">
                                    <small>Semakin kecil, semakin atas (0)</small>
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
        $('#menu_name').val('');
        $('#module_id').val('');
        $('#menu_url').val('');
        $('#menu_is_sub').val('0');
        $('#menu_icon').val('');
        $('#menu_parent_id').val('');
        $('#menu_position').val('');
        $('#addModal form').attr('action', "{{ url('sysmenu/store') }}");
        $('#addModal .modal-title').text('Tambah Menu');
		// $('.addModal').modal();
	});

    $('.btnEdit').click(function(){

        var id  = $(this).attr('data-id');
        var url = "{{ url('sysmenu/getdata') }}";

        $('#addModal form').attr('action', "{{ url('sysmenu/update') }}" +'/'+ id);

        $.ajax({
            type : 'GET',
            url : url +'/'+ id,
            dataType : 'JSON',
            success : function(data) {
                console.log(data);

                if (data.status == 1) {

                    $('#menu_name').val(data.result.menu_name);
			        $('#module_id').val(data.result.module_id);
			        $('#menu_url').val(data.result.menu_url);
			        $('#menu_is_sub').val(data.result.menu_is_sub);
			        $('#menu_icon').val(data.result.menu_icon);
                    $('#menu_parent_id').val(data.result.menu_parent_id);
			        $('#menu_position').val(data.result.menu_position);
                    $('#addModal .modal-title').text('Ubah Menu');
                    $('#addModal').modal('show');

                }
                        
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data'); 
            }
        });

    });

    $('#menu_is_sub').change(function(){

        var val = $(this).val();

        if (val == 0) {
            $('#menu_parent_id').val('');
            $('#menu_parent_id').attr('disabled', 'disabled');
        }
        else{
            $('#menu_parent_id').removeAttr('disabled');
        }

    });

    $("#addForm").validate( {
        rules: {
            menu_name: "required",
            menu_url: "required",
            menu_position: {
                required: true,
                number: true
            },
        },
        messages: {
            menu_name: "Nama tidak boleh kosong",
            menu_position: "Posisi tidak boleh kosong dan hanya boleh angka",
            menu_url: "URL tidak boleh kosong",
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