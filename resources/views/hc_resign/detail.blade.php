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
					<h1>Detail Formulir</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/hc/form_resign') }}">BACK</a></h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{ route('cir.store_resign') }}" method="POST">
							@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama</label>
												<p>{{ $resign->masterKaryawan->nama_lengkap }}</p>
												<input type="hidden" name="master_karyawan_id" value="{{ $resign->masterKaryawan->id }}">
											</div>
										</div>
									</div>									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Atasan Langsung</label>
												<input type="text" name="atasan" id="atasan" class="form-control" value="{{ $atasan->nama_lengkap }}">
											</div>
										</div>
									</div>

									{{-- formulir resign  --}}
									<div id="formulir_resign">
										<table class="table table-bordered">
											<tr>
												<td>Jabatan</td>
												<td>:</td>
												<td>
													<input type="text" name="master_jabatan_id" id="master_jabatan_id" class="form-control" value="{{ $resign->masterJabatan->nama_jabatan }}">
												</td>
											</tr>
											<tr>
												<td>Lokasi Kerja</td>
												<td>:</td>
												<td><input type="text" name="lokasi_kerja" id="resign_lokasi" class="form-control" value="{{ $resign->lokasi_kerja }}"></td>
											</tr>
											<tr>
												<td>Tanggal Masuk</td>
												<td>:</td>
												<td><input type="text" name="tanggal_masuk" id="resign_tanggal_masuk" class="form-control" autocomplete="off" value="{{ $resign->tanggal_masuk }}"></td>
											</tr>
											<tr>
												<td>Tanggal Efektif Keluar</td>
												<td>:</td>
												<td><input type="text" name="tanggal_keluar" id="resign_tanggal_keluar" class="form-control" autocomplete="off" value="{{ $resign->tanggal_keluar }}"></td>
											</tr>
											<tr>
												<td>Alamat Rumah yang ditempati</td>
												<td>:</td>
												<td><input type="text" name="alamat" id="resign_alamat" class="form-control" value="{{ $resign->alamat }}"></td>
											</tr>
											<tr>
												<td>No Telp / HP</td>
												<td>:</td>
												<td><input type="number" name="telepon" id="resign_telepon" class="form-control" value="{{ $resign->telepon }}"></td>
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
																@foreach ($resign_ceklis as $item)
																	<tr>
																		<td>{{ $item->nama_ceklis }}</td>
																		<td>
																			<input type="radio" id="resign_ceklis_kewajiban_keuangan" value="ada" {{ $item->keterangan == "ada" ? 'checked' : ''}}> Ada 
																			<input type="radio" id="resign_ceklis_kewajiban_keuangan" value="tidak" {{ $item->keterangan == "tidak" ? 'checked' : ''}}> Tidak
																		</td>
																		<td>
																			Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_kewajiban_keuangan" class="form-control" autocomplete="off" value="{{ $item->tanggal_selesai }}">
																		</td>
																		<input type="hidden" name="resign_ceklis[]" value="kewajiban keuangan">
																	</tr>																		
																@endforeach
															</table>
														</li>
													</ol>
												</td>
											</tr>
										</table>
										<label>Pilihlah satu diantara Sangat Tidak Setuju sampai dengan Sangat Setuju pada setiap pernyataan berikut ini:</label>
										<table class="table table-bordered">
											<tr>
												<th class="text-center" colspan="2" style="width: 50%">Title</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											@foreach ($resign_survei_ceklis as $key => $item)
												<tr>
													<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="1">
													<td>{{ $key + 1 }}</td>
													<td>{{ $item->nama_ceklis }}</td>
													<td class="text-center"><input type="radio" id="resign_survei_ceklis_keterangan_1" {{ $item->keterangan == "sangat setuju" ? 'checked' : '' }} value="sangat setuju"></td>
													<td class="text-center"><input type="radio" id="resign_survei_ceklis_keterangan_1" {{ $item->keterangan == "setuju" ? 'checked' : '' }} value="setuju"></td>
													<td class="text-center"><input type="radio" id="resign_survei_ceklis_keterangan_1" {{ $item->keterangan == "ragu - ragu" ? 'checked' : '' }} value="ragu - ragu"></td>
													<td class="text-center"><input type="radio" id="resign_survei_ceklis_keterangan_1" {{ $item->keterangan == "tidak setuju" ? 'checked' : '' }} value="tidak setuju"></td>
													<td class="text-center"><input type="radio" id="resign_survei_ceklis_keterangan_1" {{ $item->keterangan == "sangat tidak setuju" ? 'checked' : '' }} value="sangat tidak setuju"></td>
												</tr>													
											@endforeach
											{{-- <tr>
												<th class="text-center" colspan="2">ASPEK TIM KERJA</th>
												<th class="text-center">Sangat Setuju</th>
												<th class="text-center">Setuju</th>
												<th class="text-center">Ragu - ragu</th>
												<th class="text-center">Tidak Setuju</th>
												<th class="text-center">Sangat Tidak Setuju</th>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="6">
												<td>6.</td>
												<td>Rekan tim kerja saya menghargai pendapat saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="7">
												<td>7.</td>
												<td>Rekan tim kerja saya selalu memberikan hasil terbaik dalam bekerja.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="8">
												<td>8.</td>
												<td>Di tim kerja, saya memiliki sahabat yang dapat saya ajak bertukar pikirandan berbicara secara personal.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="9">
												<td>9.</td>
												<td>Saya mengenal secara pribadi setiap anggota tim kerja saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="10">
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
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="11">
												<td>11.</td>
												<td>Saya memiliki ketrampilan dan keahlian yang memadai untuk	menyelesaikan tugas sehari-hari saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="12">
												<td>12.</td>
												<td>Atasan saya selalu memberikan pujian atau penghargaan setiap sayamelakukan pekerjaan dengan baik.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="13">
												<td>13.</td>
												<td>Atasan saya memberikan bimibingan kepada saya secara teratur.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="14">
												<td>14.</td>
												<td>Rekan kerja dan atasan saya peduli kepada saya sebagai seorang manusia.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="15">
												<td>15.</td>
												<td>Atasan atau rekan kerja saya selalu mendorong dan mendukung saya untuk berkembang.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="16">
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
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="17">
												<td>17.</td>
												<td>Setiap orang di perusahaan ini diberikan kesempatan yang sama tanpa menghiraukan latar belakang etnis, gender, usia, ketidak-mampuan, atau perbedaan lainnya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="18">
												<td>18.</td>
												<td>Para rekan kerja saya selalu saling terbuka dan jujur (kecuali terhadap kerahasiaan bisnis).</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="19">
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
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="20">
												<td>20.</td>
												<td>Atasan saya memberitahu saya tentang kemajuan yang saya capai dalam setahun terakhir.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="21">
												<td>21.</td>
												<td>Di perusahaan ini saya berkesempatan mendapatkan pengembangan diri secara profesional dan personal.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="22">
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
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="23">
												<td>23.</td>
												<td>Sistem penggajian yang diterapkan saat ini sesuai dengan penilaian kinerja.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="24">
												<td>24.</td>
												<td>Gaji saya kurang lebih sama dibandingkan perusahaan lain yang setara untuk pekerjaan sejenis</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="25">
												<td>25.</td>
												<td>Saya memahami seluruh informasi mengenai benefit yang diberikan perusahaan kepada Karyawan.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="26">
												<td>26.</td>
												<td>Besarnya Insentif dan bonus yang diberikan perusahaan sesuai dengan	kebutuhan saya.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat tidak setuju"></td>
											</tr>
											<tr>
												<input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="27">
												<td>27.</td>
												<td>Saat ini perhatian perusahaan sudah cukup baik dibanding perusahaan lain yang saya ketahui.</td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="ragu - ragu"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="tidak setuju"></td>
												<td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat tidak setuju"></td>
											</tr> --}}
										</table>
										
										@foreach ($resign_survei_essay as $item)
											<input type="hidden" name="hc_resign_survei_nama_essay_id[]" value="1">
											<label for="">{{ $item->nama_essay }}</label>
											<textarea id="resign_survei_essay_2" rows="3" class="form-control">{{ $item->keterangan }}</textarea>											
										@endforeach
									</div>
									
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
  });

	$(document).ready(function () {

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
			
	});

	
  
</script>

@endsection
