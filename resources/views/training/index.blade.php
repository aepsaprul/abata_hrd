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

					<h1>Jadwal Training</h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="#">Home</a></li>

						<li class="breadcrumb-item active">Training</li>

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

							<h3 class="card-title"><a href="{{ route('training.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h3>

						</div>

						<!-- /.card-header -->

						<div class="card-body">

							<table id="example1" class="table table-bordered table-striped">

								<thead>

								<tr>

									<th>No</th>

									<th>Kategori</th>

									<th>Judul</th>

									<th>Divisi</th>

									<th>Tanggal</th>

									<th>Modul</th>

									<th>#</th>

								</tr>

								</thead>

								<tbody>

									@foreach ($trainings as $key => $training)

										

										<tr>

											<td class="nomor">{{ $key + 1 }}</td>

											<td>{{ $training->kategori }}</td>

											<td>{{ $training->judul }}</td>

											<td>{{ $training->masterDivisi->nama }}</td>

											<td>{{ $training->tanggal }}</td>

											<td class="text-center">

											    @php $modul = explode('/', $training->modul); @endphp

											    <a href="{{ route('training.cek.datamodul', [$modul[1]]) }}">download</a>

										    </td>

											<td class="text-center">

												<!--<a href="{{ route('training.show', [$training->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a> | -->

												<a href="{{ route('training.edit', [$training->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a> | 

												<a href="{{ route('training.delete', [$training->id]) }}" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"><i class="fa fa-trash"></i></a>

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