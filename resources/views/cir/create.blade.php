@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

	
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Tambah Formulir</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/hc/cir') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('cir.store') }}" method="POST">
							@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama</label>
												<select class="form-control select2bs4" name="master_karyawan_id" style="width: 100%;">
													<option value="">--Pilih Nama--</option>
													@foreach ($karyawans as $karyawan)
														<option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Atasan Langsung</label>
												<select class="form-control select2bs4" name="atasan" style="width: 100%;">
													<option value="">--Pilih Nama--</option>
													@foreach ($karyawans as $karyawan)
														<option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Pilih Formulir</label>
												<select id="jenis" class="form-control" name="jenis" style="width: 100%;">
													<option value="">--Pilih Formulir--</option>
													<option value="cuti">Cuti</option>
													<option value="resign">Resign</option>
												</select>
											</div>
										</div>
									</div>

									{{-- formulir cuti  --}}
									<div id="formulir_cuti">
										<table class="table table-bordered">
											<tr>
												<td><label>Bagian</label></td>
												<td>:</td>
												<td>
													<select name="master_jabatan_id" id="master_jabatan_id" class="form-control">
														<option value="">--Pilih Bagian--</option>
														@foreach ($jabatans as $jabatan)
																<option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
														@endforeach
													</select>
												</td>
											</tr>
											<tr>
												<td><label>No Telp yg aktif</label></td>
												<td>:</td>
												<td><input type="number" name="cuti_telepon" id="cuti_telepon" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Alamat saat Cuti</label></td>
												<td>:</td>
												<td><input type="text" name="cuti_alamat" id="cuti_alamat" class="form-control"></td>
											</tr>
										</table>
						
										<label for="">Menerangkan dengan ini bahwa saya bermaksud untuk mengambil cuti :</label>
										<ul style="list-style-type: none;">
											<li><input type="radio" name="cuti_jenis" id="cuti_jenis" value="melahirkan"> Melahirkan</li>
											<li><input type="radio" name="cuti_jenis" id="cuti_jenis" value="tahunan"> Tahunan</li>
											<li><input type="radio" name="cuti_jenis" id="cuti_jenis" value="kematian"> Kematian</li>
											<li><input type="radio" name="cuti_jenis" id="cuti_jenis" value="menikah"> Menikah</li>
											<li><input type="radio" name="cuti_jenis" id="cuti_jenis" value="lainnya"> Lainnya</li>
										</ul>
						
										<table class="table table-bordered">
											<tr>
												<td>Tanggal</td>
												<td>
													<div class="row">
														<div class="col-md-6">
															<input type="text" name="cuti_tanggal_mulai" id="cuti_tanggal_mulai" class="form-control" placeholder="Tanggal Mulai">
														</div>
														<div class="col-md-6">
															<input type="text" name="cuti_tanggal_berakhir" id="cuti_tanggal_berakhir" class="form-control" placeholder="Tanggal Berakhir">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>Nama karyawan pengganti saat cuti adalah</td>
												<td>
													<select class="form-control select2bs4" name="cuti_pengganti" style="width: 100%;">
														<option value="">--Kosong--</option>
														@foreach ($karyawans as $karyawan)
															<option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }}</option>
														@endforeach
													</select>
												</td>
											</tr>
											<tr>
												<td>Alasan Cuti (secara lebih detail)</td>
												<td><input type="text" name="cuti_alasan" id="cuti_alasan" class="form-control"></td>
											</tr>
											<tr>
												<td>Dan saya bersedia berangkat kerja lagi mulai tanggal</td>
												<td><input type="text" name="cuti_tanggal_kerja" id="cuti_tanggal_kerja" class="form-control"></td>
											</tr>
										</table>
									</div>

									{{-- formulir resign  --}}
									<div id="formulir_resign">
										<table class="table table-bordered">
											<tr>
												<td>Jabatan</td>
												<td>:</td>
												<td>
													<select name="resign_jabatan" id="resign_jabatan" class="form-control">
														<option value="">--Pilih Bagian--</option>
														@foreach ($jabatans as $jabatan)
																<option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
														@endforeach
													</select>
												</td>
											</tr>
											<tr>
												<td>Lokasi Kerja</td>
												<td>:</td>
												<td><input type="text" name="resign_lokasi" id="resign_lokasi" class="form-control"></td>
											</tr>
											<tr>
												<td>Tanggal Masuk</td>
												<td>:</td>
												<td><input type="text" name="resign_tanggal_masuk" id="resign_tanggal_masuk" class="form-control"></td>
											</tr>
											<tr>
												<td>Tanggal Efektif Keluar</td>
												<td>:</td>
												<td><input type="text" name="resign_tanggal_keluar" id="resign_tanggal_keluar" class="form-control"></td>
											</tr>
											<tr>
												<td>Alamat Rumah yang ditempati</td>
												<td>:</td>
												<td><input type="text" name="resign_alamat" id="resign_alamat" class="form-control"></td>
											</tr>
											<tr>
												<td>No Telp / HP</td>
												<td>:</td>
												<td><input type="text" name="resign_telepon" id="resign_telepon" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="3">
													<ol>
														<li style="text-align: justify">
															Saya menyatakan segala data yang berhubungan dengan perusahaan Abata dalam bentuk dokumen tertulis,data dalam social media yang tertuang dalam aplikasi WhatsApp,email, faceboook, Instagram ataupun media social lainnya yang berhubungan dengan Abata dan/atau informasi yang saya terima selama saya bekerja di Abata baik secara langsung maupun tidak langsung adalah bukan menjadi hak saya, dan tidak akan memberikan kepada siapapun dalam bentuk apapun tanpa izin dari Abata serta bersedia untuk menghapus,memusnahkan dan/atau mengembalikan semua data yang telah menjadi millik dan hak Abata dalam bentuk apapun dan saya akan tetap bertanggung jawab untuk tetap menjaga kerahasiaan perusahaan
														</li>
														<li style="text-align: justify">
															Saya menyatakan sebelum efektif keluar untuk menyelesaikan segala kewajiban keuangan dan lainnya yang saya miliki terhadap Abata dan apabila sampai dengan tanggal efektif saya keluar segala kewajiban tersebut belum terselesaikan dengan baik maka saya bersedia untuk dilakukan penyelesaian kewajiban tersebut sampai dengan selesai dan jika tidak dapat diselesaikan dengan secara kekeluargaan saya bersedia diselesaikan melalui proses hukum yang berlaku di Indonesia
														</li>
														<li style="text-align: justify">
															Daftar Penyelesaian Kewajiban Karyawan (lakukan checklist jika sudah dilakukan penyelesaian coret tidak perlu)
															<table class="mt-3">
																<tr>
																	<td>Kewajiban keuangan</td>
																	<td><input type="radio" name="resign_radio_kewajiban_keuangan" id="resign_radio_kewajiban_keuangan"> Ada / <input type="radio" name="resign_radio_kewajiban_keuangan" id="resign_radio_kewajiban_keuangan"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_kewajiban_keuangan" id="resign_tanggal_kewajiban_keuangan" class="form-control"></td>
																</tr>
																<tr>
																	<td>Serah terima kerja</td>
																	<td><input type="radio" name="resign_radio_serah_terima" id="resign_radio_serah_terima"> Ada / <input type="radio" name="resign_radio_serah_terima" id="resign_radio_serah_terima"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_serah_terima" id="resign_tanggal_serah_terima" class="form-control"></td>
																</tr>
																<tr>
																	<td>ID Card karyawan</td>
																	<td><input type="radio" name="resign_radio_id_card" id="resign_radio_id_card"> Ada / <input type="radio" name="resign_radio_id_card" id="resign_radio_id_card"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_id_card" id="resign_tanggal_id_card" class="form-control"></td>
																</tr>
																<tr>
																	<td>Seragam karyawan</td>
																	<td><input type="radio" name="resign_radio_seragam_karyawan" id="resign_radio_seragam_karyawan"> Ada / <input type="radio" name="resign_radio_seragam_karyawan" id="resign_radio_seragam_karyawan"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_seragam_karyawan" id="resign_tanggal_seragam_karyawan" class="form-control"></td>
																</tr>
																<tr>
																	<td>Laptop</td>
																	<td><input type="radio" name="resign_radio_laptop" id="resign_radio_laptop"> Ada / <input type="radio" name="resign_radio_laptop" id="resign_radio_laptop"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_laptop" id="resign_tanggal_laptop" class="form-control"></td>
																</tr>
																<tr>
																	<td>Peralatan kantor</td>
																	<td><input type="radio" name="resign_radio_peralatan_kantor" id="resign_radio_peralatan_kantor"> Ada / <input type="radio" name="resign_radio_peralatan_kantor" id="resign_radio_peralatan_kantor"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_peralatan_kantor" id="resign_tanggal_peralatan_kantor" class="form-control"></td>
																</tr>
																<tr>
																	<td>Penghapusan email dan akun yg berhubungan dengan kantor</td>
																	<td><input type="radio" name="resign_radio_penghapusan_akun" id="resign_radio_penghapusan_akun"> Ada / <input type="radio" name="resign_radio_penghapusan_akun" id="resign_radio_penghapusan_akun"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_penghapusan_akun" id="resign_tanggal_penghapusan_akun" class="form-control"></td>
																</tr>
																<tr>
																	<td>Penghapusan chat WA</td>
																	<td><input type="radio" name="resign_radio_penghapusan_chat" id="resign_radio_penghapusan_chat"> Ada / <input type="radio" name="resign_radio_penghapusan_chat" id="resign_radio_penghapusan_chat"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_penghapusan_chat" id="resign_tanggal_penghapusan_chat" class="form-control"></td>
																</tr>
																<tr>
																	<td>Penutupan rekening bank berhubungan dengan kantor</td>
																	<td><input type="radio" name="resign_radio_penutupan_rekening" id="resign_radio_penutupan_rekening"> Ada / <input type="radio" name="resign_radio_penutupan_rekening" id="resign_radio_penutupan_rekening"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_penutupan_rekening" id="resign_tanggal_penutupan_rekening" class="form-control"></td>
																</tr>
																<tr>
																	<td>Lain lain</td>
																	<td><input type="radio" name="resign_radio_lain" id="resign_radio_lain"> Ada / <input type="radio" name="resign_radio_lain" id="resign_radio_lain"> Tidak</td>
																	<td>Tgl Selesai : <input type="text" name="resign_tanggal_lain" id="resign_tanggal_lain" class="form-control"></td>
																</tr>
															</table>
														</li>
													</ol>
												</td>
											</tr>
										</table>
										<label>Pilihlah satu diantara Sangat Tidak Setuju sampai dengan Sangat Setuju pada setiap pernyataan berikut ini:</label>
										<table class="table table-bordered">
											<tr>
												<th class="text-center" colspan="2" style="width: 50%">ASPEK KEBUTUHAN DASAR</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>1.</td>
												<td>Secara umum saya merasa puas selama bekerja di Abata/Wahana/perfecta Utama</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>2.</td>
												<td>Saya tahu apa yang diharapkan atasan dan perusahaan kepada saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>3.</td>
												<td>Atasan saya memberikan pengarahan yang jelas mengenai target kerja yang harus saya capai.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>4.</td>
												<td>Saya memiliki peralatan bantu yang memadai untuk menyelesaikan setiap tugas saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>5.</td>
												<td>Waktu kerja yang saya miliki sesuai dengan beban pekerjaan saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<th class="text-center" colspan="2">ASPEK TIM KERJA</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>6.</td>
												<td>Rekan tim kerja saya menghargai pendapat saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>7.</td>
												<td>Rekan tim kerja saya selalu memberikan hasil terbaik dalam bekerja.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>8.</td>
												<td>Di tim kerja, saya memiliki sahabat yang dapat saya ajak bertukar pikirandan berbicara secara personal.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>9.</td>
												<td>Saya mengenal secara pribadi setiap anggota tim kerja saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>10.</td>
												<td>Saya paham arti penting pekerjaan saya dalam upaya pencapaian Misi dan Visi.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<th class="text-center" colspan="2">ASPEK KONTRIBUSI</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>11.</td>
												<td>Saya memiliki ketrampilan dan keahlian yang memadai untuk	menyelesaikan tugas sehari-hari saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>12.</td>
												<td>Atasan saya selalu memberikan pujian atau penghargaan setiap sayamelakukan pekerjaan dengan baik.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>13.</td>
												<td>Atasan saya memberikan bimibingan kepada saya secara teratur.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>14.</td>
												<td>Rekan kerja dan atasan saya peduli kepada saya sebagai seorang manusia.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>15.</td>
												<td>Atasan atau rekan kerja saya selalu mendorong dan mendukung saya untuk berkembang.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>16.</td>
												<td>Saya memiliki kesempatan untuk melakukan pekerjaan sesuai dengan bakat yang saya miliki.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<th class="text-center" colspan="2">ASPEK PERUSAHAAN</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>17.</td>
												<td>Setiap orang di perusahaan ini diberikan kesempatan yang sama tanpa menghiraukan latar belakang etnis, gender, usia, ketidak-mampuan, atau perbedaan lainnya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>18.</td>
												<td>Para rekan kerja saya selalu saling terbuka dan jujur (kecuali terhadap kerahasiaan bisnis).</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>19.</td>
												<td>Saya akan merekomendasikan kepada teman dan keluargasebagai tempat yang menyenangkan untuk bekerja.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<th class="text-center" colspan="2">ASPEK PENGEMBANGAN</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>20.</td>
												<td>Atasan saya memberitahu saya tentang kemajuan yang saya capai dalam setahun terakhir.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>21.</td>
												<td>Di perusahaan ini saya berkesempatan mendapatkan pengembangan diri secara profesional dan personal.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>22.</td>
												<td>Selama bekerja saya menentukan sendiri pengembangan karir seperti apa yang saya inginkan.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<th class="text-center" colspan="2">ASPEK REWARDS</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<td>23.</td>
												<td>Sistem penggajian yang diterapkan saat ini sesuai dengan penilaian kinerja.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>24.</td>
												<td>Gaji saya kurang lebih sama dibandingkan perusahaan lain yang setara untuk pekerjaan sejenis</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>25.</td>
												<td>Saya memahami seluruh informasi mengenai benefit yang diberikan perusahaan kepada Karyawan.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>26.</td>
												<td>Besarnya Insentif dan bonus yang diberikan perusahaan sesuai dengan	kebutuhan saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<td>27.</td>
												<td>Saat ini perhatian perusahaan sudah cukup baik dibanding perusahaan lain yang saya ketahui.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat tidak setuju"></td>
											</tr>
										</table>
										<label for="">Alasan utama Anda mengundurkan diri (pilih salah satu) :</label>
										<ol style="list-style-type: none;">
											<li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="pindah_perusahaan"> Pindah ke Perusahaan lain yaitu</li>
											<li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="melanjutkan sekolah"> Melanjutkan sekolah</li>
											<li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="wiraswasta"> Wiraswasta</li>
											<li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="tidak bekerja"> Tidak bekerja</li>
											<li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="lainnya"> Lainnya</li>
										</ol>
						
										<label for="">Jelaskan apa yang Anda rasakan dengan beban pekerjaan yang telah diberikan pada Anda dari awal masuk kerja hingga saat ini?</label><br>
										<textarea name="resign_survei_essay_2" id="resign_survei_essay_2" rows="3" class="form-control"></textarea>
						
										<label for="">Bagaimana hubungan kerja Anda di lingkungan kerja perusahaan ini?</label><br>
										<p for="">A. Baik, Jelaskan :</p>
										<textarea name="resign_survei_essay_3" id="resign_survei_essay_3" rows="3" class="form-control"></textarea>
										<p for="">B. Kurang Baik, Jelaskan :</p>
										<textarea name="resign_survei_essay_3" id="resign_survei_essay_3" rows="3" class="form-control"></textarea>
						
										<label for="">Berikan pendapat Anda mengenai perusahaan ini sebagi bahan masukan bagi kami</label>
										<textarea name="resign_survei_essay_4" id="resign_survei_essay_4" rows="3" class="form-control"></textarea>
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
		//Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

	$(document).ready(function () {

		// $('#formulir_cuti').hide();
		// $('#formulir_resign').hide();

		$('#jenis').on('change', function () {
			var jenis_val = $('#jenis').val();

			if (jenis_val == 'cuti') {
				$('#formulir_cuti').show();
				$('#formulir_resign').hide();

				$( function() {
					$( "#cuti_tanggal_mulai" ).datepicker({
						dateFormat: "yy-mm-dd"
					});
					$( "#cuti_tanggal_berakhir" ).datepicker({
						dateFormat: "yy-mm-dd"
					});
					$( "#cuti_tanggal_kerja" ).datepicker({
						dateFormat: "yy-mm-dd"
					});
				} );				
			}

			if (jenis_val == 'resign') {
				$('#formulir_resign').show();				
				$('#formulir_cuti').hide();

				$( "#resign_tanggal_masuk" ).datepicker({
					dateFormat: "yy-mm-dd"
				});

				$( "#resign_tanggal_keluar" ).datepicker({
					dateFormat: "yy-mm-dd"
				});

				$( "#resign_tanggal_kewajiban_keuangan" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_serah_terima" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_id_card" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_seragam_karyawan" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_laptop" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_peralatan_kantor" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_penghapusan_akun" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_penghapusan_chat" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_penutupan_rekening" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
				
				$( "#resign_tanggal_lain" ).datepicker({
					dateFormat: "yy-mm-dd"
				});
			}

		});

		
	});

	
  
</script>

@endsection
