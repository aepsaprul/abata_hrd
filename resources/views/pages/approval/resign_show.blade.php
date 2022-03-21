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
				<div class="card">
					<div class="card-header">
                        <h3 class="card-title">

                        </h3>
                        <div class="card-tools mr-0">
                            <a href="{{ route('approval.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
					<form role="form" action="#" method="POST">
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
				</div>
			</div>
		</div>
	</section>
</div>

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

