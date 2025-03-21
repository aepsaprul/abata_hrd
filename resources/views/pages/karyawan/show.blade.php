@extends('layouts.app')
@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Lihat Profile</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
              <li class="breadcrumb-item active">Lihat Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">
                          <strong>{{ $karyawan->nama_lengkap }}</strong>
                        </h3>
                        <div class="card-tools mr-0">
                          <a href="{{ route('karyawan.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                      </div>
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a></li>
                          <li class="nav-item"><a class="nav-link" href="#kontrak" data-toggle="tab">Kontrak</a></li>
                          <li class="nav-item"><a class="nav-link" href="#medsos" data-toggle="tab">Medsos</a></li>
                          <li class="nav-item"><a class="nav-link" href="#sebelum_menikah" data-toggle="tab">Sebelum Menikah</a></li>
                          <li class="nav-item"><a class="nav-link" href="#setelah_menikah" data-toggle="tab">Setelah Menikah</a></li>
                          <li class="nav-item"><a class="nav-link" href="#kerabat_darurat" data-toggle="tab">Kerabat Darurat</a></li>
                          <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content">
                          {{-- biodata --}}
                          <div class="active tab-pane" id="biodata">
                            <form id="biodata_form" method="POST" enctype="multipart/form-data">
                              <div class="row">
                                <div class="col-md-3">
                                  {{-- id --}}
                                  <input type="hidden" id="id" value="{{ $karyawan->id }}" name="id">

                                  <!-- Profile Image -->
                                  <div class="card card-primary">
                                    <div class="card-body box-profile">
                                      <div class="text-center profile_img">
                                        @if ($karyawan->foto)
                                          {{-- dev --}}
                                          @if(file_exists(env('APP_URL_IMG') . 'image/' . $karyawan->foto))
                                          {{-- prod --}}
                                          {{-- @if(file_exists('image/' . $karyawan->foto)) --}}
                                            <img
                                              class="profile-user-img img-fluid"
                                              src="{{ asset(env('APP_URL_IMG') . 'image/' . $karyawan->foto) }}"
                                              alt="User profile picture"
                                              style="width: 100%;">
                                          @else
                                            <img
                                              class="profile-user-img img-fluid"
                                              src="{{ asset(env('APP_URL_IMG') . 'assets/no-image.jpg') }}"
                                              alt="User profile picture"
                                              style="width: 100%;">
                                          @endif
                                        @else
                                          <img
                                            class="profile-user-img img-fluid"
                                            src="{{ asset(env('APP_URL_IMG') . 'assets/no-image.jpg') }}"
                                            alt="User profile picture"
                                            style="width: 100%;">
                                        @endif
                                      </div>
                                      <div class="row nik">
                                        {{-- data nik di jquery --}}
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                          <div class="form-group">
                                            <label for="status_level" class="col-form-label col-form-label-sm">Status Level</label>
                                            <p>
                                              @if ($kontrak_pertama)
                                                @php
                                                  $tgl1 = new DateTime($kontrak_pertama->mulai_kontrak);
                                                  $tgl2 = new DateTime();
                                                  $selisih = $tgl2->diff($tgl1);

                                                  if ($selisih->y < 0) {
                                                    if ($selisih->m <= 3) {
                                                      echo "Training";
                                                    } else {
                                                      echo "Amatir";
                                                    }
                                                  } else {
                                                    if ($selisih->y < 2) {
                                                      echo "Amatir";
                                                    } else if ($selisih->y >= 2 && $selisih->y < 3) {
                                                      echo "Basic";
                                                    } else if ($selisih->y >=3 && $selisih->y < 4) {
                                                      echo "Yunior";
                                                    } else if ($selisih->y >= 4 && $selisih->y < 5) {
                                                      echo "Senior";
                                                    } else {
                                                      echo "Profesional";
                                                    }
                                                  }
                                                @endphp
                                              @else
                                                Kontrak belum ada
                                              @endif
                                            </p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="biodata_notif font-italic text-success"></div>
                                    </div>
                                  </div>
                                  <div class="row" id="biodata_data">
                                    {{-- data di jquery --}}
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>

                          {{-- kontrak --}}
                          <div class="tab-pane" id="kontrak">
                            <div style="overflow-x: auto;">
                              <table id="tabel_kontrak" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Mulai Kontrak</th>
                                    <th class="text-center">Akhir Kontrak</th>
                                    <th class="text-center">Lama Kontrak</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_kontrak">
                                  {{-- kontrak data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>

                          {{-- medsos --}}
                          <div class="tab-pane" id="medsos">
                            <div style="overflow-x: auto;">
                              <table id="tabel_medsos" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Nama Media Sosial</th>
                                    <th class="text-center">Nama Akun</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_medsos">
                                  {{-- medsos data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>

                          {{-- sebelum menikah --}}
                          <div class="tab-pane" id="sebelum_menikah">
                            <div style="overflow-x: auto;">
                              <table id="tabel_sebelum_menikah" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Hubungan</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Usia</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Pendidikan Terakhir</th>
                                    <th class="text-center">Pekerjaan Terakhir</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_sebelum_menikah">
                                  {{-- sebelum menikah data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>

                          {{-- setelah menikah --}}
                          <div class="tab-pane" id="setelah_menikah">
                            <div style="overflow-x: auto;">
                              <table id="tabel_setelah_menikah" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Hubungan</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Tempat Lahir</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Pekerjaan Terakhir</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_setelah_menikah">
                                  {{-- setelah menikah data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>

                          {{-- kerabat darurat --}}
                          <div class="tab-pane" id="kerabat_darurat">
                            <div style="overflow-x: auto;">
                              <table id="tabel_kerabat_darurat" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Hubungan</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Telepon</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_kerabat_darurat">
                                  {{-- kerabat darurat data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>

                          {{-- pendidikan --}}
                          <div class="tab-pane" id="pendidikan">
                            <div style="overflow-x: auto;">
                              <table id="tabel_pendidikan" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                  <tr class="bg-primary">
                                    <th class="text-center">Tingkat</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kota</th>
                                    <th class="text-center">Jurusan</th>
                                    <th class="text-center">Tahun Masuk</th>
                                    <th class="text-center">Tahun Lulus</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="data_pendidikan">
                                  {{-- pendidikan data di jquery --}}
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <strong class="text-uppercase">Training</strong>
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-12">
                      <div><span class="font-weight-bold">Durasi:</span> {{ $total_durasi_training }} Jam</div>
                      <div><span class="font-weight-bold">Modul</span>
                        <ul>
                          @foreach ($training_moduls as $modul)
                            <li>{{ $modul->nama }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <strong class="text-uppercase">Histori Jabatan</strong>
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Jabatan</th>
                            <th class="text-center">Tanggal</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($histori_jabatans as $histori_jabatan)
                            <tr>
                              <td>{{ $histori_jabatan->dataJabatan->nama_jabatan }}</td>
                              <td class="text-center">{{ tglCarbon($histori_jabatan->tanggal, 'd/m/Y') }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('script')

<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/moment/moment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-precise-range-plugin@1.3.0/moment-precise-range.min.js"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script type="text/javascript">

	$(document).ready(function () {
    // $.ajaxSetup({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    // biodata
    biodata();
    function biodata() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.biodata", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
          let nik = `
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <label for="nik" class="col-form-label col-form-label-sm">NIP</label>
                <input type="text" class="form-control form-control-sm" id="nik" name="nik" maxlength="50" value="${response.karyawan.nik}" onkeyup="this.value = this.value.toUpperCase()" disabled>
                <small id="error_nik" class="form-text text-danger font-italic"></small>
              </div>
            </div
          `;
          $('.nik').append(nik);

          let biodata_data = `
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="nama_lengkap" class="col-form-label col-form-label-sm">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm" id="nama_lengkap" name="nama_lengkap" maxlength="50" value="${response.karyawan.nama_lengkap}" onkeyup="this.value = this.value.toUpperCase()" disabled>
                <small id="error_nama_lengkap" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="nama_panggilan" class="col-form-label col-form-label-sm">Nama Panggilan</label>
                <input type="text" class="form-control form-control-sm" id="nama_panggilan" name="nama_panggilan" maxlength="20" value="${response.karyawan.nama_panggilan}" onkeyup="this.value = this.value.toUpperCase()" disabled>
                <small id="error_nama_panggilan" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="jenis_kelamin" class="col-form-label col-form-label-sm">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm" disabled>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L"`;

                    if (response.karyawan.jenis_kelamin == 'L' ) {
                      biodata_data += `selected`;
                    }

                    biodata_data += `>L (Laki - laki)</option>
                    <option value="P"`;

                    if ( response.karyawan.jenis_kelamin == "P" ) {
                      biodata_data += `selected`;
                    }

                    biodata_data += `>P (Perempuan)</option>
                </select>
                <small id="error_jenis_kelamin" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="nomor_ktp" class="col-form-label col-form-label-sm">Nomor KTP</label>
                <input type="number" class="form-control form-control-sm" id="nomor_ktp" name="nomor_ktp" maxlength="18" value="${response.karyawan.nomor_ktp}" disabled>
                <small id="error_nomor_ktp" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="status_perkawinan" class="col-form-label col-form-label-sm">Status Perkawinan</label>
                <input type="text" class="form-control form-control-sm" value="${response.karyawan.status_perkawinan}" disabled>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="agama" class="col-form-label col-form-label-sm">Agama</label>
                <input type="text" class="form-control form-control-sm" value="${response.karyawan.agama}" disabled>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="tempat_lahir" class="col-form-label col-form-label-sm">Tempat Lahir</label>
                <input type="text" class="form-control form-control-sm" id="tempat_lahir" name="tempat_lahir" maxlength="50" value="${response.karyawan.tempat_lahir}" onkeyup="this.value = this.value.toUpperCase()" disabled>
                <small id="error_tempat_lahir" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="tanggal_lahir" class="col-form-label col-form-label-sm">Tanggal Lahir</label>
                <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir" value="${response.karyawan.tanggal_lahir}" disabled>
                <small id="error_tanggal_lahir" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <label for="alamat_asal" class="col-form-label col-form-label-sm">Alamat KTP</label>
                <textarea class="form-control form-control-sm" rows="3" id="alamat_asal" name="alamat_asal" onkeyup="this.value = this.value.toUpperCase()" disabled>${response.karyawan.alamat_asal}</textarea>
                <small id="error_alamat_asal" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <label for="alamat_domisili" class="col-form-label col-form-label-sm">Alamat Sekarang</label>
                <textarea class="form-control form-control-sm" rows="3" id="alamat_domisili" name="alamat_domisili" onkeyup="this.value = this.value.toUpperCase()" disabled>${response.karyawan.alamat_domisili}</textarea>
                <small id="error_alamat_domisili" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="sim">Jenis & Nomor SIM</label>
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-4">
                    <input type="text" id="edit_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10" value="${response.karyawan.jenis_sim}" onkeyup="this.value = this.value.toUpperCase()" disabled>
                    <small id="errorJenisSim" class="form-text text-danger"></small>
                  </div>
                  <div class="col-md-8 col-sm-8 col-8">
                    <input type="text" id="edit_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15" value="${response.karyawan.nomor_sim}" disabled>
                    <small id="errorNomorSim" class="form-text text-danger"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="master_cabang_id" class="col-form-label col-form-label-sm">Cabang</label>
                <input type="text" id="master_cabang_id" class="form-control" value="${response.karyawan.master_cabang.nama_cabang}" disabled>
                <small id="error_cabang" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="master_jabatan_id" class="col-form-label col-form-label-sm">Jabatan</label>
                <input type="text" id="master_jabatan_id" class="form-control" value="${response.karyawan.master_jabatan.nama_jabatan}" disabled>
                <small id="error_jabatan" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="master_divisi_id" class="col-form-label col-form-label-sm">Divisi</label>
                <input type="text" id="master_divisi_id" class="form-control" value="${response.karyawan.master_divisi.nama}" disabled>
                <small id="error_divisi" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="rekening_nomor" class="col-form-label col-form-label-sm">Nomor Rekening</label>
                <input type="text" class="form-control form-control-sm" id="rekening_nomor" name="rekening_nomor" maxlength="15" value="${response.karyawan.rekening_nomor}" disabled>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="email" class="col-form-label col-form-label-sm">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" maxlength="50" value="${response.karyawan.email}" disabled>
                <small id="error_email" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="telepon" class="col-form-label col-form-label-sm">Telepon</label>
                <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" maxlength="15" value="${response.karyawan.telepon}" disabled>
                <small id="error_telepon" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="role" class="col-form-label col-form-label-sm">Role</label>
                <input type="text" id="master_divisi_id" class="form-control" value="${response.karyawan.role}" disabled>
                <small id="error_role" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="total_cuti" class="col-form-label col-form-label-sm">Total Cuti</label>
                <input type="text" class="form-control form-control-sm" id="total_cuti" name="total_cuti" maxlength="50"`;

                if (response.karyawan.total_cuti) {
                  biodata_data += `value="${response.karyawan.total_cuti}"`;
                } else {
                  biodata_data += `value="0"`;
                }


                biodata_data += `onkeyup="this.value = this.value.toUpperCase()" disabled>
                <small id="error_total_cuti" class="form-text text-danger font-italic"></small>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="form-group">
                <label for="role" class="col-form-label col-form-label-sm">Awal Kerja</label>
                <input type="date" id="master_divisi_id" class="form-control" value="${response.karyawan.kontrak[0].mulai_kontrak}" disabled>
                <small id="error_role" class="form-text text-danger font-italic"></small>
              </div>
            </div>`;
          $('#biodata_data').append(biodata_data);

          //Initialize Select2 Elements
          $('.select2').select2();
        }
      });
    }

    $('#biodata_form').submit(function(e) {
      e.preventDefault();
      if ($('#nama_lengkap').val() == "") {
        $('#error_nama_lengkap').append("Nama lengkap harus diisi");
      } else if ($('#nama_panggilan').val() == "") {
        $('#error_nama_panggilan').append("Nama panggilan harus diisi");
      } else if ($('#email').val() == "") {
        $('#error_email').append("Email harus diisi");
      } else if ($('#telepon').val() == "") {
        $('#error_telepon').append("Telepon harus diisi");
      } else if ($('#nomor_sim').val() == "") {
        $('#error_nomor_sim').append("Nomor SIM harus diisi");
      } else if ($('#nomor_ktp').val() == "") {
        $('#error_nomor_ktp').append("Nomor KTP harus diisi");
      } else if ($('#alamat_asal').val() == "") {
        $('#error_alamat_asal').append("Alamat KTP harus diisi");
      } else if ($('#alamat_domisili').val() == "") {
        $('#error_alamat_domisili').append("Alamat sekarang harus diisi");
      } else if ($('#tempat_lahir').val() == "") {
        $('#error_tempat_lahir').append("Tempat lahir harus diisi");
      } else if ($('#tanggal_lahir').val() == "") {
        $('#error_tanggal_lahir').append("Tanggal lahir harus diisi");
      } else if ($('#jenis_kelamin').val() == "") {
        $('#error_jenis_kelamin').append("Jenis kelamin harus diisi");
      } else if ($('#status_perkawinan').val() == "") {
        $('#error_status_perkawinan').append("Status perkawinan harus diisi");
      } else if ($('#agama').val() == "") {
        $('#error_agama').append("Agama harus diisi");
      } else if ($('#master_cabang_id').val() == "") {
        $('#error_master_cabang_id').append("Cabang harus diisi");
      } else if ($('#master_jabatan_id').val() == "") {
        $('#error_master_jabatan_id').append("Jabatan harus diisi");
      } else {
        $('.biodata_notif').empty();

        var formData = new FormData($('#biodata_form')[0]);

        $.ajax({
          url: "{{ URL::route('karyawan.biodata_update') }}",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $('.btn-biodata-spinner').removeClass('d-none');
            $('.btn-biodata-save').addClass('d-none');
          },
          success: function(response) {
            Toast.fire({
              icon: 'success',
              title: 'Data behasil diperbaharui'
            });

            setTimeout(() => {
              window.location.reload(1);
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    // kontrak
    kontrak();
    function kontrak() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.kontrak", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
          var kontrak_data = "";

          if (response.kontraks.length == 0) {
            kontrak_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"4\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.kontraks, function(index, value) {
              kontrak_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + tanggalIndo(value.mulai_kontrak) + "</td>" +
                  "<td class=\"text-center\">" + tanggalIndo(value.akhir_kontrak) + "</td>" +
                  "<td class=\"text-center\">" + value.lama_kontrak + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"kontrak_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_kontrak').append(kontrak_data);
        }
      });
    }

    $('#mulai_kontrak').on('change', function() {
      if ($('#akhir_kontrak').val() != "") {
        kontrakCalculate();
      }
    });

    $('#akhir_kontrak').on('change', function() {
      if ($('#mulai_kontrak').val() != "") {
        kontrakCalculate();
      }
    });

    function kontrakCalculate() {
      var a = moment($('#mulai_kontrak').val());
      var b = moment($('#akhir_kontrak').val());
      diff = moment.preciseDiff(a, b, true);

      intervals = ['years', 'months'];
      intervalse = ['TAHUN', 'BULAN'];
      output = [];

      for(var i = 0; i < intervals.length; i++) {
        var e = diff[intervals[i]];
        var d = e < 10 ? '' + e : e;
        output.push(d + ' ' + intervalse[i] + ' ');
      }

      $('#lama_kontrak').val(output);
    }

    $('#kontrak_form').submit(function(e) {
      e.preventDefault();
      if ($('#mulai_kontrak').val() == "" || $('#akhir_kontrak').val() == "") {
        alert('Tanggal tidak boleh kosong');
      } else {
        $('#data_kontrak').empty();

        var formData = {
          id: $('#id').val(),
          mulai_kontrak: $('#mulai_kontrak').val(),
          akhir_kontrak: $('#akhir_kontrak').val(),
          lama_kontrak: $('#lama_kontrak').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.kontrak_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('.btn-kontrak-spinner').removeClass('d-none');
            $('.btn-kontrak-save').addClass('d-none');
          },
          success: function(response) {
            var kontrak_data = "";

            if (response.kontraks.length == 0) {
              kontrak_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"4\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.kontraks, function(index, value) {
                kontrak_data += "" +
                  "<tr>" +
                      "<td class=\"text-center\">" + tanggalIndo(value.mulai_kontrak) + "</td>" +
                      "<td class=\"text-center\">" + tanggalIndo(value.akhir_kontrak) + "</td>" +
                      "<td class=\"text-center\">" + value.lama_kontrak + "</td>" +
                      "<td class=\"text-center\">" +
                        "<button class=\"kontrak_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                          "<i class=\"fa fa-trash\"></i>" +
                        "</button>" +
                      "</td>" +
                  "</tr>";
              });
            }
            $('#data_kontrak').append(kontrak_data);

            Toast.fire({
              icon: 'success',
              title: 'Kontrak behasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-kontrak-spinner').addClass('d-none');
              $('.btn-kontrak-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.kontrak_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_kontrak').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.kontrak_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            var kontrak_data = "";

            if (response.kontraks.length == 0) {
              kontrak_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"4\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.kontraks, function(index, value) {
                kontrak_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + tanggalIndo(value.mulai_kontrak) + "</td>" +
                    "<td class=\"text-center\">" + tanggalIndo(value.akhir_kontrak) + "</td>" +
                    "<td class=\"text-center\">" + value.lama_kontrak + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"kontrak_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_kontrak').append(kontrak_data);

            Toast.fire({
              icon: 'success',
              title: 'Kontrak behasil dihapus'
            });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });

    // medsos
    medsos();
    function medsos() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.medsos", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
          var medsos_data = "";

          if (response.medsos.length == 0) {
            medsos_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"3\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.medsos, function(index, value) {
              medsos_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + value.nama_media_sosial + "</td>" +
                  "<td class=\"text-center\">" + value.nama_akun + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"medsos_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_medsos').append(medsos_data);
        }
      });
    }

    $('#medsos_form').submit(function(e) {
      e.preventDefault();
      if ($('#nama_media_sosial').val() == "" || $('#nama_akun').val() == "") {
        alert('Formulir tidak boleh kosong');
      } else {
        $('#data_medsos').empty();

        var formData = {
          id: $('#id').val(),
          nama_media_sosial: $('#nama_media_sosial').val(),
          nama_akun: $('#nama_akun').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.medsos_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('.btn-medsos-spinner').removeClass('d-none');
            $('.btn-medsos-save').addClass('d-none');
          },
          success: function(response) {
            var medsos_data = "";

            if (response.medsoss.length == 0) {
              medsos_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"3\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.medsoss, function(index, value) {
                medsos_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.nama_media_sosial + "</td>" +
                    "<td class=\"text-center\">" + value.nama_akun + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"medsos_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_medsos').append(medsos_data);

            $('#nama_media_sosial').val("");
            $('#nama_akun').val("");

            Toast.fire({
              icon: 'success',
              title: 'Medsos berhasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-medsos-spinner').addClass('d-none');
              $('.btn-medsos-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.medsos_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_medsos').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.medsos_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            var medsos_data = "";

            if (response.medsoss.length == 0) {
              medsos_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"3\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.medsoss, function(index, value) {
                medsos_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.nama_media_sosial + "</td>" +
                    "<td class=\"text-center\">" + value.nama_akun + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"medsos_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_medsos').append(medsos_data);

            Toast.fire({
              icon: 'success',
              title: 'Medsos behasil dihapus'
            });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });

    // sebelum menikah
    $('#sebelum_menikah_jenis_kelamin').prop('disabled', true);

    $('#sebelum_menikah_hubungan').on('change', function() {
      if ($(this).val() == "AYAH" || $(this).val() == "KAKEK" || $(this).val() == "SAUDARA LAKI - LAKI") {
        $('#sebelum_menikah_jenis_kelamin').val("L");
        $('#sebelum_menikah_jenis_kelamin').prop('disabled', true);
      } else if ($(this).val() == "IBU" || $(this).val() == "NENEK" || $(this).val() == "SAUDARA PEREMPUAN") {
        $('#sebelum_menikah_jenis_kelamin').val("P");
        $('#sebelum_menikah_jenis_kelamin').prop('disabled', true);
      } else if ($(this).val() == "") {
        $('#sebelum_menikah_jenis_kelamin').val("");
        $('#sebelum_menikah_jenis_kelamin').prop('disabled', true);
      } else {
        $('#sebelum_menikah_jenis_kelamin').val("");
        $('#sebelum_menikah_jenis_kelamin').prop('disabled', false);
      }
    });

    sebelumMenikah();
    function sebelumMenikah() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.sebelum_menikah", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url:url,
        type: 'GET',
        success: function(response) {
          var sebelum_menikah_data = "";

          if (response.sebelum_menikahs.length == 0) {
            sebelum_menikah_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.sebelum_menikahs, function(index, value) {
              sebelum_menikah_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + value.hubungan + "</td>" +
                  "<td class=\"text-center\">" + value.nama + "</td>" +
                  "<td class=\"text-center\">" + value.usia + "</td>" +
                  "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                  "<td class=\"text-center\">" + value.pendidikan_terakhir + "</td>" +
                  "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"sebelum_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_sebelum_menikah').append(sebelum_menikah_data);
        }
      });
    }

    $('#sebelum_menikah_form').submit(function(e) {
      e.preventDefault();
      if ($('#sebelum_menikah_hubungan').val() == "" || $('#sebelum_menikah_nama').val() == "" || $('#sebelum_menikah_usia').val() == "" || $('#sebelum_menikah_jenis_kelamin').val() == "" || $('#sebelum_menikah_pendidikan').val() == "" || $('#sebelum_menikah_pekerjaan').val() == "") {
        alert('Formulir tidak boleh kosong');
      } else {
        $('#data_sebelum_menikah').empty();

        var formData = {
          id: $('#id').val(),
          hubungan: $('#sebelum_menikah_hubungan').val(),
          nama: $('#sebelum_menikah_nama').val(),
          usia: $('#sebelum_menikah_usia').val(),
          jenis_kelamin: $('#sebelum_menikah_jenis_kelamin').val(),
          pendidikan: $('#sebelum_menikah_pendidikan').val(),
          pekerjaan: $('#sebelum_menikah_pekerjaan').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.sebelum_menikah_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('.btn-sebelum-menikah-spinner').removeClass('d-none');
            $('.btn-sebelum-menikah-save').addClass('d-none');
          },
          success: function(response) {
            var sebelum_menikah_data = "";

            if (response.sebelum_menikahs.length == 0) {
              sebelum_menikah_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.sebelum_menikahs, function(index, value) {
                sebelum_menikah_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.hubungan + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.usia + "</td>" +
                    "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                    "<td class=\"text-center\">" + value.pendidikan_terakhir + "</td>" +
                    "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"sebelum_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_sebelum_menikah').append(sebelum_menikah_data);

            // empty value
            $('#sebelum_menikah_hubungan').val("");
            $('#sebelum_menikah_nama').val("");
            $('#sebelum_menikah_usia').val("");
            $('#sebelum_menikah_jenis_kelamin').val("");
            $('#sebelum_menikah_pendidikan').val("");
            $('#sebelum_menikah_pekerjaan').val("");

            Toast.fire({
              icon: 'success',
              title: 'Data sebelum menikah berhasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-sebelum-menikah-spinner').addClass('d-none');
              $('.btn-sebelum-menikah-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.sebelum_menikah_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_sebelum_menikah').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.sebelum_menikah_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
              var sebelum_menikah_data = "";

              if (response.sebelum_menikahs.length == 0) {
                sebelum_menikah_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
                  "</tr>";
              } else {
                $.each(response.sebelum_menikahs, function(index, value) {
                  sebelum_menikah_data += "" +
                    "<tr>" +
                      "<td class=\"text-center\">" + value.hubungan + "</td>" +
                      "<td class=\"text-center\">" + value.nama + "</td>" +
                      "<td class=\"text-center\">" + value.usia + "</td>" +
                      "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                      "<td class=\"text-center\">" + value.pendidikan_terakhir + "</td>" +
                      "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                      "<td class=\"text-center\">" +
                        "<button class=\"sebelum_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                          "<i class=\"fa fa-trash\"></i>" +
                        "</button>" +
                      "</td>" +
                    "</tr>";
                });
              }
              $('#data_sebelum_menikah').append(sebelum_menikah_data);

              Toast.fire({
                icon: 'success',
                title: 'Data sebelum menikah berhasil dihapus'
              });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });

    // setelah menikah
    setelahMenikah();
    function setelahMenikah() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.setelah_menikah", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url:url,
        type: 'GET',
        success: function(response) {
          var setelah_menikah_data = "";

          if (response.setelah_menikahs.length == 0) {
            setelah_menikah_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.setelah_menikahs, function(index, value) {
              setelah_menikah_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + value.hubungan + "</td>" +
                  "<td class=\"text-center\">" + value.nama + "</td>" +
                  "<td class=\"text-center\">" + value.tempat_lahir + "</td>" +
                  "<td class=\"text-center\">" + value.tanggal_lahir + "</td>" +
                  "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"setelah_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_setelah_menikah').append(setelah_menikah_data);
        }
      });
    }

    $('#setelah_menikah_form').submit(function(e) {
      e.preventDefault();
      if ($('#setelah_menikah_hubungan').val() == "" || $('#setelah_menikah_nama').val() == "" || $('#setelah_menikah_tempat_lahir').val() == "" || $('#setelah_menikah_tanggal_lahir').val() == "" || $('#setelah_menikah_pekerjaan').val() == "") {
        alert('Formulir tidak boleh kosong');
      } else {
        $('#data_setelah_menikah').empty();

        var formData = {
          id: $('#id').val(),
          hubungan: $('#setelah_menikah_hubungan').val(),
          nama: $('#setelah_menikah_nama').val(),
          tempat_lahir: $('#setelah_menikah_tempat_lahir').val(),
          tanggal_lahir: $('#setelah_menikah_tanggal_lahir').val(),
          pekerjaan: $('#setelah_menikah_pekerjaan').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.setelah_menikah_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('.btn-setelah-menikah-spinner').removeClass('d-none');
            $('.btn-setelah-menikah-save').addClass('d-none');
          },
          success: function(response) {
            var setelah_menikah_data = "";

            if (response.setelah_menikahs.length == 0) {
              setelah_menikah_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.setelah_menikahs, function(index, value) {
                setelah_menikah_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.hubungan + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.tempat_lahir + "</td>" +
                    "<td class=\"text-center\">" + value.tanggal_lahir + "</td>" +
                    "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"setelah_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_setelah_menikah').append(setelah_menikah_data);

            // empty value
            $('#setelah_menikah_hubungan').val("");
            $('#setelah_menikah_nama').val("");
            $('#setelah_menikah_tempat_lahir').val("");
            $('#setelah_menikah_tanggal_lahir').val("");
            $('#setelah_menikah_pekerjaan').val("");

            Toast.fire({
              icon: 'success',
              title: 'Data setelah menikah berhasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-setelah-menikah-spinner').addClass('d-none');
              $('.btn-setelah-menikah-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.setelah_menikah_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_setelah_menikah').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.setelah_menikah_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            var setelah_menikah_data = "";

            if (response.setelah_menikahs.length == 0) {
              setelah_menikah_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.setelah_menikahs, function(index, value) {
                setelah_menikah_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.hubungan + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.tempat_lahir + "</td>" +
                    "<td class=\"text-center\">" + value.tanggal_lahir + "</td>" +
                    "<td class=\"text-center\">" + value.pekerjaan_terakhir + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"setelah_menikah_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_setelah_menikah').append(setelah_menikah_data);

            Toast.fire({
              icon: 'success',
              title: 'Data setelah menikah berhasil dihapus'
            });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });

    // kerabat darurat
    kerabatDarurat();
    function kerabatDarurat() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.kerabat_darurat", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url:url,
        type: 'GET',
        success: function(response) {
          var kerabat_darurat_data = "";

          if (response.kerabat_darurats.length == 0) {
            kerabat_darurat_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.kerabat_darurats, function(index, value) {
              kerabat_darurat_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + value.hubungan + "</td>" +
                  "<td class=\"text-center\">" + value.nama + "</td>" +
                  "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                  "<td class=\"text-center\">" + value.telepon + "</td>" +
                  "<td class=\"text-center\">" + value.alamat + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"kerabat_darurat_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_kerabat_darurat').append(kerabat_darurat_data);
        }
      });
    }

    $('#kerabat_darurat_form').submit(function(e) {
      e.preventDefault();
      if ($('#kerabat_darurat_hubungan').val() == "" || $('#kerabat_darurat_nama').val() == "" || $('#kerabat_darurat_jenis_kelamin').val() == "" || $('#kerabat_darurat_telepon').val() == "" || $('#kerabat_darurat_alamat').val() == "") {
        alert('Formulir tidak boleh kosong');
      } else {
        $('#data_kerabat_darurat').empty();

        var formData = {
          id: $('#id').val(),
          hubungan: $('#kerabat_darurat_hubungan').val(),
          nama: $('#kerabat_darurat_nama').val(),
          jenis_kelamin: $('#kerabat_darurat_jenis_kelamin').val(),
          telepon: $('#kerabat_darurat_telepon').val(),
          alamat: $('#kerabat_darurat_alamat').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.kerabat_darurat_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('.btn-kerabat-darurat-spinner').removeClass('d-none');
            $('.btn-kerabat-darurat-save').addClass('d-none');
          },
          success: function(response) {
            var kerabat_darurat_data = "";

            if (response.kerabat_darurats.length == 0) {
              kerabat_darurat_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.kerabat_darurats, function(index, value) {
                kerabat_darurat_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.hubungan + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                    "<td class=\"text-center\">" + value.telepon + "</td>" +
                    "<td class=\"text-center\">" + value.alamat + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"kerabat_darurat_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_kerabat_darurat').append(kerabat_darurat_data);

            // empty value
            $('#kerabat_darurat_hubungan').val("");
            $('#kerabat_darurat_nama').val("");
            $('#kerabat_darurat_jenis_kelamin').val("");
            $('#kerabat_darurat_tanggal_telepon').val("");
            $('#kerabat_darurat_alamat').val("");

            Toast.fire({
              icon: 'success',
              title: 'Data kerabat darurat berhasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-kerabat-darurat-spinner').addClass('d-none');
              $('.btn-kerabat-darurat-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.kerabat_darurat_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_kerabat_darurat').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.kerabat_darurat_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
              var kerabat_darurat_data = "";

              if (response.kerabat_darurats.length == 0) {
                kerabat_darurat_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\" colspan=\"6\">Kosong</td>";
                  "</tr>";
              } else {
                $.each(response.kerabat_darurats, function(index, value) {
                  kerabat_darurat_data += "" +
                    "<tr>" +
                      "<td class=\"text-center\">" + value.hubungan + "</td>" +
                      "<td class=\"text-center\">" + value.nama + "</td>" +
                      "<td class=\"text-center\">" + value.jenis_kelamin + "</td>" +
                      "<td class=\"text-center\">" + value.telepon + "</td>" +
                      "<td class=\"text-center\">" + value.alamat + "</td>" +
                      "<td class=\"text-center\">" +
                        "<button class=\"kerabat_darurat_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                          "<i class=\"fa fa-trash\"></i>" +
                        "</button>" +
                      "</td>" +
                    "</tr>";
                });
              }
              $('#data_kerabat_darurat').append(kerabat_darurat_data);

              Toast.fire({
                icon: 'success',
                title: 'Data kerabat darurat berhasil dihapus'
              });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });

    // pendidikan
    pendidikan();
    function pendidikan() {
      var id = $('#id').val();
      var url = '{{ route("karyawan.pendidikan", ":id") }}';
      url = url.replace(':id', id );

      $.ajax({
        url:url,
        type: 'GET',
        success: function(response) {
          var pendidikan_data = "";

          if (response.pendidikans.length == 0) {
            pendidikan_data += "" +
              "<tr>" +
                "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
              "</tr>";
          } else {
            $.each(response.pendidikans, function(index, value) {
              pendidikan_data += "" +
                "<tr>" +
                  "<td class=\"text-center\">" + value.tingkat + "</td>" +
                  "<td class=\"text-center\">" + value.nama + "</td>" +
                  "<td class=\"text-center\">" + value.kota + "</td>" +
                  "<td class=\"text-center\">" + value.jurusan + "</td>" +
                  "<td class=\"text-center\">" + value.tahun_masuk + "</td>" +
                  "<td class=\"text-center\">" + value.tahun_lulus + "</td>" +
                  "<td class=\"text-center\">" +
                    "<button class=\"pendidikan_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                      "<i class=\"fa fa-trash\"></i>" +
                    "</button>" +
                  "</td>" +
                "</tr>";
            });
          }
          $('#data_pendidikan').append(pendidikan_data);
        }
      });
    }

    $('#pendidikan_form').submit(function(e) {
      e.preventDefault();
      if ($('#pendidikan_tingkat').val() == "" || $('#pendidikan_nama').val() == "" || $('#pendidikan_kota').val() == "" || $('#pendidikan_jurusan').val() == "" || $('#pendidikan_tahun_masuk').val() == "" || $('#pendidikan_tahun_lulus').val() == "") {
          alert('Formulir tidak boleh kosong');
      } else {
        $('#data_pendidikan').empty();

        var formData = {
          id: $('#id').val(),
          tingkat: $('#pendidikan_tingkat').val(),
          nama: $('#pendidikan_nama').val(),
          kota: $('#pendidikan_kota').val(),
          jurusan: $('#pendidikan_jurusan').val(),
          tahun_masuk: $('#pendidikan_tahun_masuk').val(),
          tahun_lulus: $('#pendidikan_tahun_lulus').val()
        }

        $.ajax({
          url: "{{ URL::route('karyawan.pendidikan_store') }}",
          type: 'POST',
          data: formData,
          beforeSend: function() {
              $('.btn-pendidikan-spinner').removeClass('d-none');
              $('.btn-pendidikan-save').addClass('d-none');
          },
          success: function(response) {
            var pendidikan_data = "";

            if (response.pendidikans.length == 0) {
              pendidikan_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.pendidikans, function(index, value) {
                pendidikan_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.tingkat + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.kota + "</td>" +
                    "<td class=\"text-center\">" + value.jurusan + "</td>" +
                    "<td class=\"text-center\">" + value.tahun_masuk + "</td>" +
                    "<td class=\"text-center\">" + value.tahun_lulus + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"pendidikan_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_pendidikan').append(pendidikan_data);

            // empty value
            $('#pendidikan_tingkat').val("");
            $('#pendidikan_nama').val("");
            $('#pendidikan_kota').val("");
            $('#pendidikan_jurusan').val("");
            $('#pendidikan_tahun_masuk').val("");
            $('#pendidikan_tahun_lulus').val("");

            Toast.fire({
              icon: 'success',
              title: 'Data kerabat darurat berhasil diperbaharui'
            });

            setTimeout(() => {
              $('.btn-pendidikan-spinner').addClass('d-none');
              $('.btn-pendidikan-save').removeClass('d-none');
            }, 1000);
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      }
    });

    $('body').on('click', '.pendidikan_btn_delete', function() {
      var result = confirm('Yakin akan dihapus?');
      if (result) {
        $('#data_pendidikan').empty();

        var id = $(this).attr('data-id');
        var url = '{{ route("karyawan.pendidikan_delete", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            var pendidikan_data = "";

            if (response.pendidikans.length == 0) {
              pendidikan_data += "" +
                "<tr>" +
                  "<td class=\"text-center\" colspan=\"7\">Kosong</td>";
                "</tr>";
            } else {
              $.each(response.pendidikans, function(index, value) {
                pendidikan_data += "" +
                  "<tr>" +
                    "<td class=\"text-center\">" + value.tingkat + "</td>" +
                    "<td class=\"text-center\">" + value.nama + "</td>" +
                    "<td class=\"text-center\">" + value.kota + "</td>" +
                    "<td class=\"text-center\">" + value.jurusan + "</td>" +
                    "<td class=\"text-center\">" + value.tahun_masuk + "</td>" +
                    "<td class=\"text-center\">" + value.tahun_lulus + "</td>" +
                    "<td class=\"text-center\">" +
                      "<button class=\"pendidikan_btn_delete border-0 bg-transparent text-danger\" title=\"hapus\" data-id=\"" + value.id + "\">" +
                        "<i class=\"fa fa-trash\"></i>" +
                      "</button>" +
                    "</td>" +
                  "</tr>";
              });
            }
            $('#data_pendidikan').append(pendidikan_data);

            Toast.fire({
              icon: 'success',
              title: 'Data kerabat darurat berhasil diperbaharui'
            });
          },
          error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + error

            Toast.fire({
              icon: 'error',
              title: 'Error - ' + errorMessage
            });
          }
        });
      } else {
        return false;
      }
    });
	});

</script>

@endsection
