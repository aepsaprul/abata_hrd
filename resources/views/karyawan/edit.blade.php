@extends('layouts.app')

@section('style')

  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

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
					<h1>Ubah Karyawan</h1>
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

					<form role="form" action="{{ route('karyawan.update', [$karyawan->id]) }}" method="POST" enctype="multipart/form-data">
						@method('PUT')
						@csrf

						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/karyawan') }}">BACK</a></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-12 text-center">
												@if ($karyawan->foto)
														<img src="{{ asset('laravel/storage/app/public/' . $karyawan->foto) }}" style="max-width: 200px;">
												@else
													<img src="{{ asset('assets/img/no-image.jpg') }}" alt="no-image">
												@endif
											</div>
											<div class="col-md-12 mt-3">
												<dl class="row">
													<dt class="col-sm-8 ml-3">Ganti Foto</dt>
													<dd class="col-sm-10 rounded">
														<input type="file" name="foto" class="form-control pl-0 ml-4" id="foto" style="border: none; width: 100%;">
													</dd>
												</dl>
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-4">
												<dl class="row">
													<dt class="col-sm-8">Nama Lengkap</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="nama_lengkap" id="nama_lengkap" style="border: none; width: 100%;" value="{{ $karyawan->nama_lengkap }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Nama Panggilan</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="nama_panggilan" id="nama_panggilan" style="border: none; width: 100%;" value="{{ $karyawan->nama_panggilan }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Telepon</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="telepon" id="telepon" style="border: none; width: 100%;" value="{{ $karyawan->telepon }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Cabang</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<select name="master_cabang_id" id="master_cabang_id" class="form-control p-0" style="border: none; width: 100%;">
															@foreach ($cabangs as $cabang)
																	<option value="{{ $cabang->id }}" {{ $cabang->id == $karyawan->master_cabang_id ? 'selected' : ' ' }}>{{ $cabang->nama_cabang }}</option>
															@endforeach
														</select>
													</dd>
													<dt class="col-sm-8">Jabatan</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<select name="master_jabatan_id" id="master_jabatan_id" class="form-control p-0" style="border: none; width: 100%;">
															@foreach ($jabatans as $jabatan)
																	<option value="{{ $jabatan->id }}" {{ $jabatan->id == $karyawan->master_jabatan_id ? 'selected' : ' ' }}>{{ $jabatan->nama_jabatan }}</option>
															@endforeach
														</select>
													</dd>
												</dl>
											</div>
											<div class="col-md-4">
												<dl class="row">
													<dt class="col-sm-8">Email</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="email" id="email" style="border: none; width: 100%;" value="{{ $karyawan->email }}" onkeyup="this.value = this.value.toLowerCase()">
													</dd>
													<dt class="col-sm-8">Nomor KTP</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="number" name="nomor_ktp" id="nomor_ktp" style="border: none; width: 100%;" value="{{ $karyawan->nomor_ktp }}">
													</dd>
													<dt class="col-sm-8">Nomor SIM</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="nomor_sim" id="nomor_sim" style="border: none; width: 100%;" value="{{ $karyawan->nomor_sim }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Jenis Kelamin</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<select name="jenis_kelamin" id="jenis_kelamin" class="form-control p-0" style="border: none; width: 100%;">
															<option value="">-- Pilih Jenis Kelamin --</option>
															<option value="L" @if ( $karyawan->jenis_kelamin == "L" ) {{ "selected" }} @endif>LAKI - LAKI</option>
															<option value="P" @if ( $karyawan->jenis_kelamin == "P" ) {{ "selected" }} @endif>PEREMPUAN</option>
														</select>
													</dd>
													<dt class="col-sm-8">Alamat KTP</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="alamat_ktp" id="alamat_ktp" style="border: none; width: 100%;" value="{{ $karyawan->alamat_asal }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
												</dl>
											</div>
											<div class="col-md-4">
												<dl class="row">
													<dt class="col-sm-8">Tempat Lahir</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="tempat_lahir" id="tempat_lahir" style="border: none; width: 100%;" value="{{ $karyawan->tempat_lahir }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Tanggal Lahir</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<div class="input-group date" id="tanggal_lahir" data-target-input="nearest">
															<input type="text" class="form-control datetimepicker-input p-0" data-target="#tanggal_lahir" name="tanggal_lahir" style="border: none;" value="{{ $karyawan->tanggal_lahir }}"/>
															<div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
																	<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</dd>
													<dt class="col-sm-8">Agama</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<select name="agama" id="agama" class="form-control p-0" style="border: none; width: 100%;">
															<option value="">-- Pilih Agama --</option>
															<option value="ISLAM" @if ( $karyawan->agama == "ISLAM" ) {{ "selected" }} @endif>ISLAM</option>
															<option value="KRISTEN" @if ( $karyawan->agama == "KRISTEN" ) {{ "selected" }} @endif>KRISTEN</option>
															<option value="HINDU" @if ( $karyawan->agama == "HINDU" ) {{ "selected" }} @endif>HINDU</option>
															<option value="BUDHA" @if ( $karyawan->agama == "BUDHA" ) {{ "selected" }} @endif>BUDHA</option>
														</select>
													</dd>
													<dt class="col-sm-8">Alamat Sekarang</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded p-2">
														<input type="text" name="alamat_sekarang" id="alamat_sekarang" style="border: none; width: 100%;" value="{{ $karyawan->alamat_domisili }}" onkeyup="this.value = this.value.toUpperCase()">
													</dd>
													<dt class="col-sm-8">Status Perkawinan</dt>
													<dd class="col-sm-10 border-bottom border-warning rounded">
														<select name="status_perkawinan" id="status_perkawinan" class="form-control p-0" style="border: none; width: 100%;">
															<option value="">-- Pilih Status --</option>
															<option value="1" @if ( $karyawan->status_perkawinan == "1" ) {{ "selected" }} @endif>LAJANG</option>
															<option value="2" @if ( $karyawan->status_perkawinan == "2" ) {{ "selected" }} @endif>MENIKAH</option>
															<option value="3" @if ( $karyawan->status_perkawinan == "3" ) {{ "selected" }} @endif>CERAI</option>
														</select>
													</dd>
												</dl>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						{{-- kontrak  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">kontrak</h5>
								<hr>
								<div id="kontrak">
									<div class="row">
										<div class="col-md-4">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Mulai Kontrak</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded pl-0 ml-4">
													<div class="input-group date" id="mulai_kontrak" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#mulai_kontrak" name="mulai_kontrak" style="border: none;" value="{{ $kontrak->mulai_kontrak }}"/>
														<div class="input-group-append" data-target="#mulai_kontrak" data-toggle="datetimepicker">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</dd>
											</dl>
										</div>
										<div class="col-md-4">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Akhir Kontrak</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded pl-0 ml-4">
													<div class="input-group date" id="akhir_kontrak" data-target-input="nearest">
														<input type="text" class="form-control datetimepicker-input" data-target="#akhir_kontrak" name="akhir_kontrak" style="border: none;" value="{{ $kontrak->akhir_kontrak }}"/>
														<div class="input-group-append" data-target="#akhir_kontrak" data-toggle="datetimepicker">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</dd>
											</dl>
										</div>
										<div class="col-md-3">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Lama Kontrak</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded pl-0 ml-4">
													<input type="text" name="lama_kontrak" class="form-control" id="lama_kontrak" style="border: none; width: 100%;" onkeyup="this.value = this.value.toUpperCase()" value="{{ $kontrak->lama_kontrak }}">
												</dd>
											</dl>
										</div>
										<div class="col-md-1 text-right">
											<!--<button id="kontrak_add" class="kontrak_add btn btn-success mt-4"><i class="fa fa-plus"></i></button>-->
										</div>
									</div>
								</div>
							</div>
						</div>

						{{-- media sosial  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">media sosial</h5>
								<hr>
								<div class="row">
									<div class="col-md-3">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Facebook</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="facebook" id="facebook" style="border: none; width: 100%;"
												@if (!empty($medsos))
													value="{{ $medsos->facebook }}"
												@endif
												>
											</dd>
										</dl>
									</div>
									<div class="col-md-3">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Instagram</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="instagram" id="instagram" style="border: none; width: 100%;"
												@if (!empty($medsos))
													value="{{ $medsos->instagram }}"
												@endif
												>
											</dd>
										</dl>
									</div>
									<div class="col-md-3">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Youtube</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="youtube" id="youtube" style="border: none; width: 100%;"
												@if (!empty($medsos))
													value="{{ $medsos->youtube }}"
												@endif
												>
											</dd>
										</dl>
									</div>
									<div class="col-md-3">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Linkedin</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="linkedin" id="linkedin" style="border: none; width: 100%;"
												@if (!empty($medsos))
													value="{{ $medsos->linkedin }}"
												@endif
												>
											</dd>
										</dl>
									</div>
								</div>
							</div>
						</div>

						{{-- susunan keluarga sebelum menikah  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">susunan keluarga sebelum menikah <button id="add" class="add btn btn-success"><i class="fa fa-plus"></i></button></h5>
								<hr>
								@foreach ($keluarga_sebelum_menikahs as $keluarga_sebelum_menikah)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Hubungan</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_sebelum_menikah_hubungan[]" style="border: none; width: 100%;"
                                                    @if ($keluarga_sebelum_menikah)
                                                            value="{{ $keluarga_sebelum_menikah->hubungan }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Nama</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_sebelum_menikah_nama[]" style="border: none; width: 100%;"
                                                    @if ($keluarga_sebelum_menikah)
                                                            value="{{ $keluarga_sebelum_menikah->nama }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-1">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Usia</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_sebelum_menikah_usia[]" style="border: none; width: 100%;"
                                                    @if ($keluarga_sebelum_menikah)
                                                            value="{{ $keluarga_sebelum_menikah->usia }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Pendidikan Terakhir</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_sebelum_menikah_pendidikan_terakhir[]" style="border: none; width: 100%;"
                                                    @if ($keluarga_sebelum_menikah)
                                                            value="{{ $keluarga_sebelum_menikah->pendidikan_terakhir }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Pekerjaan Terakhir</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_sebelum_menikah_pekerjaan_terakhir[]" style="border: none; width: 100%;"
                                                    @if ($keluarga_sebelum_menikah)
                                                            value="{{ $keluarga_sebelum_menikah->pekerjaan_terakhir }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
								@endforeach
								<div id="keluarga_sebelum_menikah">

								</div>
							</div>
						</div>

						{{-- keluarga setelah menikah  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">susuan keluarga setelah menikah <button id="keluarga_setelah_menikah_add" class="keluarga_setelah_menikah_add btn btn-success"><i class="fa fa-plus"></i></button></h5>
								<hr>
                                @foreach ($keluarga_setelah_menikahs as $keluarga_setelah_menikah)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Hubungan</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_setelah_menikah_hubungan[]" style="border: none; width: 100%;"
                                                    @if (!empty($keluarga_setelah_menikah))
                                                            value="{{ $keluarga_setelah_menikah->hubungan }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Nama</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_setelah_menikah_nama[]" style="border: none; width: 100%;"
                                                    @if (!empty($keluarga_setelah_menikah))
                                                            value="{{ $keluarga_setelah_menikah->nama }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Tempat Lahir</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_setelah_menikah_tempat_lahir[]" style="border: none; width: 100%;"
                                                    @if (!empty($keluarga_setelah_menikah))
                                                            value="{{ $keluarga_setelah_menikah->tempat_lahir }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-2">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Tanggal Lahir</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_setelah_menikah_tanggal_lahir[]" style="border: none; width: 100%;"
                                                    @if (!empty($keluarga_setelah_menikah))
                                                            value="{{ $keluarga_setelah_menikah->tanggal_lahir }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-3">
                                            <dl class="row">
                                                <dt class="col-sm-8 ml-3">Pekerjaan Terakhir</dt>
                                                <dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
                                                    <input type="text" name="keluarga_setelah_menikah_pekerjaan_terakhir[]" style="border: none; width: 100%;"
                                                    @if (!empty($keluarga_setelah_menikah))
                                                            value="{{ $keluarga_setelah_menikah->pekerjaan_terakhir }}"
                                                    @endif
                                                        onkeyup="this.value = this.value.toUpperCase()">
                                                </dd>
                                            </dl>
                                        </div>
                                @endforeach
								<div id="keluarga_setelah_menikah">

								</div>
								</div>
							</div>
						</div>

						{{-- kerabat darurat  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">kerabat yg bisa dihubungi saat darurat</h5>
								<hr>
								<div id="kerabat_darurat">
									<div class="row">
										<div class="col-md-2">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Hubungan</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
													<input type="text" name="kerabat_darurat_hubungan[]" style="border: none; width: 100%;"
													@if (!empty($kerabat_darurat))
															value="{{ $kerabat_darurat->hubungan }}"
													@endif
													 onkeyup="this.value = this.value.toUpperCase()">
												</dd>
											</dl>
										</div>
										<div class="col-md-2">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Nama</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
													<input type="text" name="kerabat_darurat_nama[]" style="border: none; width: 100%;"
													@if (!empty($kerabat_darurat))
															value="{{ $kerabat_darurat->nama }}"
													@endif
													 onkeyup="this.value = this.value.toUpperCase()">
												</dd>
											</dl>
										</div>
										<div class="col-md-2">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Jenis Kelamin</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
													<input type="text" name="kerabat_darurat_jenis_kelamin[]" style="border: none; width: 100%;"
													@if (!empty($kerabat_darurat))
															value="{{ $kerabat_darurat->jenis_kelamin }}"
													@endif
													 onkeyup="this.value = this.value.toUpperCase()">
												</dd>
											</dl>
										</div>
										<div class="col-md-2">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Telepon</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
													<input type="text" name="kerabat_darurat_telepon[]" style="border: none; width: 100%;"
													@if (!empty($kerabat_darurat))
															value="{{ $kerabat_darurat->telepon }}"
													@endif
													 onkeyup="this.value = this.value.toUpperCase()">
												</dd>
											</dl>
										</div>
										<div class="col-md-3">
											<dl class="row">
												<dt class="col-sm-8 ml-3">Alamat</dt>
												<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
													<input type="text" name="kerabat_darurat_alamat[]" style="border: none; width: 100%;"
													@if (!empty($kerabat_darurat))
															value="{{ $kerabat_darurat->alamat }}"
													@endif
													 onkeyup="this.value = this.value.toUpperCase()">
												</dd>
											</dl>
										</div>
										<div class="col-md-1 text-right">
											<!--<button id="kerabat_darurat_add" class="kerabat_darurat_add btn btn-success mt-4"><i class="fa fa-plus"></i></button>-->
										</div>
									</div>
								</div>
							</div>
						</div>

						{{-- pendidikan  --}}

						<div class="card card-primary">
							<div class="card-body">
								<h5 class="text-center text-uppercase mb-3">pendidikan</h5>
								<hr>
								<div class="row">
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Tingkat</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_tingkat" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->tingkat }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Nama</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_gedung" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->nama }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Kota</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_kota" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->kota }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Jurusan</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_jurusan" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->jurusan }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Tahun Masuk</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_tahun_masuk" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->tahun_masuk }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
									<div class="col-md-2">
										<dl class="row">
											<dt class="col-sm-8 ml-3">Tahun Lulus</dt>
											<dd class="col-sm-10 border-bottom border-warning rounded ml-4 p-2">
												<input type="text" name="pendidikan_tahun_lulus" style="border: none; width: 100%;"
												@if (!empty($pendidikan))
														value="{{ $pendidikan->tahun_lulus }}"
												@endif
												 onkeyup="this.value = this.value.toUpperCase()">
											</dd>
										</dl>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-md-3">
										<button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
									</div>
								</div>
							</div>
						</div>
					</form>

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

<script type="text/javascript">

	$(function () {
		// tanggal lahir
		$('#tanggal_lahir').datetimepicker({
				format: 'YYYY-MM-DD'
		});

		// mulai kontrak
		$('#mulai_kontrak').datetimepicker({
				format: 'YYYY-MM-DD'
		});

		// akhir kontrak
		$('#akhir_kontrak').datetimepicker({
				format: 'YYYY-MM-DD'
		});

	});

	$(document).ready(function () {

		bsCustomFileInput.init();

		$('#add').on('click', function(e) {

			e.preventDefault();

			var keluarga_sebelum_menikah_value = "" +
			"<div id=\"keluarga_sebelum_menikah_root\" class=\"keluarga_sebelum_menikah_root\">" +
				"<div class=\"row\">" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Hubungan</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_sebelum_menikah_hubungan[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Nama</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_sebelum_menikah_nama[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-1\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Usia</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_sebelum_menikah_usia[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-3\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Pendidikan Terakhir</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_sebelum_menikah_pendidikan_terakhir[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-3\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Pekerjaan Terakhir</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_sebelum_menikah_pekerjaan_terakhir[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-1 text-right\">" +
						"<button id=\"remove\" class=\"btn btn-danger mt-4\"><i class=\"fa fa-times\"></i></button>" +
					"</div>" +
				"</div>" +
			"</div>";

			$('#keluarga_sebelum_menikah').append(keluarga_sebelum_menikah_value);

		});

		$('#keluarga_sebelum_menikah').on('click','#remove',function(e){

			e.preventDefault();

			$('#keluarga_sebelum_menikah_root').remove();

		});

		$('#keluarga_setelah_menikah_add').on('click', function(e) {

			e.preventDefault();

			var keluarga_setelah_menikah_value = "" +
			"<div id=\"keluarga_setelah_menikah_root\" class=\"keluarga_setelah_menikah_root\">" +
				"<div class=\"row\">" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Hubungan</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_setelah_menikah_hubungan[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Nama</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_setelah_menikah_nama[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Tempat Lahir</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_setelah_menikah_tempat_lahir[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Tanggal Lahir</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_setelah_menikah_tanggal_lahir[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-3\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Pekerjaan Terakhir</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"keluarga_setelah_menikah_pekerjaan_terakhir[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-1 text-right\">" +
						"<button id=\"remove\" class=\"btn btn-danger mt-4\"><i class=\"fa fa-times\"></i></button>" +
					"</div>" +
				"</div>"
			"</div>";

			$('#keluarga_setelah_menikah').append(keluarga_setelah_menikah_value);

		});

		$('#keluarga_setelah_menikah').on('click', '#remove', function(e) {

			e.preventDefault();

			$('#keluarga_setelah_menikah_root').remove();

		});


		$('#kerabat_darurat_add').on('click', function(e) {

			e.preventDefault();

			var kerabat_darurat_value = "" +
			"<div id=\"kerabat_darurat_root\" class=\"kerabat_darurat_root\">" +
				"<div class=\"row\">" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Hubungan</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"kerabat_darurat_hubungan[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Nama</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"kerabat_darurat_nama[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Jenis Kelamin</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"kerabat_darurat_jenis_kelamin[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUperCase()\">" +

							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-2\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Telepon</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"kerabat_darurat_telepon[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-3\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Alamat</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded ml-4 p-2\">" +
								"<input type=\"text\" name=\"kerabat_darurat_alamat[]\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-1 text-right\">" +
						"<button id=\"remove\" class=\"btn btn-danger mt-4\"><i class=\"fa fa-times\"></i></button>" +
					"</div>" +
				"</div>" +
			"</div>";

			$('#kerabat_darurat').append(kerabat_darurat_value);

		});

		$('#kerabat_darurat').on('click', '#remove', function(e) {

			e.preventDefault();

			$('#kerabat_darurat_root').remove();

		});

		$('#kontrak_add').on('click', function(e) {

			e.preventDefault();

			var kontrak_value = "" +
			"<div id=\"kontrak_root\" class=\"kontrak_root\">" +
				"<div class=\"row\">" +
					"<div class=\"col-md-4\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Mulai Kontrak</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded pl-0 ml-4\">" +
								"<div class=\"input-group date\" id=\"mulai_kontrak\" data-target-input=\"nearest\">" +
									"<input type=\"text\" class=\"form-control datetimepicker-input\" data-target=\"#mulai_kontrak\" name=\"mulai_kontrak[]\" style=\"border: none;\"/>" +
									"<div class=\"input-group-append\" data-target=\"#mulai_kontrak\" data-toggle=\"datetimepicker\">" +
											"<div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div>" +
									"</div>" +
								"</div>" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-4\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Akhir Kontrak</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded pl-0 ml-4\">" +
								"<div class=\"input-group date\" id=\"akhir_kontrak\" data-target-input=\"nearest\">" +
									"<input type=\"text\" class=\"form-control datetimepicker-input\" data-target=\"#akhir_kontrak\" name=\"akhir_kontrak[]\" style=\"border: none;\"/>" +
									"<div class=\"input-group-append\" data-target=\"#akhir_kontrak\" data-toggle=\"datetimepicker\">" +
											"<div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div>" +
									"</div>" +
								"</div>" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-3\">" +
						"<dl class=\"row\">" +
							"<dt class=\"col-sm-8 ml-3\">Lama Kontrak</dt>" +
							"<dd class=\"col-sm-10 border-bottom border-warning rounded pl-0 ml-4\">" +
								"<input type=\"text\" name=\"lama_kontrak[]\" class=\"form-control\" id=\"lama_kontrak\" style=\"border: none; width: 100%;\" onkeyup=\"this.value = this.value.toUpperCase()\">" +
							"</dd>" +
						"</dl>" +
					"</div>" +
					"<div class=\"col-md-1 text-right\">" +
						"<button id=\"remove\" class=\"btn btn-danger mt-4\"><i class=\"fa fa-times\"></i></button>" +
					"</div>" +
				"</div>" +
			"</div>";

			$('#kontrak').append(kontrak_value);

		});

		$('#kontrak').on('click', '#remove', function(e) {

			e.preventDefault();

			$('#kontrak_root').remove();

		});

	});

</script>



@endsection
