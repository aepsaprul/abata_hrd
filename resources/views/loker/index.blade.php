@extends('layouts.app')



@section('style')



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

					<h1>Data Loker</h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="#">Home</a></li>

						<li class="breadcrumb-item active">Loker</li>

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

							<h3 class="card-title"><a href="{{ route('loker.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h3>

						</div>

						<!-- /.card-header -->

						<div class="card-body">

							<table id="example1" class="table table-bordered table-striped">

								<thead>

								<tr>

									<th>No</th>

									<th>Jabatan</th>

									<th>#</th>

								</tr>

								</thead>

								<tbody>

									@foreach ($lokers as $key => $loker)



										<tr>

											<td class="nomor">{{ $key + 1 }}</td>

											<td>{{ $loker->masterJabatan->nama_jabatanq }}</td>

											<td class="text-center">

												<a href="{{ route('loker.edit', [$loker->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a> | <a href="{{ route('loker.delete', [$loker->id]) }}" class="btn btn-danger" onclick="return confirm('Yakin akan dihapus?')"><i class="fa fa-trash"></i></a>

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



@endsection
