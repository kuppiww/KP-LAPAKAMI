@extends('layouts.user')
@section('title')
    Hak Akses
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
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                    	<div class="col-md-12">
                    		<h4 class="card-title">Daftar Hak Akses</h4>
                    	</div>
                    </div>
                    <table id="dataTable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="80%">Grup</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($groups) == 0)
                                	<tr>
                                		<td colspan="3" align="center">Data kosong</td>
                                	</tr>
                                @else
                                	@foreach ($groups as $group)
                                		<tr>
                                			<td width="5%">{{ $loop->iteration }}</td>
                                			<td width="80%">{{ $group->group_name }}</td>
                                			<td width="15%">
                                				<a href="{{ url('sysrole/edit/'. $group->group_id ) }}" class="btn btn-sm btn-outline-secondary btnEdit">
                                					<i class="ri-edit-line fs-6"></i>
                                				</a>
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
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
@endsection