@extends('layouts.user')
@section('title')
    Ubah Hak Akses
@endsection

@section('content')

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                    	<div class="col-md-6">
                    		<h4 class="card-title">Daftar Hak Akses</h4>
                    	</div>
                        <div class="col-md-6 text-right">
                            <label>
                                <input type="checkbox" name="" class="checkall">
                            </label>
                            Pilih semua
                        </div>
                    </div>

                    <form action="{{ url('sysrole/update/'. $id) }}" method="POST">
                        @csrf

                    <div class="table-responsive">
                        <table id="dataTable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="40%">Modul</th>
                                    <th width="15%">Index</th>
                                    <th width="15%">Create</th>
                                    <th width="15%">View</th>
                                    <th width="15%">Edit</th>
                                    <th width="15%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($modules) == 0)
                                	<tr>
                                		<td colspan="7" align="center">Data modul kosong</td>
                                	</tr>
                                @else
                                	@foreach ($modules as $module)
                                        @php 
                                            $tasks  = explode(',', $module->task); 
                                            $ids    = explode(',', $module->taskid);
                                        @endphp
                                		<tr>
                                			<td width="5%">{{ $loop->iteration }}</td>
                                			<td width="40%">{{ $module->module_name }}</td>
                                            <td class="text-center">
                                                @if (in_array('index', $tasks))
                                                    @php 
                                                        $checked = "";
                                                        $index   = array_search('index', $tasks);

                                                        if(in_array($ids[$index], $roleTasks)) $checked = "checked='checked'";
                                                    @endphp
                                                    <input class="check" type="checkbox" value="{{ $ids[$index] }}" name="task[]" {{ $checked }}>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (in_array('create', $tasks))
                                                    @php 
                                                        $checked = "";
                                                        $index   = array_search('create', $tasks);

                                                        if(in_array($ids[$index], $roleTasks)) $checked = "checked='checked'";
                                                    @endphp
                                                    <input class="check" type="checkbox" value="{{ $ids[$index] }}" name="task[]" {{ $checked }}>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (in_array('view', $tasks))
                                                    @php 
                                                        $checked = "";
                                                        $index   = array_search('view', $tasks);

                                                        if(in_array($ids[$index], $roleTasks)) $checked = "checked='checked'";
                                                    @endphp
                                                    <input class="check" type="checkbox" value="{{ $ids[$index] }}" name="task[]" {{ $checked }}>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (in_array('edit', $tasks))
                                                    @php 
                                                        $checked = "";
                                                        $index   = array_search('edit', $tasks);

                                                        if(in_array($ids[$index], $roleTasks)) $checked = "checked='checked'";
                                                    @endphp
                                                    <input class="check" type="checkbox" value="{{ $ids[$index] }}" name="task[]" {{ $checked }}>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (in_array('delete', $tasks))
                                                    @php 
                                                        $checked = "";
                                                        $index   = array_search('delete', $tasks);

                                                        if(in_array($ids[$index], $roleTasks)) $checked = "checked='checked'";
                                                    @endphp
                                                    <input class="check" type="checkbox" value="{{ $ids[$index] }}" name="task[]" {{ $checked }}>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                		</tr>
                                	@endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
@section('script')
<script type="text/javascript">
    $('.checkall').click(function(){

        if ($(this).is(':checked')) {
            $('.check').prop('checked', true);
        }
        else{
            $('.check').prop('checked', false);
        }

    });
</script>
@endsection
@endsection