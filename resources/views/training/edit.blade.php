@extends('layouts.app')



@section('style')



	<!-- daterange picker -->

  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

  <!-- Tempusdominus Bootstrap 4 -->

  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">



	<!-- Select2 -->

	<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">



	<style>

		input:focus{

				outline: none;

		}



		select {

			padding: 0;

			margin: 0;

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

					<h1>Ubah Jadwal Training</h1>

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



					<!-- general form elements -->

					<div class="card card-primary">

						<div class="card-header">

							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/hc/training') }}">BACK</a></h3>

						</div>

						<!-- /.card-header -->

						<!-- form start -->

						<form role="form" action="{{ route('training.update', [$training->id]) }}" method="POST">

							@method('PUT')

							@csrf

								<div class="card-body">

									<div class="row">

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Kategori</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="kategori" id="kategori" style="border: none; width: 100%;" value="{{ $training->kategori }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Judul</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="judul" id="judul" style="border: none; width: 100%;" value="{{ $training->judul }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Divisi</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded">

													<select name="master_divisi_id" id="master_divisi_id" class="form-control p-0" style="border: none; width: 100%;">

														<option value="">-- Pilih Divisi --</option>

														@foreach ($divisis as $divisi)

																<option value="{{ $divisi->id }}" {{ $divisi->id == $training->master_divisi_id ? 'selected' : '' }}>{{ $divisi->nama }}</option>

														@endforeach

													</select>

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Tanggal</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded">

													<div class="input-group date" id="tanggal" data-target-input="nearest">

														<input type="text" class="form-control datetimepicker-input p-0" data-target="#tanggal" name="tanggal" style="border: none;" value="{{ $training->tanggal }}"/>

														<div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">

																<div class="input-group-text"><i class="fa fa-calendar"></i></div>

														</div>

													</div>

												</dd>

											</dl>

										</div>

									</div>

									

									<div class="row">

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Durasi</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="durasi" id="durasi" style="border: none; width: 100%;" value="{{ $training->durasi }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Peserta</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="peserta" id="peserta" style="border: none; width: 100%;" value="{{ $training->peserta }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Tempat</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="tempat" id="tempat" style="border: none; width: 100%;" value="{{ $training->tempat }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Goal</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="goal" id="goal" style="border: none; width: 100%;" value="{{ $training->goal }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

									</div>



									<div class="row">

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Pengisi</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="pengisi" id="pengisi" style="border: none; width: 100%;" value="{{ $training->pengisi }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Jenis</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded">

													<select name="jenis" id="jenis" class="form-control p-0" style="border: none; width: 100%;">

														<option value="">-- Pilih Divisi --</option>

														<option value="online" {{ $training->jenis == 'online' ? 'selected' : '' }}>ONLINE</option>

														<option value="offline" {{ $training->jenis == 'offline' ? 'selected' : '' }}>OFFLINE</option>

													</select>

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Hasil</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="hasil" id="hasil" style="border: none; width: 100%;" value="{{ $training->hasil }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

										<div class="col-md-3">

											<dl class="row">

												<dt class="col-sm-8">Status</dt>

												<dd class="col-sm-10 border-bottom border-warning rounded p-2">

													<input type="text" name="status" id="status" style="border: none; width: 100%;" value="{{ $training->status }}" onkeyup="this.value = this.value.toUpperCase()">

												</dd>

											</dl>

										</div>

									</div>

								</div>

								<div class="card-footer">

									<button type="submit" class="btn btn-primary">Submit</button>

								</div>

							</form>

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



<!-- InputMask -->

<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->

<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>



<!-- bs-custom-file-input -->

<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>



<!-- Select2 -->

<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>

  $(function () {



		// tanggal lahir

		$('#tanggal').datetimepicker({

				format: 'YYYY-MM-DD'

		});



  })

  

</script>



@endsection

