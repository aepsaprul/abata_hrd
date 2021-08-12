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

					<h1>Data Lamaran</h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="#">Home</a></li>

						<li class="breadcrumb-item active">Lamaran</li>

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

						<!-- /.card-header -->

						<div class="card-body">

							<table id="example1" class="table table-bordered table-striped">

								<thead>

								<tr>

									<th>No</th>

									<th>Posisi</th>

									<th>Nama</th>

									<th>Telepon</th>

									<th>Email</th>

									<th>Status</th>

									<th>#</th>

								</tr>

								</thead>

								<tbody>

									@foreach ($lamarans as $key => $lamaran)

										

										<tr>

											<td class="nomor">{{ $key + 1 }}</td>

											<td>

												@if ($lamaran->master_jabatan_id == null)

														Kosong

												@else

													{{ $lamaran->masterJabatan->nama_jabatan }}

												@endif

											</td>

											<td>{{ $lamaran->nama_lengkap }}</td>

											<td>{{ $lamaran->telepon }}</td>

											<td>{{ $lamaran->email }}</td>



											

											

											<td class="text-center">

												@if ($lamaran->status_lamaran == 1)

														<b>{{ 'Persyaratan Masuk' }}</b> 

												@elseif ($lamaran->status_lamaran == 2)

														<b>{{ 'Mengisi Form Rekrutmen' }}</b> 

												@elseif ($lamaran->status_lamaran == 3)

														<b>{{ 'Form Rekrutmen Telah Diisi' }}</b>

													</td>

												@elseif ($lamaran->status_lamaran == 4)

													<b>{{ 'Gagal Interview' }}</b>

												@elseif ($lamaran->status_lamaran == 5)

													<b>{{ 'Lanjut Interview' }}</b>

												@elseif ($lamaran->status_lamaran == 6)

													<b>{{ 'Gagal' }}</b>

												@elseif ($lamaran->status_lamaran == 7)

													<b>{{ 'Terima' }}</b>

												@else 

													{{ '-' }}</td> 

												@endif

											</td>

											<td class="text-center">

												<div class="dropdown dropleft">

													<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

														<i class="fa fa-cog"></i>

													</button>

													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



														@if ($lamaran->status_lamaran == 1)

															@php $nomor_telepon =  substr($lamaran->telepon, 1,13); @endphp

															<a href="https://api.whatsapp.com/send?phone=+62{{ $nomor_telepon }}&text=Terima kasih dokumen lamaran anda sudah kami terima. Silahkan login kembali pada website untuk mengisi formulir data diri.



Silahkan klik link untuk menuju ke halaman login website : https://abata-printing.com/loker/" target="_blank" class="dropdown-item">WA</a>

															<a href="{{ route('lamaran.rekrutmen', [$lamaran->id]) }}" class="dropdown-item">Lanjut</a> 

														@elseif ($lamaran->status_lamaran == 2)

															<a href="{{ route('lamaran.rekrutmen', [$lamaran->id]) }}" class="dropdown-item">Lanjut</a> 

														@elseif ($lamaran->status_lamaran == 3)

														@php $nomor_telepon =  substr($lamaran->telepon, 1,13); @endphp

														<a href="https://api.whatsapp.com/send?phone=+62{{ $nomor_telepon }}&text=Terima kasih dokumen lamaran anda sudah kami terima. Silahkan login kembali pada website untuk mengisi formulir data diri.



Silahkan klik link untuk menuju ke halaman login website : https://abata-printing.com/loker/" target="_blank" class="dropdown-item">WA</a>

															<a href="{{ route('lamaran.gagal.interview', [$lamaran->id]) }}" class="dropdown-item">Gagal Interview</a>

															<a href="{{ route('lamaran.interview', [$lamaran->id]) }}" class="dropdown-item">Lanjut Interview</a> 

														@elseif ($lamaran->status_lamaran == 5)

															<a href="{{ route('lamaran.gagal', [$lamaran->id]) }}" class="dropdown-item">Gagal</a>

															<a href="{{ route('lamaran.terima', [$lamaran->id]) }}" class="dropdown-item">Terima</a>

														@else 

															

														@endif



														<a href="{{ route('lamaran.show', [$lamaran->id]) }}" class="dropdown-item" title="view">Detail</a>

														<a href="{{ route('lamaran.delete', [$lamaran->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')" title="hapus">Hapus</a>

													</div>

												</div>

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