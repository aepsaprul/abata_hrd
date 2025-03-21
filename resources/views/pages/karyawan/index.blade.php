@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Karyawan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            @if (in_array("tambah", $current_data_navigasi))
              <div class="card-header">
                <div>
                  <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm px-3" style="width: 120px;">
                    <i class="fas fa-plus"></i> Tambah
                  </button>
                  <a href="{{ route('dashboard.rekap.karyawan') }}" class="btn bg-gradient-primary btn-sm px-3" style="width: 150px;">
                    <i class="fas fa-eye"></i> Tampil Rekap
                  </a>
                  <button type="button" id="btn_rekap" class="btn bg-gradient-primary btn-sm px-3" style="width: 150px;">
                    <i class="fas fa-file-excel"></i> Download Rekap
                  </button>
                  <button type="button" id="btn_rekap_kontrak" class="btn bg-gradient-primary btn-sm px-3" style="width: 200px;">
                    <i class="fas fa-file-excel"></i> Download Rekap Kontrak
                  </button>
                  <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm px-3" data-toggle="collapse" data-target="#form_filter" style="width: 120px;">
                    <i class="fas fa-filter"></i> Filter
                  </button>
                  <form id="filterForm">
                    <div id="form_filter" class="row collapse mt-3">
                      <div class="col-12">
                        {{-- filter cabang --}}
                        <div class="font-weight-bold border-bottom mb-2 pb-2">Cabang</div>
                        @foreach ($cabangs as $cabang)
                          <div class="form-check">
                            <input type="checkbox" name="filter_cabang[]" value="{{ $cabang->id }}" id="cabang-{{ $cabang->nama_cabang }}" class="form-check-input" {{ in_array($cabang->nama_cabang, $selectedFilters['cabang'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cabang-{{ $cabang->nama_cabang }}">
                              {{ $cabang->nama_cabang }}
                            </label>
                          </div>
                        @endforeach
                        {{-- filter status --}}
                        <div class="font-weight-bold border-bottom mb-2 pb-2">Status</div>
                        <label for="status_aktif" class="mr-3" style="font-weight: 400;">
                          <input type="checkbox" name="filter_status[]" id="status_aktif" class="mr-1" value="Aktif"> Aktif
                        </label>
                        <label for="status_nonaktif" class="mr-3" style="font-weight: 400;">
                          <input type="checkbox" name="filter_status[]" id="status_nonaktif" class="mr-1" value="Nonaktif"> Nonaktif
                        </label>
                        {{-- filter kontrak --}}
                        <div class="font-weight-bold border-bottom mb-2 pb-2">Kontrak</div>
                        <select name="bulan" id="bulan" class="form-control">
                          <option value="">-- Pilih --</option>
                          <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>3 Bulan</option>
                          <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>6 Bulan</option>
                          <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>12 Bulan</option>
                          <option value="24" {{ request('bulan') == '24' ? 'selected' : '' }}>24 Bulan</option>
                        </select>
                      </div>
                      <div class="col-12 mt-3">
                        <button type="button" id="applyFilter" class="btn btn-sm btn-primary px-3"><i class="fas fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            @endif
            <div class="card-body">
              <div id="tabel_wrap">
                <table id="tabel_karyawan" class="table table-bordered table-striped" style="font-size: 13px; width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Aksi</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">BPJS TK</th>
                      <th class="text-center">BPJS Kes</th>
                      <th class="text-center">Telepon</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Akhir Kontrak</th>
                      <th class="text-center">Lama Kontrak</th>
                      <th class="text-center">Jabatan</th>
                      <th class="text-center">Divisi</th>
                      <th class="text-center">Cabang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($karyawans as $key => $item)
                      <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">
                          @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
                            <div class="btn-group">
                              <a href="#" class="dropdown-toggle btn bg-gradient-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                @if (in_array("lihat", $current_data_navigasi))
                                  <a href="{{ route('karyawan.show', [encrypt($item->id)]) }}" class="dropdown-item border-bottom btn-show text-indigo">
                                    <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Lihat
                                  </a>
                                @endif
                                @if (in_array("ubah", $current_data_navigasi))
                                  <a href="{{ route('karyawan.edit', [encrypt($item->id)]) }}" class="dropdown-item border-bottom btn-edit text-indigo">
                                    <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                  </a>
                                  <a href="#" class="dropdown-item border-bottom btn-resetpassword text-indigo" data-id="{{ $item->id }}">
                                    <i class="fas fa-lock text-center mr-2" style="width: 20px;"></i> Reset Password
                                  </a>
                                @endif
                                @if (in_array("hapus", $current_data_navigasi))
                                  <a href="#" class="dropdown-item btn-delete text-indigo" data-id="{{ $item->id }}">
                                    <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                  </a>
                                @endif
                              </div>
                            </div>
                          @endif
                        </td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td class="text-center">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="bpjs_tk" class="custom-control-input" id="bpjs_tk_{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->bpjs_tk == "sudah" ? "checked" : "" }}>
                            <label class="custom-control-label" for="bpjs_tk_{{ $item->id }}"></label>
                          </div>
                          <span class="bpjs_tk_title_{{ $item->id }}" style="font-size: 12px;">{{ $item->bpjs_tk }}</span>
                        </td>
                        <td class="text-center">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="bpjs_kes" class="custom-control-input" id="bpjs_kes_{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->bpjs_kes == "sudah" ? "checked" : "" }}>
                            <label class="custom-control-label" for="bpjs_kes_{{ $item->id }}"></label>
                          </div>
                          <span class="bpjs_kes_title_{{ $item->id }}" style="font-size: 12px;">{{ $item->bpjs_kes }}</span>
                        </td>
                        <td>{{ $item->telepon }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="status" class="custom-control-input" id="status_{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->status == "Aktif" ? "checked" : "" }}>
                            <label class="custom-control-label" for="status_{{ $item->id }}"></label>
                          </div>
                          <span class="status_title_{{ $item->id }}" style="font-size: 12px;">{{ $item->status }}</span>
                        </td>
                        <td>{{ $item->kontrak->last() ? tglCarbon($item->kontrak->last()->akhir_kontrak, "d/m/Y") : '' }}</td>
                        <td>{{ $item->kontrak->last() ? $item->kontrak->last()->lama_kontrak : '' }}</td>
                        <td>
                          @if ($item->masterJabatan)
                            {{ $item->masterJabatan->nama_jabatan }}
                          @endif
                        </td>
                        <td>
                          @if ($item->masterDivisi)
                            {{ $item->masterDivisi->nama }}
                          @endif
                        </td>
                        <td>
                          @if ($item->masterCabang)
                            {{ $item->masterCabang->nama_cabang }}
                          @endif
                        </td>
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
  </section>
</div>
<!-- /.content-wrapper -->

{{-- modal create --}}
<div class="modal fade modal-create" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id="form-create" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-primary card-outline pb-1">
                <div class="card-body box-profile">
                  <div class="text-center profile_img create_profile_img">
                    <img class="profile-user-img img-fluid" src="{{ asset(env('APP_URL_IMG') . 'assets/no-image.jpg') }}" alt="User profile picture" style="width: 100%;">
                  </div>
                  <div class="form-group">
                    <label for="create_foto">Foto</label>
                    <input type="file" id="create_foto" name="foto" class="form-control form-control-sm" >
                    <small id="errorFoto" class="form-text text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="create_nik">NIK</label>
                    <input type="text" id="create_nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                    <small id="errorNik" class="form-text text-danger"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card card-primary card-outline pb-1">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="create_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                        <small id="errorNamaLengkap" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_nama_panggilan">Nama Panggilan</label>
                        <input type="text" id="create_nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                        <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="create_jenis_kelamin" class="form-control form-control-sm">
                          <option value="L">L (Laki - laki)</option>
                          <option value="P">P (Perempuan)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_nomor_ktp">Nomor KTP</label>
                        <input type="text" id="create_nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                        <small id="errorNomorKtp" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_status_perkawinan">Status Perkawinan</label>
                        <select name="status_perkawinan" id="create_status_perkawinan" class="form-control form-control-sm">
                          <option value="lajang">Lajang</option>
                          <option value="menikah">Menikah</option>
                          <option value="cerai">Cerai</option>
                        </select>
                        <small id="errorStatusPerkawinan" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_agama">Agama</label>
                        <select name="agama" id="create_agama" class="form-control form-control-sm">
                          <option value="islam">Islam</option>
                          <option value="kristen_protestan">Kristen Protestan</option>
                          <option value="katholik">Katholik</option>
                          <option value="hindu">Hindu</option>
                          <option value="budha">Budha</option>
                          <option value="kong_hu_cu">Kong Hu Cu</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="create_tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                        <small id="errorTempatLahir" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="create_tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                        <small id="errorTanggalLahir" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_alamat_asal">Alamat KTP</label>
                        <textarea name="alamat_asal" id="create_alamat_asal" cols="30" rows="2" class="form-control"></textarea>
                        <small id="errorAlamatAsal" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_alamat_domisili">Alamat Domisili</label>
                        <textarea name="alamat_domisili" id="create_alamat_domisili" cols="30" rows="2" class="form-control"></textarea>
                        <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="sim">Jenis & Nomor SIM</label>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-4">
                            <input type="text" id="create_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10">
                            <small id="errorJenisSim" class="form-text text-danger"></small>
                          </div>
                          <div class="col-md-8 col-sm-8 col-8">
                            <input type="text" id="create_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15">
                            <small id="errorNomorSim" class="form-text text-danger"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_cabang_id">Cabang</label>
                        <select name="master_cabang_id" id="create_cabang_id" class="form-control form-control-sm"></select>
                        <small id="errorCabangId" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_jabatan_id">Jabatan</label>
                        <select name="master_jabatan_id" id="create_jabatan_id" class="form-control form-control-sm create-select-jabatan"></select>
                        <small id="errorJabatanId" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_divisi_id">Divisi</label>
                        <select name="master_divisi_id" id="create_divisi_id" class="form-control form-control-sm"></select>
                        <small id="errorDivisiId" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_rekening_nomor">Nomor Rekening</label>
                        <input type="text" id="create_rekening_nomor" name="rekening_nomor" class="form-control form-control-sm" maxlength="15">
                        <small id="errorRekeningNomor" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_telepon">Telepon</label>
                        <input type="text" id="create_telepon" name="telepon" class="form-control form-control-sm" maxlength="15">
                        <small id="errorTelepon" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="create_email">Email</label>
                        <input type="email" id="create_email" name="email" class="form-control form-control-sm" maxlength="50">
                        <small id="errorEmail" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control form-control-sm create-select2-role"></select>
                        <small id="errorRole" class="form-text text-danger"></small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between m-3">
            <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;">
              <span aria-hidden="true"><i class="fas fa-times"></i> Tutup</span>
            </button>
            <div>
              <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                <span class="spinner-grow spinner-grow-sm"></span>
                Loading...
              </button>
              <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal reset password --}}
<div class="modal fade modal-resetpassword" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form-resetpassword">
        <input type="hidden" id="resetpassword_id" name="id">
        <div class="modal-header">
          <h5 class="modal-title">Yakin akan reset password <span class="modal-nama"></span> ?</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
          <button class="btn btn-primary btn-resetpassword-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-resetpassword-save text-center" style="width: 130px;">
            Ya
          </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form-delete">
        <input type="hidden" id="delete_id" name="id">
        <div class="modal-header">
          <h5 class="modal-title">Yakin akan dihapus?</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
          <button class="btn btn-primary btn-delete-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-delete-save text-center" style="width: 130px;">
            Ya
          </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script>
  $(function () {
    $("#tabel_karyawan").DataTable({
      "responsive": true
    });
  });

  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#btn_rekap').on('click', function() {
      window.open("{{ route('dashboard.rekap.download') }}", "_blank");
    })

    $('#btn_rekap_kontrak').on('click', function() {
      window.open("{{ route('dashboard.rekap.kontrak.download') }}", "_blank");
    })

    // filter
    $('#applyFilter').click(function () {
      // Ambil data filter
      let formData = $('#filterForm').serialize();
      
      // Kirim data ke server menggunakan AJAX
      $.ajax({
        url: "{{ route('karyawan.filter') }}",
        type: "POST",
        data: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {   
          console.log(response);
          
          // Kosongkan tabel sebelumnya
          $('#tabel_wrap').empty();

          // Periksa apakah ada data
          if (response.karyawans.length === 0) {
            $('#karyawanTable tbody').append('<tr><td colspan="5" class="text-center">Tidak ada data ditemukan.</td></tr>');
          } else {
            // Tampilkan data ke tabel
            let data = `
              <table id="tabel_karyawan" class="table table-bordered table-striped" style="font-size: 13px; width: 100%;">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">BPJS TK</th>
                    <th class="text-center">BPJS Kes</th>
                    <th class="text-center">Telepon</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Divisi</th>
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Akhir Kontrak</th>
                    <th class="text-center">Lama Kontrak</th>
                  </tr>
                </thead>
                <tbody>
            `;
            $.each(response.karyawans, function (index_karyawan, item) {
              data += `
                <tr>
                  <td>${index_karyawan + 1}</td>
                  <td>${item.nama_lengkap}</td>
                  <td class="text-center">
                    <div class="custom-control custom-switch custom-switch-on-success">
                      <input type="checkbox" name="bpjs_tk" class="custom-control-input" id="bpjs_tk_${item.id}" data-id="${item.id}" ${item.bpjs_tk == "sudah" ? "checked" : ""}>
                      <label class="custom-control-label" for="bpjs_tk_${item.id}"></label>
                    </div>
                    <span class="bpjs_tk_title_${item.id}" style="font-size: 12px;">${item.bpjs_tk}</span>
                  </td>
                  <td class="text-center">
                    <div class="custom-control custom-switch custom-switch-on-success">
                      <input type="checkbox" name="bpjs_kes" class="custom-control-input" id="bpjs_kes_${item.id}" data-id="${item.id}" ${item.bpjs_kes == "sudah" ? "checked" : ""}>
                      <label class="custom-control-label" for="bpjs_kes_${item.id}"></label>
                    </div>
                  <span class="bpjs_kes_title_${item.id}" style="font-size: 12px;">${item.bpjs_kes}</span>
                  </td>
                  <td class="text-center">${item.telepon}</td>
                  <td>${item.email}</td>
                  <td>${item.master_jabatan ? item.master_jabatan.nama_jabatan : ''}</td>
                  <td>${item.master_divisi ? item.master_divisi.nama : ''}</td>
                  <td>${item.master_cabang ? item.master_cabang.nama_cabang : ''}</td>
                  <td class="text-center">
                    <div class="custom-control custom-switch custom-switch-on-success">
                      <input type="checkbox" name="status" class="custom-control-input" id="status_${item.id}" data-id="${item.id}" ${item.status == "Aktif" ? "checked" : ""}>
                      <label class="custom-control-label" for="status_${item.id}"></label>
                    </div>
                    <span class="status_title_${item.id}" style="font-size: 12px;">${item.status}</span>
                  </td>
                  <td class="text-center">${item.kontrak_terakhir ? item.kontrak_terakhir.akhir_kontrak : ''}</td>
                  <td class="text-right">${item.kontrak_terakhir ? item.kontrak_terakhir.lama_kontrak : ''}</td>
                </tr>
              `;
            });
            data += `
              </tbody>
            `;

            $('#tabel_wrap').append(data);
            $('#tabel_karyawan').DataTable({
              "ordering": false,
              "responsive": true,
            });
          }
        },
        error: function (xhr, status, error) {
          alert("Terjadi kesalahan. Silakan coba lagi.");
        }
      });
    });

    $(document).on('shown.bs.tab', function () {
      $('.show-select-jabatan').select2();
    });

    // ubath status
    $(document).on('change', 'input[name="status"]', function () {
      let id = $(this).attr('data-id');
      let val_state;

      if ($('#status_' + id).is(":checked")) {
        val_state = "Aktif";
      } else {
        val_state = "Nonaktif";
      }

      $('.status_title_' + id).empty();

      var formData = {
        id: $(this).attr('data-id'),
        status: val_state
      }

      $.ajax({
        type: "post",
        url: "{{ URL::route('karyawan.ubah_status') }}",
        data: formData,
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Status Karyawan berhasil diubah'
          });

          $('.status_title_' + response.id).append(response.title);
        }
      });
    });

    // ubath bpjs tk
    $(document).on('change', 'input[name="bpjs_tk"]', function () {
      let id = $(this).attr('data-id');
      let val_state;

      if ($('#bpjs_tk_' + id).is(":checked")) {
        val_state = "sudah";
      } else {
        val_state = "belum";
      }

      $('.bpjs_tk_title_' + id).empty();

      var formData = {
        id: $(this).attr('data-id'),
        bpjs_tk: val_state
      }

      $.ajax({
        type: "post",
        url: "{{ URL::route('karyawan.ubah_bpjs_tk') }}",
        data: formData,
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'BPJS TK berhasil diubah'
          });

          $('.bpjs_tk_title_' + response.id).append(response.title);
        }
      });
    });

    // ubath bpjs kes
    $(document).on('change', 'input[name="bpjs_kes"]', function () {
      let id = $(this).attr('data-id');
      let val_state;

      if ($('#bpjs_kes_' + id).is(":checked")) {
        val_state = "sudah";
      } else {
        val_state = "belum";
      }

      $('.bpjs_kes_title_' + id).empty();

      var formData = {
        id: $(this).attr('data-id'),
        bpjs_kes: val_state
      }

      $.ajax({
        type: "post",
        url: "{{ URL::route('karyawan.ubah_bpjs_kes') }}",
        data: formData,
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'BPJS Kesehatan berhasil diubah'
          });

          $('.bpjs_kes_title_' + response.id).append(response.title);
        }
      });
    });

    // create foto
    $('input[type="file"][name="foto"]').on('change', function() {
      var img_path = $(this)[0].value;
      var img_holder = $('.create_profile_img');
      var currentImagePath = $(this).data('value');
      var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
      if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
        if (typeof(FileReader) != 'undefind') {
          img_holder.empty();
          var reader = new FileReader();
          reader.onload = function(e) {
            $('<img/>', {'src':e.target.result, 'class':'profile-user-img img-fluid', 'style': 'width: 100%'}).appendTo(img_holder);
          }
          img_holder.show();
          reader.readAsDataURL($(this)[0].files[0]);
        } else {
          $(img_holder).html('Browser tidak support FileReader');
        }
      } else {
        $(img_holder).html(currentImagePath);
      }
    });

    // edit foto
    $('input[type="file"][name="foto"]').on('change', function() {
      var img_path = $(this)[0].value;
      var img_holder = $('.edit_profile_img');
      var currentImagePath = $(this).data('value');
      var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
      if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
        if (typeof(FileReader) != 'undefind') {
          img_holder.empty();
          var reader = new FileReader();
          reader.onload = function(e) {
            $('<img/>', {'src':e.target.result, 'class':'profile-user-img img-fluid img-circle'}).appendTo(img_holder);
          }
          img_holder.show();
          reader.readAsDataURL($(this)[0].files[0]);
        } else {
          $(img_holder).html('Browser tidak support FileReader');
        }
      } else {
        $(img_holder).html(currentImagePath);
      }
    });

    $('#btn-create').on('click', function() {
      $.ajax({
        url: "{{ URL::route('karyawan.create') }}",
        type: "GET",
        success: function (response) {
          var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
          $.each(response.jabatans, function (index, value) {
            value_jabatan += "<option value=\"" + value.id + "\">" + value.nama_jabatan + "</option>";
          });
          $('#create_jabatan_id').append(value_jabatan);

          var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
          $.each(response.cabangs, function (index, value) {
            value_cabang += "<option value=\"" + value.id + "\">" + value.nama_cabang + "</option>";
          });
          $('#create_cabang_id').append(value_cabang);

          var value_divisi = "<option value=\"\">--Pilih Divisi--</option>";
          $.each(response.divisis, function (index, value) {
            value_divisi += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
          });
          $('#create_divisi_id').append(value_divisi);

          var value_role = "<option value=\"\">--Pilih Role--</option>";
          $.each(response.roles, function (index, value) {
            value_role += "<option value=\"" + value.nama + "\">" + value.nama + "</option>";
          });
          $('#role').append(value_role);

          $('.modal-create').modal('show');
        }
      });
    });

    $(document).on('shown.bs.modal', '.modal-create', function() {
      $('#create_nama_lengkap').focus();

      $('.create-select-jabatan').select2({
        dropdownParent: $(".modal-create")
      });

      $('.create-select2-role').select2({
        dropdownParent: $(".modal-create")
      });
    });

    $(document).on('submit', '#form-create', function (e) {
      e.preventDefault();

      $('#errorNik').empty();
      $('#errorTelepon').empty();
      $('#errorEmail').empty();
      $('#errorNamaLengkap').empty();
      $('#errorNamaPanggilan').empty();
      $('#errorNomorKtp').empty();
      $('#errorStatusPerkawinan').empty();
      $('#errorTempatLahir').empty();
      $('#errorTanggalLahir').empty();
      $('#errorAlamatAsal').empty();
      $('#errorAlamatDomisili').empty();
      $('#errorJenisSim').empty();
      $('#errorNomorSim').empty();
      $('#errorCabangId').empty();
      $('#errorJabatanId').empty();
      $('#errorDivisiId').empty();
      $('#errorRole').empty();
      $('#errorFoto').empty();
      $('#errorRekeningNomor').empty();

      let formData = new FormData($('#form-create')[0]);

      $.ajax({
        url: "{{ URL::route('karyawan.store') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.btn-create-spinner').removeClass('d-none');
          $('.btn-create-save').addClass('d-none');
        },
        success: function (response) {
          if (response.status == 400) {
            $('#errorNik').append(response.errors.nik);
            $('#errorTelepon').append(response.errors.telepon);
            $('#errorEmail').append(response.errors.email);
            $('#errorNamaLengkap').append(response.errors.nama_lengkap);
            $('#errorNamaPanggilan').append(response.errors.nama_panggilan);
            $('#errorNomorKtp').append(response.errors.nomor_ktp);
            $('#errorStatusPerkawinan').append(response.errors.status_perkawinan);
            $('#errorTempatLahir').append(response.errors.tempat_lahir);
            $('#errorTanggalLahir').append(response.errors.tanggal_lahir);
            $('#errorAlamatAsal').append(response.errors.alamat_asal);
            $('#errorAlamatDomisili').append(response.errors.alamat_domisili);
            $('#errorJenisSim').append(response.errors.jenis_sim);
            $('#errorNomorSim').append(response.errors.nomor_sim);
            $('#errorCabangId').append(response.errors.master_cabang_id);
            $('#errorJabatanId').append(response.errors.master_jabatan_id);
            $('#errorDivisiId').append(response.errors.master_divisi_id);
            $('#errorRole').append(response.errors.role);
            $('#errorFoto').append(response.errors.foto);
            $('#errorRekeningNomor').append(response.errors.rekening_nomor);

            setTimeout(() => {
              $('.btn-create-spinner').addClass('d-none');
              $('.btn-create-save').removeClass('d-none');
            }, 1000);
          } else {
            Toast.fire({
              icon: 'success',
              title: 'Data behasil ditambah'
            });

            setTimeout(() => {
              window.location.reload(1);
            }, 1000);
          }
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + error

          Toast.fire({
            icon: 'error',
            title: 'Error - ' + errorMessage
          });
        }
      });
    });

    // delete
    $(document).on('click', '.btn-delete', function () {
      var id = $(this).attr('data-id');
      var url = "{{ route('karyawan.delete_btn', ':id') }}";
      url = url.replace(':id', id);

      var formData = {
        id: id
      }

      $.ajax({
        url: url,
        type: 'GET',
        data: formData,
        success: function (response) {
          $('#delete_id').val(response.id);
          $('.modal-delete').modal('show');
        }
      });
    });

    $(document).on('submit', '#form-delete', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-delete')[0]);

      $.ajax({
        url: "{{ URL::route('karyawan.delete') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.btn-delete-spinner').removeClass('d-none');
          $('.btn-delete-save').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Data berhasil dihapus'
          });

          setTimeout( () => {
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
    });

    // reset password
    $(document).on('click', '.btn-resetpassword', function () {
      var id = $(this).attr('data-id');
      var url = "{{ route('karyawan.resetpassword_btn', ':id') }}";
      url = url.replace(':id', id);

      var formData = {
        id: id
      }

      $.ajax({
        url: url,
        type: 'GET',
        data: formData,
        success: function (response) {
          $('#resetpassword_id').val(response.karyawan.id);
          $('.modal-nama').html(response.karyawan.nama_lengkap.toLowerCase());
          $('.modal-resetpassword').modal('show');
          document.querySelector('.modal-nama').style.color = "red";
        }
      });
    });

    $(document).on('submit', '#form-resetpassword', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-resetpassword')[0]);

      $.ajax({
        url: "{{ URL::route('karyawan.resetpassword') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.btn-resetpassword-spinner').removeClass('d-none');
          $('.btn-resetpassword-save').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Password berhasil direset'
          });

          setTimeout( () => {
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
    });
  });
</script>

@endsection
