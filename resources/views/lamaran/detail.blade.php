@extends('layouts.app')

@section('style')
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
	
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Detail Lamaran</h1>
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
							<h3 class="card-title"><i class="fa fa-arrow-left"></i> <a href="{{ url('/hc/lamaran') }}">BACK</a></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<dl class="row">
										<dt class="col-sm-4 p-2">Posisi</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->masterJabatan->nama_jabatan }}</dd>
										<dt class="col-sm-4 p-2">Nama Lengkap</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->nama_lengkap }}</dd>
										<dt class="col-sm-4 p-2">Nama Panggilan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->nama_panggilan }}</dd>
										<dt class="col-sm-4 p-2">Telepon</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->telepon }}</dd>
										<dt class="col-sm-4 p-2">Email</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->email }}</dd>
										<dt class="col-sm-4 p-2">Nomor KTP</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->nomor_ktp }}</dd>
										<dt class="col-sm-4 p-2">Nomor SIM</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->nomor_sim }}</dd>
									</dl>
								</div>
								<div class="col-md-6">
									<dl class="row">
										<dt class="col-sm-4 p-2">Tempat Lahir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->tempat_lahir }}</dd>
										<dt class="col-sm-4 p-2">Tanggal Lahir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->tanggal_lahir }}</dd>
										<dt class="col-sm-4 p-2">Agama</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->agama }}</dd>
										<dt class="col-sm-4 p-2">Jenis Kelamin</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->jenis_kelamin }}</dd>
										<dt class="col-sm-4 p-2">Alamat KTP</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->agama }}</dd>
										<dt class="col-sm-4 p-2">Alamat Sekarang</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->alamat_sekarang }}</dd>
										<dt class="col-sm-4 p-2">Status Perkawinan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">
											@if ($lamaran->status_perkawinan == 1)
												Lajang
											@elseif ($lamaran->status_perkawinan == 2)
												Menikah
											@elseif ($lamaran->status_perkawinan == 3)
												Cerai
											@else
												
											@endif
										</dd>										
										<dt class="col-sm-4 p-2">Pernyataan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $lamaran->pernyataan }}</dd>
									</dl>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
    							    @php $surat_lamaran = explode('/', $lamaran->surat_lamaran); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $surat_lamaran[1] }}" target="blank">Surat Lamaran</a>
								</div>
								<div class="col-md-3">
								    @php $curriculum_vitae = explode('/', $lamaran->curriculum_vitae); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $curriculum_vitae[1] }}" target="blank">Curriculum Vitae</a>
								</div>
								<div class="col-md-3">
								    @php $ijazah = explode('/', $lamaran->ijazah); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $ijazah[1] }}" target="blank">Ijazah</a>
								</div>
								<div class="col-md-3">
								    @php $transkip_nilai = explode('/', $lamaran->transkip_nilai); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $transkip_nilai[1] }}" target="blank">Transkip Nilai</a>
								</div>
								<div class="col-md-3">
								    @php $foto = explode('/', $lamaran->foto); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $foto[1] }}" target="blank">Foto</a>
								</div>
								<div class="col-md-3">
								    @php $kartu_keluarga = explode('/', $lamaran->kartu_keluarga); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $kartu_keluarga[1] }}" target="blank">Kartu Keluarga</a>
								</div>
								<div class="col-md-3">
								    @php $ktp = explode('/', $lamaran->ktp); @endphp
									<a href="https://abata-printing.com/loker/laravel/storage/app/public/img/{{ $ktp[1] }}" target="blank">KTP</a>
								</div>
							</div>
							
							<hr style="border: 2px solid #000;">
							
							<div class="row">
								<div class="col-md-6">
        							<h1>Pendidkan</h1>
								    @foreach ($pendidikans as $key => $pendidikan)
									<dl class="row">
										<dt class="col-sm-4 p-2">Tingkat</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->tingkat }}</dd>
										<dt class="col-sm-4 p-2">Nama Sekolah</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->nama }}</dd>
										<dt class="col-sm-4 p-2">Kota</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->kota }}</dd>
										<dt class="col-sm-4 p-2">Jurusan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->jurusan }}</dd>
										<dt class="col-sm-4 p-2">Tahun Masuk</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->tahun_masuk }}</dd>
										<dt class="col-sm-4 p-2">Tahun Lulus</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pendidikan->tahun_lulus }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							{{-- ========================================== susunan keluarga ========================================================================= --}}
							<div class="row">
								<div class="col-md-6">
        							<h1>Susunan Keluarga Sebelum Menikah</h1>
								    @foreach ($keluarga_sebelum_menikahs as $key => $keluarga_sebelum_menikah)
									<dl class="row">
										<dt class="col-sm-4 p-2">Hubungan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->hubungan }}</dd>
										<dt class="col-sm-4 p-2">Nama</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->nama }}</dd>
										<dt class="col-sm-4 p-2">Usia</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->usia }}</dd>
										<dt class="col-sm-4 p-2">Jenis Kelamin</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->jenis_kelamin }}</dd>
										<dt class="col-sm-4 p-2">Pendidikan Terakhir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->pendidikan_terakhir }}</dd>
										<dt class="col-sm-4 p-2">Pekerjaan Terakhir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_sebelum_menikah->pekerjaan_terakhir }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
								<div class="col-md-6">
        							<h1>Susunan Keluarga Setelah Menikah</h1>
								    @foreach ($keluarga_setelah_menikahs as $key => $keluarga_setelah_menikah)
									<dl class="row">
										<dt class="col-sm-4 p-2">Hubungan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_setelah_menikah->hubungan }}</dd>
										<dt class="col-sm-4 p-2">Nama</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_setelah_menikah->nama }}</dd>
										<dt class="col-sm-4 p-2">Tempat Lahir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_setelah_menikah->tempat_lahir }}</dd>
										<dt class="col-sm-4 p-2">Tanggal Lahir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_setelah_menikah->tanggal_lahir }}</dd>
										<dt class="col-sm-4 p-2">Pekerjaan Terakhir</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $keluarga_setelah_menikah->pekerjaan_terakhir }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
        							<h1>Kerabat Yang Bisa Dihubungi Saat Darurat</h1>
								    @foreach ($kerabat_darurats as $key => $kerabat_darurat)
									<dl class="row">
										<dt class="col-sm-4 p-2">Hubungan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $kerabat_darurat->hubungan }}</dd>
										<dt class="col-sm-4 p-2">Nama</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $kerabat_darurat->nama }}</dd>
										<dt class="col-sm-4 p-2">Jenis Kelamin</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $kerabat_darurat->jenis_kelamin }}</dd>
										<dt class="col-sm-4 p-2">Telepon</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $kerabat_darurat->telepon }}</dd>
										<dt class="col-sm-4 p-2">Alamat</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $kerabat_darurat->alamat }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
        							<h1>Media Sosial</h1>
								    @foreach ($media_sosials as $key => $media_sosial)
									<dl class="row">
										<dt class="col-sm-4 p-2">Facebook</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $media_sosial->facebook }}</dd>
										<dt class="col-sm-4 p-2">Instagram</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $media_sosial->instagram }}</dd>
										<dt class="col-sm-4 p-2">Linkedin</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $media_sosial->linkedin }}</dd>
										<dt class="col-sm-4 p-2">Youtube</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $media_sosial->youtube }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
        							<h1>Organisasi</h1>
								    @foreach ($organisasis as $key => $organisasi)
									<dl class="row">
										<dt class="col-sm-4 p-2">Nama Organisasi</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $organisasi->nama }}</dd>
										<dt class="col-sm-4 p-2">Jabatan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $organisasi->jabatan }}</dd>
										<dt class="col-sm-4 p-2">Masa Kerja</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $organisasi->masa_kerja }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
								    @foreach ($pelatihans as $key => $pelatihan)
        							<h1>Pelatihan</h1>
									<dl class="row">
										<dt class="col-sm-4 p-2">Nama Pelatihan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pelatihan->nama }}</dd>
										<dt class="col-sm-4 p-2">Tahun</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $pelatihan->tahun }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
								    @foreach ($penghargaans as $key => $penghargaan)
        							<h1>Penghargaan</h1>
									<dl class="row">
										<dt class="col-sm-4 p-2">Nama Penghargaan</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $penghargaan->nama }}</dd>
										<dt class="col-sm-4 p-2">Tahun</dt>
										<dd class="col-sm-8 border-bottom border-warning rounded p-2">{{ $penghargaan->tahun }}</dd>
									</dl>
									<hr style="border: 2px solid #000;">
									@endforeach
								</div>
							</div>
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

<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- Filterizr-->
<script src="{{ asset('plugins/filterizr/jquery.filterizr.min.js') }}"></script>

<script type="text/javascript">
	$(function () {

    // tanggal masuk
    $('#tanggal_masuk').datetimepicker({
        format: 'DD/MM/YYYY'
    });

		// mulai kontrak 
		$('#mulai_kontrak').datetimepicker({
        format: 'DD/MM/YYYY'
    });

		// mulai kontrak 
		$('#berakhir_kontrak').datetimepicker({
        format: 'DD/MM/YYYY'
    });
  });

	$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })

	$(document).ready(function () {
		bsCustomFileInput.init();

		// membatasi jumlah inputan
    var maxGroup = 10;
    
    //melakukan proses multiple input 
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
	});
</script>

@endsection