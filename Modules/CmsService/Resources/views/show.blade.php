@extends('layouts.cms')
@section('title')
    Layanan
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

    <div class="row">
        <!-- Detail Data -->
        <div class="col-md-5">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h4 class="text-dark fw-bold mb-0">Layanan</h4>
                </div>
            </div>

            <div class="card p-2 border-0 mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <small class="text-muted">Nama Layanan</small> <br>
                                {{ $detail->service_name }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <small class="text-muted">Slug Layanan</small> <br>
                                {{ $detail->slug }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <small class="text-muted">Link Layanan Eksternal</small> <br>
                                {{ $detail->service_link }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">ID Layanan</small> <br>
                                {{ $detail->service_id }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Status Layanan</small> <br>
                                @if($detail->is_active) 
                                    <span class="badge bg-success">Aktif</span> 
                                @else 
                                    <span class="badge bg-danger">Tidak Aktif</span> 
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Icon</small> <br>
                                {{ $detail->service_name }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Urutan</small> <br>
                                {{ $detail->position }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Layanan Hingga Kecamatan?</small> <br>
                                @if($detail->service_is_kec) Ya @else Tidak @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Layanan Online?</small> <br>
                                @if($detail->is_online) Ya @else Tidak @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Muncul Di Web?</small> <br>
                                @if($detail->is_show_front) Ya @else Tidak @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small class="text-muted">Layanan Dapat Dipilih?</small> <br>
                                @if($detail->is_select) Ya @else Tidak @endif
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <small class="text-muted">Deskripsi</small> <br>
                                {{ $detail->service_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Detail Data -->

        <!-- List Requirement -->
        <div class="col-md-7">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h4 class="text-dark fw-bold mb-0">Persyaratan Layanan</h4>
                </div>
                <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3 btnAdd"><i class="ri-add-circle-line me-2"></i> Tambah Persyaratan</a>
                </div>
            </div>

            <div class="card p-2 border-0">
                <div class="card-body">

                    <table id="dataTable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="60%">Persyaratan</th>
                                <th width="20%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(sizeof($requirements) == 0)
                                <tr>
                                    <td align="center" class="text-muted" colspan="4">Tidak ada data tersedia</td>
                                </tr>
                            @else

                                @foreach($requirements as $requirement)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $requirement->service_requirement_name }}</td>
                                        <td valign="middle">
                                            @if($requirement->is_required)
                                                <span class="badge bg-success">Mandatory</span>
                                            @else
                                                <span class="badge bg-danger">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-light rounded-circle p-1 btnEdit" data-id="{{ $requirement->service_requirement_id }}">
                                                <i class="ri-pencil-line fs-6"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-danger rounded-circle p-1 btnDelete" data-url="{{ url('cms/layanan_syarat/delete/'. $requirement->service_requirement_id) }}">
                                                <i class="ri-delete-bin-line fs-6"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End List Requirement -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Tambah Persyaratan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="addForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">ID Layanan<span class="text-danger">*</span></label>
                                <input type="text" name="service_id" id="service_id" class="form-control" placeholder="Masukan ID layanan" value="{{ $detail->service_id }}" readonly="readonly">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Persyaratan<span class="text-danger">*</span></label>
                                <input type="text" name="service_requirement_name" id="service_requirement_name" class="form-control" placeholder="Masukan persyaratan">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Contoh File <span id="example_file"></span></label>
                                <input type="file" name="example" id="example" class="form-control" placeholder="Masukan file">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Mandatory?<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="is_required" id="is_required">
                                    <option value="true">Ya</option>
                                    <option value="false">Tidak</option>
                                </select>
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
@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function(){
        $("#addForm").validate({
            rules: {
                service_id: "required",
                service_requirement_name: "required",
            },
            messages: {
                service_id: "ID layanan tidak boleh kosong",
                service_requirement_name: "Persyaratan tidak boleh kosong",
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

        $('.btnAdd').click(function(){
            $('#service_requirement_name').val('');
            $('#example').val('');
            $('#example_file').html('');
            $('#is_required').val('true');
            $('#createModal form').attr('action', "{{ url('cms/layanan_syarat/store') }}");
            $('#createModal .modal-title').text('Tambah Layanan');
            $('#createModal').modal('show');
        });

        $('.btnEdit').click(function(){

            var id  = $(this).attr('data-id');
            var url = "{{ url('cms/layanan_syarat/getdata') }}";

            $('#createModal form').attr('action', "{{ url('cms/layanan_syarat/update') }}" +'/'+ id);

            $.ajax({
                type : 'GET',
                url : url +'/'+ id,
                dataType : 'JSON',
                success : function(data) {
                    console.log(data);

                    if (data.status == 1) {

                        var file = "{{ url('storage/files/service/') }}" +"/"+ data.result.example_file; 

                        $('#service_id').val(data.result.service_id);
                        $('#service_requirement_name').val(data.result.service_requirement_name);

                        if(data.result.example_file){
                            $('#example_file').html("<a href='"+ file +"' target='blank' class='bg-light py-1 px-2'>Lihat file</a>");
                        }

                        $('#is_required').val(data.result.is_required.toString());
                        $('#createModal .modal-title').text('Ubah Persyaratan');
                        $('#createModal').modal('show');
                    }
                            
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('Error : Gagal mengambil data'); 
                }
            });
        });
    });
</script>
@endsection
