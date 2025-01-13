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
          <h1>Approver</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Approver</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-cuti-tab" data-toggle="pill" href="#custom-tabs-four-cuti" role="tab" aria-controls="custom-tabs-four-cuti" aria-selected="true">Cuti</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-resign-tab" data-toggle="pill" href="#custom-tabs-four-resign" role="tab" aria-controls="custom-tabs-four-resign" aria-selected="false">Resign</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-penggajian-tab" data-toggle="pill" href="#custom-tabs-four-penggajian" role="tab" aria-controls="custom-tabs-four-penggajian" aria-selected="false">Penggajian</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-direktur-tab" data-toggle="pill" href="#custom-tabs-four-direktur" role="tab" aria-controls="custom-tabs-four-direktur" aria-selected="false">Direktur</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-abdul-tab" data-toggle="pill" href="#custom-tabs-four-abdul" role="tab" aria-controls="custom-tabs-four-abdul" aria-selected="false">Abdul</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-lembur-tab" data-toggle="pill" href="#custom-tabs-four-lembur" role="tab" aria-controls="custom-tabs-four-lembur" aria-selected="false">Lembur</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">

                {{-- cuti --}}
                <div class="tab-pane fade show active" id="custom-tabs-four-cuti" role="tabpanel" aria-labelledby="custom-tabs-four-cuti-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-cuti px-3" data-jenis="cuti"><i class="fas fa-plus me-2"></i> Tambah Approver Cuti</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_cuti" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_cutis as $key => $approver_cuti)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_cuti->dataRole)
                                  {{ $approver_cuti->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_cuti->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_cuti" data-id="{{ $approver_cuti->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_cuti->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_cuti" data-id="{{ $approver_cuti->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_cuti->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- resign --}}
                <div class="tab-pane fade" id="custom-tabs-four-resign" role="tabpanel" aria-labelledby="custom-tabs-four-resign-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-resign px-3" data-jenis="resign"><i class="fas fa-plus me-2"></i> Tambah Approver Resign</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_resign" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_resigns as $key => $approver_resign)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_resign->dataRole)
                                  {{ $approver_resign->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_resign->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_resign" data-id="{{ $approver_resign->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_resign->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_resign" data-id="{{ $approver_resign->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_resign->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- penggajian --}}
                <div class="tab-pane fade" id="custom-tabs-four-penggajian" role="tabpanel" aria-labelledby="custom-tabs-four-penggajian-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-penggajian px-3" data-jenis="penggajian"><i class="fas fa-plus me-2"></i> Tambah Approver Penggajian</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_penggajian" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_penggajians as $key => $approver_penggajian)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_penggajian->dataRole)
                                  {{ $approver_penggajian->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_penggajian->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_penggajian" data-id="{{ $approver_penggajian->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_penggajian->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_penggajian" data-id="{{ $approver_penggajian->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_penggajian->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- direktur --}}
                <div class="tab-pane fade" id="custom-tabs-four-direktur" role="tabpanel" aria-labelledby="custom-tabs-four-direktur-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-direktur px-3" data-jenis="direktur"><i class="fas fa-plus me-2"></i> Tambah Approver Direktur</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_direktur" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_direkturs as $key => $approver_direktur)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_direktur->dataRole)
                                  {{ $approver_direktur->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_direktur->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_direktur" data-id="{{ $approver_direktur->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_direktur->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_direktur" data-id="{{ $approver_direktur->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_direktur->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- abdul --}}
                <div class="tab-pane fade" id="custom-tabs-four-abdul" role="tabpanel" aria-labelledby="custom-tabs-four-abdul-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-abdul px-3" data-jenis="abdul"><i class="fas fa-plus me-2"></i> Tambah Approver Abdul</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_abdul" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_abduls as $key => $approver_abdul)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_abdul->dataRole)
                                  {{ $approver_abdul->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_abdul->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_abdul" data-id="{{ $approver_abdul->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_abdul->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_abdul" data-id="{{ $approver_abdul->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_abdul->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- lembur --}}
                <div class="tab-pane fade" id="custom-tabs-four-lembur" role="tabpanel" aria-labelledby="custom-tabs-four-lembur-tab">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-primary btn-sm btn-tambah-lembur px-3" data-jenis="lembur"><i class="fas fa-plus me-2"></i> Tambah Approver Lembur</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="tabel_approver_lembur" class="col">
                      <table class="table table-nowrap mb-0 mt-3">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($approver_lemburs as $key => $approver_lembur)
                            <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                @if ($approver_lembur->dataRole)
                                  {{ $approver_lembur->dataRole->nama }}
                                @endif
                              </td>
                              <td>
                                <div class="row">
                                  <div class="col-10">
                                    @foreach ($approver_lembur->dataDetail as $detail)
                                      @php
                                        if ($detail->hirarki == "1") {
                                          $textColor = "text-primary";
                                        } elseif ($detail->hirarki == "2") {
                                          $textColor = "text-success";
                                        } else {
                                          $textColor = "text-warning";
                                        }
                                      @endphp
                                      <span class="text-decoration-underline px-2 {{ $textColor }}" role="button">{{ $detail->dataKaryawan ? $detail->dataKaryawan->nama_panggilan : 'Nama Panggilan Harus Diisi' }}</span>
                                    @endforeach
                                  </div>
                                  <div class="col-2">
                                    <i id="btn_tambah_approver_lembur" data-id="{{ $approver_lembur->id }}" role="button" class="fas fa-plus text-primary px-2" title="Tambah Approver"></i>
                                    @if (count($approver_lembur->dataDetail) > 0)
                                      <i id="btn_hapus_all_approver_lembur" data-id="{{ $approver_lembur->id }}" role="button" class="fas fa-times text-danger px-2" title="Hapus Approver"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td class="text-center">
                                <i id="btn_hapus_role" data-id="{{ $approver_lembur->id }}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
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
        </div>
      </div>
    </div>
  </section>
</div>

{{-- modal create --}}
<div class="modal fade" id="modal_create">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Approver</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-3">
            <label for="jenis">Jenis</label>
            <input type="text" id="jenis" name="jenis" class="form-control" readonly>
          </div>
          <div class="col-12 mb-3">
            <label for="role_id">Role</label>
            <select id="select_role" name="role_id" class="role"></select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btn_spinner" class="btn btn-primary mb-1 d-none" style="width: 130px;" type="button" disabled>
          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        </button>
        <button type="button" id="btn_simpan" class="btn btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>

{{-- modal create approver --}}
<div class="modal fade" id="modal_create_approver">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Approver</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#">
          <div class="row">
            <div class="col">
              <button id="tambah_form" class="btn btn-info"><i class="fas fa-plus"></i> Tambah Form</button>
            </div>
          </div>
          <input type="hidden" name="approver_id" id="approver_id" class="approver_id">
          <div id="form_approver"></div>
          <div class="row">
            <div class="col text-end">
              <button id="btn_spinner" class="btn btn-primary mb-1 d-none" style="width: 130px;" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              </button>
              <button type="button" id="btn_simpan" class="btn btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function() {
    const btnTambahCuti = $('.btn-tambah-cuti');
    const btnTambahResign = $('.btn-tambah-resign');
    const btnTambahPenggajian = $('.btn-tambah-penggajian');
    const btnTambahDirektur = $('.btn-tambah-direktur');
    const btnTambahAbdul = $('.btn-tambah-abdul');
    const btnTambahLembur = $('.btn-tambah-lembur');

    const modalCreateSelectRole = $('#modal_create #select_role');
    const modalCreateInpJenis = $('#modal_create #jenis');
    const modalCreateBtnSimpan = $('#modal_create #btn_simpan');
    const modalCreateSpinner = $('#modal_create #btn_spinner');

    const tabelApproverCuti = $('#tabel_approver_cuti');
    const tabelApproverResign = $('#tabel_approver_resign');
    const tabelApproverPenggajian = $('#tabel_approver_penggajian');
    const tabelApproverDirektur = $('#tabel_approver_direktur');
    const tabelApproverAbdul = $('#tabel_approver_abdul');
    const tabelApproverLembur = $('#tabel_approver_lembur');

    function tabel_data(jenis) {
      if (jenis == "cuti") {
        tabelApproverCuti.empty()
      }
      if (jenis == "resign") {
        tabelApproverResign.empty()
      }
      if (jenis == "penggajian") {
        tabelApproverPenggajian.empty()
      }
      if (jenis == "direktur") {
        tabelApproverDirektur.empty()
      }
      if (jenis == "abdul") {
        tabelApproverAbdul.empty()
      }
      if (jenis == "lembur") {
        tabelApproverLembur.empty()
      }

      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.data') }}",
        type: "post",
        data: formData,
        success: function(response) {
          // cuti
          if (jenis == "cuti") {
            let val_cuti = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_cuti += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_cuti += `${approver.data_role.nama}`;
                        }
                        val_cuti += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_cuti += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_cuti += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_cuti" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_cuti += `<i id="btn_hapus_all_approver_cuti" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_cuti += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_cuti += `
                </tbody>
              </table>
            `;
            tabelApproverCuti.append(val_cuti);
          }

          // resign
          if (jenis == "resign") {
            let val_resign = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_resign += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_resign += `${approver.data_role.nama}`;
                        }
                        val_resign += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_resign += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_resign += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_resign" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_resign += `<i id="btn_hapus_all_approver_resign" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_resign += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_resign += `
                </tbody>
              </table>
            `;
            tabelApproverResign.append(val_resign);
          }

          // penggajian
          if (jenis == "penggajian") {
            let val_penggajian = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_penggajian += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_penggajian += `${approver.data_role.nama}`;
                        }
                        val_penggajian += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_penggajian += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_penggajian += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_penggajian" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_penggajian += `<i id="btn_hapus_all_approver_penggajian" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_penggajian += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_penggajian += `
                </tbody>
              </table>
            `;
            tabelApproverPenggajian.append(val_penggajian);
          }

          // direktur
          if (jenis == "direktur") {
            let val_direktur = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_direktur += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_direktur += `${approver.data_role.nama}`;
                        }
                        val_direktur += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_direktur += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_direktur += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_direktur" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_direktur += `<i id="btn_hapus_all_approver_direktur" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_direktur += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_direktur += `
                </tbody>
              </table>
            `;
            tabelApproverDirektur.append(val_direktur);
          }

          // abdul
          if (jenis == "abdul") {
            let val_abdul = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_abdul += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_abdul += `${approver.data_role.nama}`;
                        }
                        val_abdul += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_abdul += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_abdul += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_abdul" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_abdul += `<i id="btn_hapus_all_approver_abdul" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_abdul += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_abdul += `
                </tbody>
              </table>
            `;
            tabelApproverAbdul.append(val_abdul);
          }

          // lembur
          if (jenis == "lembur") {
            let val_lembur = `
              <table class="table table-nowrap mb-0 mt-3">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Role</th>
                    <th>Approver <span class="text-primary">1</span> <span class="text-success">2</span> <span class="text-warning">3</span></th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>`;
                $.each(response.approvers, function(index, approver) {
                  val_lembur += `
                    <tr>
                      <td class="text-center">${index + 1}</td>
                      <td>`;
                        if (approver.data_role) {
                          val_lembur += `${approver.data_role.nama}`;
                        }
                        val_lembur += `
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-10">`;
                            $.each(approver.data_detail, function(index_detail, approver_detail) {
                              let textColor;
                              if (approver_detail.hirarki == "1") {
                                textColor = "text-primary";
                              } else if (approver_detail.hirarki == "2") {
                                textColor = "text-success";
                              } else {
                                textColor = "text-warning";
                              }
                              val_lembur += `<span class="text-decoration-underline px-2 ${textColor}">${approver_detail.data_karyawan.nama_panggilan}</span>`;
                            })
                            val_lembur += `
                          </div>
                          <div class="col-2">
                            <i id="btn_tambah_approver_lembur" data-id="${approver.id}" role="button" class="fas fa-plus text-primary px-2"></i>`;
                            if (approver.data_detail.length > 0) {
                              val_lembur += `<i id="btn_hapus_all_approver_lembur" data-id="${approver.id}" role="button" class="fas fa-times text-danger px-2"></i>`;
                            }
                          val_lembur += `</div>
                        </div>
                      </td>
                      <td class="text-center">
                        <i id="btn_hapus_role" data-id="${approver.id}" role="button" class="fas fa-trash-alt text-danger" title="Hapus Role"></i>
                      </td>
                    </tr>`;
                })
                val_lembur += `
                </tbody>
              </table>
            `;
            tabelApproverLembur.append(val_lembur);
          }
        }
      })
    }

    $("#modal_create #select_role").select2({
      tags: true,
      dropdownParent: $('#modal_create'),
      theme: 'bootstrap4'
    });

    btnTambahCuti.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    btnTambahResign.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    btnTambahPenggajian.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    btnTambahDirektur.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    btnTambahAbdul.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    btnTambahLembur.on('click', function(e) {
      e.preventDefault();
      modalCreateSelectRole.empty();
      const jenis = $(this).attr('data-jenis');
      let formData = {
        jenis: jenis
      }

      $.ajax({
        url: "{{ route('approver.create') }}",
        type: "post",
        data: formData,
        success: function(response) {
          let role_val = `<option value="">Pilih Role</option>`;
          $.each(response.roles, function(index, role) {
            role_val += `<option value="${role.id}">${role.nama}</option>`;
          })
          modalCreateSelectRole.append(role_val);
          modalCreateInpJenis.val(response.jenis);
          $('#modal_create').modal('show');
        }
      });
    })

    // simpan role
    modalCreateBtnSimpan.on('click', function(e) {
      e.preventDefault();
      let formData = {
        jenis: $('#modal_create #jenis').val(),
        role_id: $('#modal_create #select_role').val()
      }
      
      $.ajax({
        url: "{{ route('approver.store') }}",
        type: "post",
        data: formData,
        success: function(response) {
          tabel_data(response.jenis);
          $('#modal_create').modal('hide');
        }
      })
    })

    $('#tabel_approver_cuti').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver cuti
      if (id === "btn_tambah_approver_cuti") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke" required>
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver cuti
      if (id === "btn_hapus_all_approver_cuti") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    $('#tabel_approver_resign').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver resign
      if (id === "btn_tambah_approver_resign") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke">
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver resign
      if (id === "btn_hapus_all_approver_resign") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    $('#tabel_approver_penggajian').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver penggajian
      if (id === "btn_tambah_approver_penggajian") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke">
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver penggajian
      if (id === "btn_hapus_all_approver_penggajian") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    $('#tabel_approver_direktur').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver direktur
      if (id === "btn_tambah_approver_direktur") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke">
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver direktur
      if (id === "btn_hapus_all_approver_direktur") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    $('#tabel_approver_abdul').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver abdul
      if (id === "btn_tambah_approver_abdul") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke">
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver abdul
      if (id === "btn_hapus_all_approver_abdul") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    $('#tabel_approver_lembur').on('click', function(e) {
      const id = e.target.getAttribute('id');
      const dataId = e.target.dataset.id;

      if (!id) return;

      // btn tambah approver lembur
      if (id === "btn_tambah_approver_lembur") {
        $('#modal_create_approver #form_approver').empty();
  
        let url = "{{ route('approver.createApprover', ':id') }}";
        url = url.replace(":id", dataId);
  
        $.ajax({
          url: url,
          type: "get",
          success: function(response) {
            let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_0" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `
                  </select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke">
              </div>
            </div>`;
  
            $('#modal_create_approver').modal('show');
            $('#modal_create_approver #approver_id').val(response.id);
            $('#modal_create_approver #form_approver').append(form_val);
            $('#modal_create_approver #karyawan_id_0').select2({
              dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
            });
          }
        })
      }
      
      // btn hapus all approver lembur
      if (id === "btn_hapus_all_approver_lembur") {
        let teks = "Yakin akan menghapus approver?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.deleteAllApproverDetail', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }

      // btn hapus role
      if (id === "btn_hapus_role") {
        let teks = "Yakin akan menghapus role?";
        if (confirm(teks) == true) {
          let url = "{{ route('approver.delete', ':id') }}";
          url = url.replace(":id", dataId);

          $.ajax({
            url: url,
            type: "get",
            success: function(response) {
              tabel_data(response.jenis);
              $('#modal_create_approver').modal('hide');
            }
          })
        }
      }
    })

    let jmlForm = 0; // untuk counter form
    $('#modal_create_approver #tambah_form').on('click', function(e) {
      e.preventDefault();
      jmlForm = jmlForm + 1;

      const dataId = $('#modal_create_approver #approver_id').val();
      let url = "{{ route('approver.createApprover', ':id') }}";
      url = url.replace(":id", dataId);

      $.ajax({
        url: url,
        type: "get",
        success: function(response) {
          let form_val = `
            <div class="row my-3">
              <div class="col-6">
                <select name="karyawan_id" id="karyawan_id_${jmlForm}" class="karyawan form-control">
                  <option value="">Pilih Approver</option>`;
                  $.each(response.karyawans, function(index, karyawan) {
                    form_val += `<option value="${karyawan.id}">${karyawan.nama_lengkap}</option>`;
                  })
                form_val += `</select>
              </div>
              <div class="col-6">
                <input type="number" name="hirarki" id="hirarki" class="hirarki form-control" placeholder="Approver Ke" required>
              </div>
            </div>
          `;
          $('#modal_create_approver #form_approver').append(form_val);
          $(`#modal_create_approver #karyawan_id_${jmlForm}`).select2({
            dropdownParent: $('#modal_create_approver'),
              theme: 'bootstrap4'
          });
        }
      })
    })

    // submit approver
    $(document).on('click', '#modal_create_approver #btn_simpan', function(e) {
      e.preventDefault();
      let karyawan = [];
      let hirarki = [];

      $('#modal_create_approver .karyawan').each(function() {
        karyawan.push($(this).val())
      })
      $('#modal_create_approver .hirarki').each(function() {
        hirarki.push($(this).val())
      })

      $.ajax({
        url: "{{ route('approver.storeApprover') }}",
        type: "post",
        data: {
          approver_id: $('#modal_create_approver .approver_id').val(),
          karyawan: karyawan,
          hirarki: hirarki
        },
        success: function(response) {
          tabel_data(response.jenis);
          $('#modal_create_approver').modal('hide');
        }
      })
    })
  })
</script>
@endsection
