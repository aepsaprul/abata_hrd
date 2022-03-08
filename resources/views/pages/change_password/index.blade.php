@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ubah Password</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-4">

					<!-- general form elements -->
					<div class="card card-primary">
						<!-- form start -->
						<form method="POST" action="{{ route('change.password') }}">
							@csrf

                            <div class="card-body">
                                    @if (session('status'))
                                        <div class="text-success">
                                            <i>{{ session('status') }}</i>
                                        </div>
                                    @endif
                                    @foreach ($errors->all() as $error)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="password" class="text-danger">{{ $error }}</label>
                                            </div>
                                        </div>
                                    @endforeach
									<div class="row">
										<div class="col-md-12">
                                            <label for="current_password">Password Sekarang</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" required>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
                                            <label for="new_password">Password Baru</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
                                            <label for="new_confirm_password">Ulangi Password Baru</label>
                                            <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" required>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Update Password</button>
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
