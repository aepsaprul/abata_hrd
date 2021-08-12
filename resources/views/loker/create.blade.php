@extends('layouts.app')

@section('style')
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Tambah Loker</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/hc/loker') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('loker.store') }}" method="POST">
							@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Posisi Loker</label>
												<select class="form-control select2bs4" name="master_jabatan_id" style="width: 100%;">
													@foreach ($jabatans as $jabatan)
														<option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
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

<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
		//Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
  
</script>

@endsection
