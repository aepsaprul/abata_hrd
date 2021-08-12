@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<style>
	table thead tr th {
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
					<h1>Data Cuti</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Cuti</li>
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
							<h3 class="card-title"><a href="{{ route('cir.create_cuti') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Jenis Cuti</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($cutis as $key => $cuti)
										
										<tr>
											<td class="text-center">{{ $key + 1 }}</td>
											<td>{{ $cuti->jenis }}</td>
											<td>
												@if ($cuti->status == 1)
													Terkirim
												@elseif ($cuti->status == 2)
													Acc Atasan Langsung
												@elseif ($cuti->status == 3)
													Ditolak Atasan Langsung
												@elseif ($cuti->status == 4)
													Acc HC
												@else
													Ditolak HC
												@endif
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