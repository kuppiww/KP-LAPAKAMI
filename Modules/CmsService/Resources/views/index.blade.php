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
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="text-dark fw-bold mb-0">Layanan</h4>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-3 btnAdd"><i
                    class="ri-add-circle-line me-2"></i> Buat Layanan</a>
        </div>
    </div>

    <div class="card p-2 border-0">
        <div class="card-body">

            <table id="dataTable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="60%">Layanan</th>
                        <th width="15%">Pilihan</th>
                        <th width="15%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @if (sizeof($services) == 0)
                        <tr>
                            <td align="center" class="text-muted" colspan="5">Tidak ada data tersedia</td>
                        </tr>
                    @else
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td valign="middle">
                                    @if ($service->is_select)
                                        <span class="badge bg-success">Ya</span>
                                    @else
                                        <span class="badge bg-danger">Bukan</span>
                                    @endif
                                </td>
                                <td valign="middle">
                                    @if ($service->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('cms/layanan/detail/' . $service->service_id) }}"
                                        class="btn btn-icon btn-light rounded-circle p-1">
                                        <i class="ri-file-upload-line fs-6"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light rounded-circle p-1 btnEdit"
                                        data-id="{{ $service->service_id }}">
                                        <i class="ri-pencil-line fs-6"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="btn btn-icon btn-danger rounded-circle p-1 btnDelete"
                                        data-url="{{ url('cms/layanan/delete/' . $service->service_id) }}">
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

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Buat Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="addForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group mb-2">
                                <label class="form-label">Nama Layanan<span class="text-danger">*</span></label>
                                <input type="text" name="service_name" id="service_name" class="form-control"
                                    placeholder="Masukan nama layanan">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">ID Layanan<span class="text-danger">*</span></label>
                                <input type="text" name="service_id" id="service_id" class="form-control"
                                    placeholder="Masukan ID layanan">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Slug Layanan<span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    placeholder="Masukan slug layanan">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Kode Layanan</label>
                                <input type="text" name="service_code" id="service_code" class="form-control"
                                    placeholder="Masukan Kode layanan">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Nama Layanan (Simkel)</label>
                                <input type="text" name="service_name_simkel" id="service_name_simkel" class="form-control"
                                    placeholder="Masukan nama layanan simkel">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Slug (Simkel)</label>
                                <input type="text" name="slug_simkel" id="slug_simkel" class="form-control"
                                    placeholder="Masukan slug simkel">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Icon<span class="text-danger">*</span> <span
                                        id="icon_file"></span></label>
                                <input type="file" name="icon" id="icon" class="form-control"
                                    placeholder="Masukan icon">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Urutan<span class="text-danger">*</span></label>
                                <input type="text" name="position" id="position" class="form-control"
                                    placeholder="Masukan urutan">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Layanan Kecamatan?<span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select" name="service_is_kec" id="service_is_kec">
                                    <option value="false">Tidak</option>
                                    <option value="true">Ya</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Layanan Online?<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="is_online" id="is_online">
                                    <option value="false">Tidak</option>
                                    <option value="true">Ya</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="form-label">Muncul Di Web?<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="is_show_front" id="is_show_front">
                                    <option value="true">Ya</option>
                                    <option value="false">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Layanan Dapat Dipilih?<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="is_select" id="is_select">
                                    <option value="false">Tidak</option>
                                    <option value="true">Ya</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Status Layanan<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="is_active" id="is_active">
                                    <option value="true">Aktif</option>
                                    <option value="false">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label class="form-label">Link External</label>
                                <input type="text" name="service_link" id="service_link" class="form-control"
                                    placeholder="Masukan link">
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label class="form-label">Nama Tabel Backoffice</label>
                                <input type="text" name="simkel_table" id="simkel_table" class="form-control"
                                    placeholder="Masukan nama tabel">
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label class="form-label">Deskripsi<span class="text-danger">*</span></label>
                                <textarea name="service_description" id="service_description" class="form-control" placeholder="Tulis deskripsi"
                                    id="summernote"></textarea>
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
        $(document).ready(function() {
            $("#addForm").validate({
                rules: {
                    service_id: "required",
                    slug: "required",
                    slug: "required",
                    service_code: {
                        required: false,
                        maxlength: 3
                    },
                    service_name: "required",
                    // icon: "required",
                    position: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    service_id: "ID layanan tidak boleh kosong",
                    slug: "Slug layanan tidak boleh kosong",
                    service_name: "Nama layanan tidak boleh kosong",
                    service_code: {
                        required: "Kode layanan tidak boleh kosong",
                        maxlength: "Maksimal 3 karakter"
                    },
                    // icon: "Icon tidak boleh kosong",
                    position: {
                        required: "Urutan tidak boleh kosong",
                        number: "Hanya boleh berisi angka",
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

            $('.btnAdd').click(function() {
                $('#service_id').val('');
                $('#slug').val('');
                $('#service_name').val('');
                $('#icon').val('');
                $('#icon_file').html('');
                $('#position').val('');
                $('#service_is_kec').val('false');
                $('#is_online').val('true');
                $('#is_show_front').val('false');
                $('#is_select').val('false');
                $('#is_active').val('true');
                $('#service_code').val('');
                $('#simkel_table').val('');
                $('#service_description').val('');
                $('#service_link').val('');
                $('#slug_simkel').val('');
                $('#service_name_simkel').val('');
                $('#createModal form').attr('action', "{{ url('cms/layanan/store') }}");
                $('#createModal .modal-title').text('Tambah Layanan');
                $('#createModal').modal('show');
            });

            $('.btnEdit').click(function() {

                var id = $(this).attr('data-id');
                var url = "{{ url('cms/layanan/getdata') }}";

                $('#createModal form').attr('action', "{{ url('cms/layanan/update') }}" + '/' + id);

                $.ajax({
                    type: 'GET',
                    url: url + '/' + id,
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);

                        if (data.status == 1) {

                            var icon = "{{ url('storage/images/service/') }}" + "/" + data
                                .result.service_icon;
                            $('#service_id').val(data.result.service_id);
                            $('#slug').val(data.result.slug);
                            $('#service_name').val(data.result.service_name);
                            $('#service_code').val(data.result.service_code);
                            $('#slug_simkel').val(data.result.slug_simkel);
                            $('#service_name_simkel').val(data.result.service_name_simkel);
                            $('#simkel_table').val(data.result.simkel_table);
                            // $('#icon').val(data.result.service_icon);
                            $('#icon_file').html("<a href='" + icon +
                                "' target='blank' class='bg-light py-1 px-2'>Lihat icon</a>"
                                );
                            $('#position').val(data.result.position);
                            $('#service_is_kec').val(data.result.service_is_kec.toString());
                            $('#is_online').val(data.result.is_online.toString());
                            $('#is_show_front').val(data.result.is_show_front.toString());
                            $('#is_select').val(data.result.is_select.toString());
                            $('#is_active').val(data.result.is_active.toString());
                            $('#service_description').val(data.result.service_description);
                            $('#service_link').val(data.result.service_link);
                            $('#createModal .modal-title').text('Ubah Layanan');
                            $('#createModal').modal('show');
                        }

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('Error : Gagal mengambil data');
                    }
                });
            });
        });
    </script>
@endsection
