@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<style>
	table thead tr th {
		text-align: center;
	}
	.nomor {
		text-align: center;
	}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Data Karyawan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Karyawan</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					@if(session('status'))
						<div class="alert alert-success">
								{{session('status')}}
						</div>
					@endif
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><a href="{{ route('karyawan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Nama Lengkap</th>
									<th>Telepon</th>
									<th>Email</th>
									<th>Cabang</th>
									<th>Jabatan</th>
									<th>#</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($karyawans as $key => $karyawan)
										<tr>
											<td class="nomor">{{ $key + 1 }}</td>
											<td>{{ $karyawan->nama_lengkap }}</td>
											<td>{{ $karyawan->telepon }}</td>
											<td>{{ $karyawan->email }}</td>
											<td>{{ $karyawan->masterCabang ? $karyawan->masterCabang->nama_cabang : '-' }}</td>
											<td>{{ $karyawan->masterJabatan ? $karyawan->masterJabatan->nama_jabatan : '-' }}</td>
											<td class="text-center">
												<a href="{{ route('karyawan.show', [$karyawan->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a> | <a href="{{ route('karyawan.edit', [$karyawan->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a> | <a href="{{ route('karyawan.delete', [$karyawan->id]) }}" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')


<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

</script>

@endsection
