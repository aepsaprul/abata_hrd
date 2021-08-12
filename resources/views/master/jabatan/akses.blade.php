@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@endsection

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Menu Akses {{ $jabatan->nama_jabatan }}</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Menu Akses</li>
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
						<form action="{{ route('jabatan.akses.simpan', [$jabatan->id]) }}" method="POST">
							@method('PUT')
							@csrf
							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Main Menu</th>
										<th>Sub Menu</th>
									</tr>
									</thead>
									<tbody>
										@foreach ($main_menus as $key => $menu)
											
											<tr>
												<td>
													{{ $menu->nama_menu }}
												</td>
												<td>
													@foreach ($sub_menus as $sub_menu)
													<ul style="list-style: none;">
														@if ($sub_menu->root_menu == $menu->id)														
																<li>
																	<div class="icheck-primary d-inline">
																		<input type="checkbox" id="menu{{ $sub_menu->id }}" name="menu[]" value="{{ $sub_menu->id }}"
																		{{-- {{ in_array($sub_menu->id, json_decode($jabatan->menu_akses)) ? "checked" : "" }} --}}
																		@foreach ($jabatanMenu as $jabatanMenune)
																				@if ($jabatanMenune->master_menu_id == $sub_menu->id)
																						{{ 'checked' }}
																				@endif
																		@endforeach
																		>
																		<label for="menu{{ $sub_menu->id }}">
																			{{ $sub_menu->nama_menu }}
																		</label>
																	</div>
																</li>														
														@endif
													</ul>
													@endforeach
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
							<div class="card-header">
								<button type="submit" class="btn btn-primary">Simpan</button>
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

@endsection