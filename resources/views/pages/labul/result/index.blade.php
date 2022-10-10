@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Input</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Input</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @if (in_array("activity plan", $current_data_navigasi))
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <div>
                      <span class="font-weight-bold">Activity Plan</span>
                    </div>
                    <div>
                      <form action="{{ route('labul.result.export_activity_plan') }}" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-3">
                            <span for="activity_plan_cabang_id">Cabang</span>
                            <select name="activity_plan_cabang_id" id="activity_plan_cabang_id" class="form-control form-control-sm">
                              <option value="">--Pilih Cabang--</option>
                              @foreach ($cabangs as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-3">
                            <span for="activity_plan_start_date">Start Date</span>
                            <input type="date" name="activity_plan_start_date" id="activity_plan_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                          </div>
                          <div class="col-3">
                            <span for="activity_plan_end_date">End Date</span>
                            <input type="date" name="activity_plan_end_date" id="activity_plan_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                          </div>
                          <div class="col-3">
                            <span for="">Aksi</span>
                            <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table id="activity_plan_tabel" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center text-indigo">No</th>
                        <th class="text-center text-indigo">Karyawan</th>
                        <th class="text-center text-indigo">Cabang</th>
                        <th class="text-center text-indigo">Tanggal</th>
                        <th class="text-center text-indigo">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($activity_plans as $key => $item)
                        <tr>
                          <td class="text-center">{{ $key + 1 }}</td>
                          <td>
                            @if ($item->karyawan)
                              {{ $item->karyawan->nama_panggilan }}
                            @else
                              @if ($item->karyawan_id == 0)
                                Admin
                              @endif
                            @endif
                          </td>
                          <td>
                            @if ($item->cabang)
                              {{ $item->cabang->nama_cabang }}
                            @endif
                          </td>
                          <td class="text-center">{{ $item->tanggal }}</td>
                          <td class="text-center">
                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                              <div class="btn-group">
                                <a
                                  href="#"
                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                    <a
                                      href="#"
                                      class="dropdown-item border-bottom btn-detail-activity-plan text-indigo"
                                      data-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                    </a>
                                  {{-- @endif
                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                    <a
                                    href="#"
                                    class="dropdown-item border-bottom btn-edit-activity-plan text-indigo"
                                    data-id="{{ $item->id }}">
                                      <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                  </a>
                                  {{-- @endif
                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                    <a
                                      href="#"
                                      class="dropdown-item btn-delete-activity-plan text-indigo"
                                      data-id="{{ $item->id }}">
                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                    </a>
                                  {{-- @endif --}}
                                </div>
                              </div>
                            {{-- @endif --}}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endif
          @if (in_array("data member", $current_data_navigasi))
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <div>
                      <span class="font-weight-bold">Data Member</span>
                    </div>
                    <div>
                      <form action="{{ route('labul.result.export_data_member') }}" method="post">
                          @csrf
                          <div class="row">
                            <div class="col-3">
                              <span for="data_member_cabang_id">Cabang</span>
                              <select name="data_member_cabang_id" id="data_member_cabang_id" class="form-control form-control-sm">
                                <option value="">--Pilih Cabang--</option>
                                @foreach ($cabangs as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-3">
                              <span for="data_member_start_date">Start Date</span>
                              <input type="date" name="data_member_start_date" id="data_member_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                            </div>
                            <div class="col-3">
                              <span for="data_member_end_date">End Date</span>
                              <input type="date" name="data_member_end_date" id="data_member_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-3">
                              <span for="">Aksi</span>
                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table id="data_member_tabel" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center text-indigo">No</th>
                        <th class="text-center text-indigo">Karyawan</th>
                        <th class="text-center text-indigo">Cabang</th>
                        <th class="text-center text-indigo">Tanggal</th>
                        <th class="text-center text-indigo">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_members as $key => $item)
                        <tr>
                          <td class="text-center">{{ $key + 1 }}</td>
                          <td>
                            @if ($item->karyawan)
                              {{ $item->karyawan->nama_lengkap }}
                            @else
                              @if ($item->karyawan_id == 0)
                                Admin
                              @endif
                            @endif
                          </td>
                          <td>
                            @if ($item->cabang)
                              {{ $item->cabang->nama_cabang }}
                            @endif
                          </td>
                          <td class="text-center">{{ $item->tanggal }}</td>
                          <td class="text-center">
                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                              <div class="btn-group">
                                <a
                                  href="#"
                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                    <a
                                      href="#"
                                      class="dropdown-item border-bottom btn-detail-data-member text-indigo"
                                      data-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                    </a>
                                  {{-- @endif
                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                    <a
                                      href="#"
                                      class="dropdown-item border-bottom btn-edit-data-member text-indigo"
                                      data-id="{{ $item->id }}">
                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                    </a>
                                  {{-- @endif
                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                    <a
                                      href="#"
                                      class="dropdown-item btn-delete-data-member text-indigo"
                                      data-id="{{ $item->id }}">
                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                    </a>
                                  {{-- @endif --}}
                                </div>
                              </div>
                            {{-- @endif --}}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endif
          @if (in_array("reseller", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Reseller</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_reseller') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="reseller_cabang_id">Cabang</span>
                                              <select name="reseller_cabang_id" id="reseller_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="reseller_start_date">Start Date</span>
                                              <input type="date" name="reseller_start_date" id="reseller_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="reseller_end_date">End Date</span>
                                              <input type="date" name="reseller_end_date" id="reseller_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="reseller_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($resellers as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("data reseller", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Data Reseller</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_data_reseller') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="data_reseller_cabang_id">Cabang</span>
                                              <select name="data_reseller_cabang_id" id="data_reseller_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="data_reseller_start_date">Start Date</span>
                                              <input type="date" name="data_reseller_start_date" id="data_reseller_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="data_reseller_end_date">End Date</span>
                                              <input type="date" name="data_reseller_end_date" id="data_reseller_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="data_reseller_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($data_resellers as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-data-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-data-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-data-reseller text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("instansi", $current_data_navigasi))
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <div>
                      <span class="font-weight-bold">Instansi</span>
                    </div>
                    <div>
                      <form action="{{ route('labul.result.export_instansi') }}" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-3">
                            <span for="instansi_cabang_id">Cabang</span>
                            <select name="instansi_cabang_id" id="instansi_cabang_id" class="form-control form-control-sm">
                              <option value="">--Pilih Cabang--</option>
                              @foreach ($cabangs as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-3">
                            <span for="instansi_start_date">Start Date</span>
                            <input type="date" name="instansi_start_date" id="instansi_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                          </div>
                          <div class="col-3">
                            <span for="instansi_end_date">End Date</span>
                            <input type="date" name="instansi_end_date" id="instansi_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                          </div>
                          <div class="col-3">
                            <span for="">Aksi</span>
                            <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table id="instansi_tabel" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center text-indigo">No</th>
                          <th class="text-center text-indigo">Karyawan</th>
                          <th class="text-center text-indigo">Cabang</th>
                          <th class="text-center text-indigo">Tanggal</th>
                          <th class="text-center text-indigo">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($instansis as $key => $item)
                          <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                              @if ($item->karyawan)
                                {{ $item->karyawan->nama_lengkap }}
                              @else
                                @if ($item->karyawan_id == 0)
                                  Admin
                                @endif
                              @endif
                            </td>
                            <td>
                              @if ($item->cabang)
                                {{ $item->cabang->nama_cabang }}
                              @endif
                            </td>
                              <td class="text-center">{{ $item->tanggal }}</td>
                              <td class="text-center">
                                {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                  <div class="btn-group">
                                    <a
                                      href="#"
                                      class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                      data-toggle="dropdown"
                                      aria-haspopup="true"
                                      aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                        <a
                                          href="#"
                                          class="dropdown-item border-bottom btn-detail-instansi text-indigo"
                                          data-id="{{ $item->id }}">
                                            <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                        </a>
                                      {{-- @endif
                                      {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                        <a
                                          href="#"
                                          class="dropdown-item border-bottom btn-edit-instansi text-indigo"
                                          data-id="{{ $item->id }}">
                                            <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                        </a>
                                      {{-- @endif
                                      @if (in_array("hapus", $current_data_navigasi)) --}}
                                        <a
                                          href="#"
                                          class="dropdown-item btn-delete-instansi text-indigo"
                                          data-id="{{ $item->id }}">
                                            <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                        </a>
                                      {{-- @endif --}}
                                    </div>
                                  </div>
                                {{-- @endif --}}
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endif
          @if (in_array("survey kompetitor", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Survey Kompetitor</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_survey_kompetitor') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="survey_kompetitor_cabang_id">Cabang</span>
                                              <select name="survey_kompetitor_cabang_id" id="survey_kompetitor_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="survey_kompetitor_start_date">Start Date</span>
                                              <input type="date" name="survey_kompetitor_start_date" id="survey_kompetitor_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="survey_kompetitor_end_date">End Date</span>
                                              <input type="date" name="survey_kompetitor_end_date" id="survey_kompetitor_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="survey_kompetitor_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($surveys as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-survey-kompetitor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-survey-kompetitor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-survey-kompetitor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("komplain", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Komplain (Kritik & Saran)</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_komplain') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="komplain_cabang_id">Cabang</span>
                                              <select name="komplain_cabang_id" id="komplain_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="komplain_start_date">Start Date</span>
                                              <input type="date" name="komplain_start_date" id="komplain_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="komplain_end_date">End Date</span>
                                              <input type="date" name="komplain_end_date" id="komplain_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="komplain_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($komplains as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-komplain text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-komplain text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-komplain text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("data instansi", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Data Instansi</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_data_instansi') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="data_instansi_cabang_id">Cabang</span>
                                              <select name="data_instansi_cabang_id" id="data_instansi_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="data_instansi_start_date">Start Date</span>
                                              <input type="date" name="data_instansi_start_date" id="data_instansi_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="data_instansi_end_date">End Date</span>
                                              <input type="date" name="data_instansi_end_date" id="data_instansi_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="data_instansi_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($data_instansis as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-data-instansi text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-data-instansi text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-data-instansi text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("reqor", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Request & Orderan Tertolak</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_reqor') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="reqor_cabang_id">Cabang</span>
                                              <select name="reqor_cabang_id" id="reqor_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="reqor_start_date">Start Date</span>
                                              <input type="date" name="reqor_start_date" id="reqor_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="reqor_end_date">End Date</span>
                                              <input type="date" name="reqor_end_date" id="reqor_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="reqor_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($reqors as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-reqor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-reqor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-reqor text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
          @if (in_array("omzet", $current_data_navigasi))
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card card-info card-outline">
                      <div class="card-header">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <span class="font-weight-bold">Laporan Omzet Cabang</span>
                              </div>
                              <div>
                                  <form action="{{ route('labul.result.export_omzet') }}" method="post">
                                      @csrf
                                      <div class="row">
                                          <div class="col-3">
                                              <span for="omzet_cabang_id">Cabang</span>
                                              <select name="omzet_cabang_id" id="omzet_cabang_id" class="form-control form-control-sm">
                                                  <option value="">--Pilih Cabang--</option>
                                                  @foreach ($cabangs as $item)
                                                      <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-3">
                                              <span for="omzet_start_date">Start Date</span>
                                              <input type="date" name="omzet_start_date" id="omzet_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="omzet_end_date">End Date</span>
                                              <input type="date" name="omzet_end_date" id="omzet_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                          </div>
                                          <div class="col-3">
                                              <span for="">Aksi</span>
                                              <button type="submit" class="btn btn-success btn-sm btn-block">Excel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <table id="omzet_cabang_tabel" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th class="text-center text-indigo">No</th>
                                      <th class="text-center text-indigo">Karyawan</th>
                                      <th class="text-center text-indigo">Cabang</th>
                                      <th class="text-center text-indigo">Tanggal</th>
                                      <th class="text-center text-indigo">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($omzets as $key => $item)
                                      <tr>
                                          <td class="text-center">{{ $key + 1 }}</td>
                                          <td>
                                              @if ($item->karyawan)
                                                  {{ $item->karyawan->nama_lengkap }}
                                              @else
                                                  @if ($item->karyawan_id == 0)
                                                      Admin
                                                  @endif
                                              @endif
                                          </td>
                                          <td>
                                              @if ($item->cabang)
                                                  {{ $item->cabang->nama_cabang }}
                                              @endif
                                          </td>
                                          <td class="text-center">{{ $item->tanggal }}</td>
                                          <td class="text-center">
                                            {{-- @if (in_array("lihat", $current_data_navigasi) || in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
                                              <div class="btn-group">
                                                <a
                                                  href="#"
                                                  class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                  data-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  {{-- @if (in_array("detail", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-detail-omzet text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                    </a>
                                                  {{-- @endif
                                                  {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item border-bottom btn-edit-omzet text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                    </a>
                                                  {{-- @endif
                                                  @if (in_array("hapus", $current_data_navigasi)) --}}
                                                    <a
                                                      href="#"
                                                      class="dropdown-item btn-delete-omzet text-indigo"
                                                      data-id="{{ $item->id }}">
                                                        <i class="fas fa-minus-circle text-center mr-2" style="width: 20px;"></i> Hapus
                                                    </a>
                                                  {{-- @endif --}}
                                                </div>
                                              </div>
                                            {{-- @endif --}}
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endif
        </div>
      </div>
    </section>
</div>

{{-- modal activity plan --}}
{{-- modal activity plan detail --}}
<div class="modal fade" id="modalActivityPlanDetail" tabindex="-1" role="dialog" aria-labelledby="modalActivityPlanDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActivityPlanDetailLabel">Detail Activity Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_activity_plan_cabang" class="form-label">Nama Cabang</label>
          <input type="text" id="detail_activity_plan_cabang_id" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_activity_plan_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" id="detail_activity_plan_tanggal" class="form-control" disabled>
        </div>
        <div id="detail_activity_plan_jumlah"></div>
      </div>
    </div>
  </div>
</div>
{{-- modal activity plan edit --}}
<div class="modal fade" id="modalActivityPlanEdit" tabindex="-1" role="dialog" aria-labelledby="modalActivityPlanEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-activity-plan">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActivityPlanEditLabel">Edit Activity Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_activity_plan_id" id="edit_activity_plan_id">
          <input type="hidden" name="edit_activity_plan_cabang_id" id="edit_activity_plan_cabang_id">
          <div class="mb-3">
            <label for="edit_activity_plan_cabang" class="form-label">Nama Cabang</label>
            <input type="text" name="edit_activity_plan_cabang" id="edit_activity_plan_cabang" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_activity_plan_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_activity_plan_tanggal" id="edit_activity_plan_tanggal" class="form-control">
          </div>
          <div id="edit_activity_plan_jumlah"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-activity-plan-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-activity-plan" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal activity plan delete --}}
<div class="modal fade" id="modalActivityPlanDelete" tabindex="-1" role="dialog" aria-labelledby="modalActivityPlanDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActivityPlanDeleteLabel">Delete Activity Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_id" id="delete_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-spinner-activity-plan d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-activity-plan text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal data member --}}
{{-- modal data member detail --}}
<div class="modal fade" id="modalDataMemberDetail" tabindex="-1" role="dialog" aria-labelledby="modalDataMemberDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataMemberDetailLabel">Detail Data Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_data_member_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_data_member_cabang" id="detail_data_member_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_member_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_data_member_tanggal" id="detail_data_member_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_member_nama_member" class="form-label">Nama Member</label>
          <input type="text" name="detail_data_member_nama_member" id="detail_data_member_nama_member" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_member_nomor_hp" class="form-label">Nomor HP</label>
          <input type="number" name="detail_data_member_nomor_hp" id="detail_data_member_nomor_hp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_member_alamat" class="form-label">Alamat</label>
          <input type="text" name="detail_data_member_alamat" id="detail_data_member_alamat" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal data member edit --}}
<div class="modal fade" id="modalDataMemberEdit" tabindex="-1" role="dialog" aria-labelledby="modalDataMemberEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-data-member">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDataMemberEditLabel">Edit Data Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_data_member_id" id="edit_data_member_id">
          <div class="mb-3">
            <label for="edit_data_member_cabang" class="form-label">Nama Cabang</label>
            <select name="edit_data_member_cabang_id" id="edit_data_member_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_data_member_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_data_member_tanggal" id="edit_data_member_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_member_nama_member" class="form-label">Nama Member</label>
            <input type="text" name="edit_data_member_nama_member" id="edit_data_member_nama_member" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_member_nomor_hp" class="form-label">Nomor HP</label>
            <input type="number" name="edit_data_member_nomor_hp" id="edit_data_member_nomor_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_member_alamat" class="form-label">Alamat</label>
            <input type="text" name="edit_data_member_alamat" id="edit_data_member_alamat" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-data-member-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-data-member" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal data member delete --}}
<div class="modal fade" id="modalDataMemberDelete" tabindex="-1" role="dialog" aria-labelledby="modalDataMemberDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataMemberDeleteLabel">Delete Data Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_data_member_id" id="delete_data_member_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-data-member-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-data-member text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal data instansi --}}
{{-- modal data instansi detail --}}
<div class="modal fade" id="modalDataInstansiDetail" tabindex="-1" role="dialog" aria-labelledby="modalDataInstansiDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataInstansiDetailLabel">Detail Data Instansi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_data_instansi_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_data_instansi_cabang" id="detail_data_instansi_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_instansi_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_data_instansi_tanggal" id="detail_data_instansi_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_instansi_pic" class="form-label">PIC</label>
          <input type="text" name="detail_data_instansi_pic" id="detail_data_instansi_pic" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_instansi_nama_instansi" class="form-label">Nama instansi</label>
          <input type="text" name="detail_data_instansi_nama_instansi" id="detail_data_instansi_nama_instansi" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_instansi_nomor_hp" class="form-label">Nomor HP</label>
          <input type="number" name="detail_data_instansi_nomor_hp" id="detail_data_instansi_nomor_hp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_instansi_alamat" class="form-label">Alamat</label>
          <input type="text" name="detail_data_instansi_alamat" id="detail_data_instansi_alamat" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal data instansi edit --}}
<div class="modal fade" id="modalDataInstansiEdit" tabindex="-1" role="dialog" aria-labelledby="modalDataInstansiEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-data-instansi">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDataInstansiEditLabel">Edit Data Instansi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_data_instansi_id" id="edit_data_instansi_id">
          <div class="mb-3">
            <label for="edit_data_instansi_cabang" class="form-label">Nama Cabang</label>
            <select name="edit_data_instansi_cabang_id" id="edit_data_instansi_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_data_instansi_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_data_instansi_tanggal" id="edit_data_instansi_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_instansi_pic" class="form-label">PIC</label>
            <input type="text" name="edit_data_instansi_pic" id="edit_data_instansi_pic" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_instansi_nama_instansi" class="form-label">Nama Instansi</label>
            <input type="text" name="edit_data_instansi_nama_instansi" id="edit_data_instansi_nama_instansi" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_instansi_nomor_hp" class="form-label">Nomor HP</label>
            <input type="number" name="edit_data_instansi_nomor_hp" id="edit_data_instansi_nomor_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_instansi_alamat" class="form-label">Alamat</label>
            <input type="text" name="edit_data_instansi_alamat" id="edit_data_instansi_alamat" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-data-instansi-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-data-instansi" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal data instansi delete --}}
<div class="modal fade" id="modalDataInstansiDelete" tabindex="-1" role="dialog" aria-labelledby="modalDataInstansiDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataInstansiDeleteLabel">Delete Data Instansi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_data_instansi_id" id="delete_data_instansi_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-data-instansi-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-data-instansi text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal instansi --}}
{{-- modal instansi detail --}}
<div class="modal fade" id="modalInstansiDetail" tabindex="-1" role="dialog" aria-labelledby="modalInstansiDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInstansiDetailLabel">Detail Instansi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_instansi_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_instansi_cabang" id="detail_instansi_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_instansi_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_instansi_tanggal" id="detail_instansi_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_instansi_instansi" class="form-label">Nama Instansi</label>
          <input type="text" name="detail_instansi_instansi" id="detail_instansi_instansi" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="">Foto</label>
          {{-- dev --}}
          <img id="detail_instansi_foto_preview" src="" alt="instansi_image" style="max-width: 100%;">
          {{-- prod --}}
          {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="instansi_image" style="max-width: 100%;"> --}}
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal instansi edit --}}
<div class="modal fade" id="modalInstansiEdit" tabindex="-1" role="dialog" aria-labelledby="modalInstansiEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-instansi">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInstansiEditLabel">Edit Instansi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_instansi_id" id="edit_instansi_id">
          <div class="mb-3">
            <label for="edit_instansi_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_instansi_cabang_id" id="edit_instansi_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_instansi_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_instansi_tanggal" id="edit_instansi_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_instansi_instansi_id" class="form-label">Nama Instansi</label>
            <select name="edit_instansi_instansi_id" id="edit_instansi_instansi_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_instansi_foto_preview">Foto Preview</label>
            {{-- dev --}}
            <img id="edit_instansi_foto_preview" src="" alt="instansi_image" style="max-width: 100%;">
            {{-- prod --}}
            {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="instansi_image" style="max-width: 100%;"> --}}
          </div>
          <div class="mb-3">
            <label for="edit_instansi_foto" class="form-label">Ganti Foto</label>
            <input type="file" name="edit_instansi_foto" id="edit_instansi_foto" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-instansi-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-instansi" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal instansi delete --}}
<div class="modal fade" id="modalInstansiDelete" tabindex="-1" role="dialog" aria-labelledby="modalInstansiDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInstansiDeleteLabel">Delete Instansi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_instansi_id" id="delete_instansi_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-instansi-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-instansi text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal data reseller --}}
{{-- modal data reseller detail --}}
<div class="modal fade" id="modalDataResellerDetail" tabindex="-1" role="dialog" aria-labelledby="modalDataResellerDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataResellerDetailLabel">Detail Data Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_data_reseller_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_data_reseller_cabang" id="detail_data_reseller_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_reseller_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_data_reseller_tanggal" id="detail_data_reseller_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_reseller_nama_reseller" class="form-label">Nama Reseller</label>
          <input type="text" name="detail_data_reseller_nama_reseller" id="detail_data_reseller_nama_reseller" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_reseller_nama_usaha" class="form-label">Nama Usaha</label>
          <input type="text" name="detail_data_reseller_nama_usaha" id="detail_data_reseller_nama_usaha" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_reseller_nomor_hp" class="form-label">Nomor HP</label>
          <input type="number" name="detail_data_reseller_nomor_hp" id="detail_data_reseller_nomor_hp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_data_reseller_alamat" class="form-label">Alamat</label>
          <input type="text" name="detail_data_reseller_alamat" id="detail_data_reseller_alamat" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal data reseller edit --}}
<div class="modal fade" id="modalDataResellerEdit" tabindex="-1" role="dialog" aria-labelledby="modalDataResellerEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-data-reseller">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDataResellerEditLabel">Edit Data Reseller</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_data_reseller_id" id="edit_data_reseller_id">
          <div class="mb-3">
            <label for="edit_data_reseller_cabang" class="form-label">Nama Cabang</label>
            <select name="edit_data_reseller_cabang_id" id="edit_data_reseller_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_data_reseller_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_data_reseller_tanggal" id="edit_data_reseller_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_reseller_nama_reseller" class="form-label">Nama Reseller</label>
            <input type="text" name="edit_data_reseller_nama_reseller" id="edit_data_reseller_nama_reseller" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_reseller_nama_usaha" class="form-label">Nama Usaha</label>
            <input type="text" name="edit_data_reseller_nama_usaha" id="edit_data_reseller_nama_usaha" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_reseller_nomor_hp" class="form-label">Nomor HP</label>
            <input type="number" name="edit_data_reseller_nomor_hp" id="edit_data_reseller_nomor_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_data_reseller_alamat" class="form-label">Alamat</label>
            <input type="text" name="edit_data_reseller_alamat" id="edit_data_reseller_alamat" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-data-reseller-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-data-reseller" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal data reseller delete --}}
<div class="modal fade" id="modalDataResellerDelete" tabindex="-1" role="dialog" aria-labelledby="modalDataResellerDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDataResellerDeleteLabel">Delete Data Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_data_reseller_id" id="delete_data_reseller_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-data-reseller-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-data-reseller text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal reseller --}}
{{-- modal reseller detail --}}
<div class="modal fade" id="modalResellerDetail" tabindex="-1" role="dialog" aria-labelledby="modalResellerDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalResellerDetailLabel">Detail Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_reseller_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_reseller_cabang" id="detail_reseller_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reseller_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_reseller_tanggal" id="detail_reseller_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reseller_hasil_kunjungan" class="form-label">Hasil Kunjungan</label>
          <input type="text" name="detail_reseller_hasil_kunjungan" id="detail_reseller_hasil_kunjungan" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reseller_reseller" class="form-label">Nama reseller</label>
          <input type="text" name="detail_reseller_reseller" id="detail_reseller_reseller" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="">Foto</label>
          {{-- dev --}}
          <img id="detail_reseller_foto_preview" src="" alt="reseller_image" style="max-width: 100%;">
          {{-- prod --}}
          {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="reseller_image" style="max-width: 100%;"> --}}
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal reseller edit --}}
<div class="modal fade" id="modalResellerEdit" tabindex="-1" role="dialog" aria-labelledby="modalResellerEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-reseller">
        <div class="modal-header">
          <h5 class="modal-title" id="modalResellerEditLabel">Edit Reseller</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_reseller_id" id="edit_reseller_id">
          <div class="mb-3">
            <label for="edit_reseller_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_reseller_cabang_id" id="edit_reseller_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_reseller_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_reseller_tanggal" id="edit_reseller_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reseller_hasil_kunjungan" class="form-label">Hasil Kunjungan</label>
            <input type="text" name="edit_reseller_hasil_kunjungan" id="edit_reseller_hasil_kunjungan" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reseller_reseller_id" class="form-label">Nama Reseller</label>
            <select name="edit_reseller_reseller_id" id="edit_reseller_reseller_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_reseller_foto_preview">Foto Preview</label>
            {{-- dev --}}
            <img id="edit_reseller_foto_preview" src="" alt="reseller_image" style="max-width: 100%;">
            {{-- prod --}}
            {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="reseller_image" style="max-width: 100%;"> --}}
          </div>
          <div class="mb-3">
            <label for="edit_reseller_foto" class="form-label">Ganti Foto</label>
            <input type="file" name="edit_reseller_foto" id="edit_reseller_foto" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-reseller-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-reseller" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal reseller delete --}}
<div class="modal fade" id="modalResellerDelete" tabindex="-1" role="dialog" aria-labelledby="modalResellerDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalResellerDeleteLabel">Delete Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_reseller_id" id="delete_reseller_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-reseller-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-reseller text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal survey kompetitor --}}
{{-- modal survey kompetitor detail --}}
<div class="modal fade" id="modalSurveyKompetitorDetail" tabindex="-1" role="dialog" aria-labelledby="modalSurveyKompetitorDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSurveyKompetitorDetailLabel">Detail Survey Kompetitor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_survey_kompetitor_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_survey_kompetitor_cabang" id="detail_survey_kompetitor_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_survey_kompetitor_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_survey_kompetitor_tanggal" id="detail_survey_kompetitor_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_survey_kompetitor_nama_kompetitor" class="form-label">Nama Kompetitor</label>
          <input type="text" name="detail_survey_kompetitor_nama_kompetitor" id="detail_survey_kompetitor_nama_kompetitor" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_survey_kompetitor_hasil_survey" class="form-label">Hasil Survey</label>
          <input type="text" name="detail_survey_kompetitor_hasil_survey" id="detail_survey_kompetitor_hasil_survey" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_survey_kompetitor_promo_kompetitor" class="form-label">Promo Kompetitor</label>
          <input type="text" name="detail_survey_kompetitor_promo_kompetitor" id="detail_survey_kompetitor_promo_kompetitor" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="">Foto</label>
          {{-- dev --}}
          <img id="detail_survey_kompetitor_foto_preview" src="" alt="survey_kompetitor_image" style="max-width: 100%;">
          {{-- prod --}}
          {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="survey_kompetitor_image" style="max-width: 100%;"> --}}
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal survey kompetitor edit --}}
<div class="modal fade" id="modalSurveyKompetitorEdit" tabindex="-1" role="dialog" aria-labelledby="modalSurveyKompetitorEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-survey-kompetitor">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSurveyKompetitorEditLabel">Edit Survey Kompetitor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_survey_kompetitor_id" id="edit_survey_kompetitor_id">
          <div class="mb-3">
            <label for="edit_survey_kompetitor_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_survey_kompetitor_cabang_id" id="edit_survey_kompetitor_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_survey_kompetitor_tanggal" id="edit_survey_kompetitor_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_nama_kompetitor" class="form-label">Nama Kompetitor</label>
            <input type="text" name="edit_survey_kompetitor_nama_kompetitor" id="edit_survey_kompetitor_nama_kompetitor" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_hasil_survey" class="form-label">Hasil Survey</label>
            <input type="text" name="edit_survey_kompetitor_hasil_survey" id="edit_survey_kompetitor_hasil_survey" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_promo_kompetitor" class="form-label">Promo Kompetitor</label>
            <input type="text" name="edit_survey_kompetitor_promo_kompetitor" id="edit_survey_kompetitor_promo_kompetitor" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_foto_preview">Foto Preview</label>
            {{-- dev --}}
            <img id="edit_survey_kompetitor_foto_preview" src="" alt="survey_kompetitor_image" style="max-width: 100%;">
            {{-- prod --}}
            {{-- <img src="{{ asset('file/labul/1658877667.jpg') }}" alt="survey_kompetitor_image" style="max-width: 100%;"> --}}
          </div>
          <div class="mb-3">
            <label for="edit_survey_kompetitor_foto" class="form-label">Ganti Foto</label>
            <input type="file" name="edit_survey_kompetitor_foto" id="edit_survey_kompetitor_foto" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-survey-kompetitor-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-survey-kompetitor" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal survey kompetitor delete --}}
<div class="modal fade" id="modalSurveyKompetitorDelete" tabindex="-1" role="dialog" aria-labelledby="modalSurveyKompetitorDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSurveyKompetitorDeleteLabel">Delete Survey Kompetitor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_survey_kompetitor_id" id="delete_survey_kompetitor_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-survey-kompetitor-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-survey-kompetitor text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal komplain --}}
{{-- modal komplain detail --}}
<div class="modal fade" id="modalKomplainDetail" tabindex="-1" role="dialog" aria-labelledby="modalKomplainDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKomplainDetailLabel">Detail Komplain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_komplain_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_komplain_cabang" id="detail_komplain_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_komplain_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_komplain_tanggal" id="detail_komplain_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_komplain_nama_customer" class="form-label">Nama Customer</label>
          <input type="text" name="detail_komplain_nama_customer" id="detail_komplain_nama_customer" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_komplain_nomor_hp" class="form-label">Nomor HP</label>
          <input type="text" name="detail_komplain_nomor_hp" id="detail_komplain_nomor_hp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_komplain_kritik_saran" class="form-label">Kritik Saran</label>
          <input type="text" name="detail_komplain_kritik_saran" id="detail_komplain_kritik_saran" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_komplain_penanganan_awal" class="form-label">Penanganan Awal</label>
          <input type="text" name="detail_komplain_penanganan_awal" id="detail_komplain_penanganan_awal" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal komplain edit --}}
<div class="modal fade" id="modalKomplainEdit" tabindex="-1" role="dialog" aria-labelledby="modalKomplainEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-komplain">
        <div class="modal-header">
          <h5 class="modal-title" id="modalKomplainEditLabel">Edit Komplain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_komplain_id" id="edit_komplain_id">
          <div class="mb-3">
            <label for="edit_komplain_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_komplain_cabang_id" id="edit_komplain_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_komplain_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_komplain_tanggal" id="edit_komplain_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_komplain_nama_customer" class="form-label">Nama Customer</label>
            <input type="text" name="edit_komplain_nama_customer" id="edit_komplain_nama_customer" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_komplain_nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" name="edit_komplain_nomor_hp" id="edit_komplain_nomor_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_komplain_kritik_saran" class="form-label">Kritik Saran</label>
            <input type="text" name="edit_komplain_kritik_saran" id="edit_komplain_kritik_saran" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_komplain_penanganan_awal" class="form-label">Penanganan Awal</label>
            <input type="text" name="edit_komplain_penanganan_awal" id="edit_komplain_penanganan_awal" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-komplain-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-komplain" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal komplain delete --}}
<div class="modal fade" id="modalKomplainDelete" tabindex="-1" role="dialog" aria-labelledby="modalKomplainDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKomplainDeleteLabel">Delete Komplain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_komplain_id" id="delete_komplain_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-komplain-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-komplain text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal reqor --}}
{{-- modal reqor detail --}}
<div class="modal fade" id="modalReqorDetail" tabindex="-1" role="dialog" aria-labelledby="modalReqorDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReqorDetailLabel">Detail Request & Orderan Tertolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_reqor_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_reqor_cabang" id="detail_reqor_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_reqor_tanggal" id="detail_reqor_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_nama_customer" class="form-label">Nama Customer</label>
          <input type="text" name="detail_reqor_nama_customer" id="detail_reqor_nama_customer" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_nomor_hp" class="form-label">Nomor HP</label>
          <input type="text" name="detail_reqor_nomor_hp" id="detail_reqor_nomor_hp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_request_produk" class="form-label">Request Produk</label>
          <input type="text" name="detail_reqor_request_produk" id="detail_reqor_request_produk" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_produk_tertolak" class="form-label">Produk Tertolak</label>
          <input type="text" name="detail_reqor_produk_tertolak" id="detail_reqor_produk_tertolak" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_reqor_alasan" class="form-label">Alasan</label>
          <input type="text" name="detail_reqor_alasan" id="detail_reqor_alasan" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal reqor edit --}}
<div class="modal fade" id="modalReqorEdit" tabindex="-1" role="dialog" aria-labelledby="modalReqorEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-reqor">
        <div class="modal-header">
          <h5 class="modal-title" id="modalReqorEditLabel">Edit Request & Orderan Tertolak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_reqor_id" id="edit_reqor_id">
          <div class="mb-3">
            <label for="edit_reqor_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_reqor_cabang_id" id="edit_reqor_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_reqor_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_reqor_tanggal" id="edit_reqor_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reqor_nama_customer" class="form-label">Nama Customer</label>
            <input type="text" name="edit_reqor_nama_customer" id="edit_reqor_nama_customer" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reqor_nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" name="edit_reqor_nomor_hp" id="edit_reqor_nomor_hp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reqor_request_produk" class="form-label">Request Produk</label>
            <input type="text" name="edit_reqor_request_produk" id="edit_reqor_request_produk" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reqor_produk_tertolak" class="form-label">Produk Tertolak</label>
            <input type="text" name="edit_reqor_produk_tertolak" id="edit_reqor_produk_tertolak" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_reqor_alasan" class="form-label">Alasan</label>
            <input type="text" name="edit_reqor_alasan" id="edit_reqor_alasan" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-reqor-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-reqor" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal reqor delete --}}
<div class="modal fade" id="modalReqorDelete" tabindex="-1" role="dialog" aria-labelledby="modalReqorDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReqorDeleteLabel">Delete Request & Orderan Tertolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_reqor_id" id="delete_reqor_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-reqor-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-reqor text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

{{-- modal omzet --}}
{{-- modal omzet detail --}}
<div class="modal fade" id="modalOmzetDetail" tabindex="-1" role="dialog" aria-labelledby="modalOmzetDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalOmzetDetailLabel">Detail Omzet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="detail_omzet_cabang" class="form-label">Nama Cabang</label>
          <input type="text" name="detail_omzet_cabang" id="detail_omzet_cabang" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_tanggal" class="form-label">Tanggal</label>
          <input type="datetime-local" name="detail_omzet_tanggal" id="detail_omzet_tanggal" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_transaksi" class="form-label">Transaksi</label>
          <input type="text" name="detail_omzet_transaksi" id="detail_omzet_transaksi" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_traffic_online" class="form-label">Traffic Online</label>
          <input type="text" name="detail_omzet_traffic_online" id="detail_omzet_traffic_online" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_traffic_offline" class="form-label">Traffic Offline</label>
          <input type="text" name="detail_omzet_traffic_offline" id="detail_omzet_traffic_offline" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_retail" class="form-label">Retail</label>
          <input type="text" name="detail_omzet_retail" id="detail_omzet_retail" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_instansi" class="form-label">Instansi</label>
          <input type="text" name="detail_omzet_instansi" id="detail_omzet_instansi" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_reseller" class="form-label">Reseller</label>
          <input type="text" name="detail_omzet_reseller" id="detail_omzet_reseller" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_cabang_rp" class="form-label">Cabang</label>
          <input type="text" name="detail_omzet_cabang_rp" id="detail_omzet_cabang_rp" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_omzet_harian" class="form-label">Omzet Harian</label>
          <input type="text" name="detail_omzet_omzet_harian" id="detail_omzet_omzet_harian" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_omzet_terbayar" class="form-label">Omzet Terbayar</label>
          <input type="text" name="detail_omzet_omzet_terbayar" id="detail_omzet_omzet_terbayar" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_leads" class="form-label">Leads</label>
          <input type="text" name="detail_omzet_leads" id="detail_omzet_leads" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_konsumen_bertanya" class="form-label">Konsumen Bertanya</label>
          <input type="text" name="detail_omzet_konsumen_bertanya" id="detail_omzet_konsumen_bertanya" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_cetak_banner_harian" class="form-label">Cetak Banner Harian</label>
          <input type="text" name="detail_omzet_cetak_banner_harian" id="detail_omzet_cetak_banner_harian" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_cetak_a3_harian" class="form-label">Cetak A3 Harian</label>
          <input type="text" name="detail_omzet_cetak_a3_harian" id="detail_omzet_cetak_a3_harian" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_print_outdoor" class="form-label">Print Outdoor</label>
          <input type="text" name="detail_omzet_print_outdoor" id="detail_omzet_print_outdoor" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_print_indoor" class="form-label">Print Indoor</label>
          <input type="text" name="detail_omzet_print_indoor" id="detail_omzet_print_indoor" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_offset" class="form-label">Offset</label>
          <input type="text" name="detail_omzet_offset" id="detail_omzet_offset" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_merchandise" class="form-label">Merchandise</label>
          <input type="text" name="detail_omzet_merchandise" id="detail_omzet_merchandise" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_akrilik" class="form-label">Akrilik</label>
          <input type="text" name="detail_omzet_akrilik" id="detail_omzet_akrilik" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_design" class="form-label">Design</label>
          <input type="text" name="detail_omzet_design" id="detail_omzet_design" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_laminasi_dingin" class="form-label">Laminasi Dingin</label>
          <input type="text" name="detail_omzet_laminasi_dingin" id="detail_omzet_laminasi_dingin" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_laminasi_a3" class="form-label">Laminasi A3</label>
          <input type="text" name="detail_omzet_laminasi_a3" id="detail_omzet_laminasi_a3" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_fotocopy" class="form-label">Fotocopy</label>
          <input type="text" name="detail_omzet_fotocopy" id="detail_omzet_fotocopy" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_dtf" class="form-label">DTF</label>
          <input type="text" name="detail_omzet_dtf" id="detail_omzet_dtf" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_uv" class="form-label">UV</label>
          <input type="text" name="detail_omzet_uv" id="detail_omzet_uv" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_advertising_produk" class="form-label">Advertising Produk</label>
          <input type="text" name="detail_omzet_advertising_produk" id="detail_omzet_advertising_produk" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_advertising_jasa" class="form-label">Advertising Jasa</label>
          <input type="text" name="detail_omzet_advertising_jasa" id="detail_omzet_advertising_jasa" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_cash_harian" class="form-label">Cash Harian</label>
          <input type="text" name="detail_omzet_cash_harian" id="detail_omzet_cash_harian" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_piutang_bulan_berjalan" class="form-label">Piutang Bulan Berjalan</label>
          <input type="text" name="detail_omzet_piutang_bulan_berjalan" id="detail_omzet_piutang_bulan_berjalan" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_piutang_terbayar" class="form-label">Piutang Terbayar</label>
          <input type="text" name="detail_omzet_piutang_terbayar" id="detail_omzet_piutang_terbayar" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_karyawan_sales_id" class="form-label">Sales</label>
          <input type="text" name="detail_omzet_karyawan_sales_id" id="detail_omzet_karyawan_sales_id" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_pencapaian_omzet_sales" class="form-label">Pencapaian Omzet Sales</label>
          <input type="text" name="detail_omzet_pencapaian_omzet_sales" id="detail_omzet_pencapaian_omzet_sales" class="form-control" disabled>
        </div>
        <div class="mb-3">
          <label for="detail_omzet_pencapaian_cash_sales" class="form-label">Pencapaian Cash Sales</label>
          <input type="text" name="detail_omzet_pencapaian_cash_sales" id="detail_omzet_pencapaian_cash_sales" class="form-control" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- modal omzet edit --}}
<div class="modal fade" id="modalOmzetEdit" tabindex="-1" role="dialog" aria-labelledby="modalOmzetEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-edit-omzet">
        <div class="modal-header">
          <h5 class="modal-title" id="modalOmzetEditLabel">Edit Omzet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_omzet_id" id="edit_omzet_id">
          <div class="mb-3">
            <label for="edit_omzet_cabang_id" class="form-label">Nama Cabang</label>
            <select name="edit_omzet_cabang_id" id="edit_omzet_cabang_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_omzet_tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" name="edit_omzet_tanggal" id="edit_omzet_tanggal" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_transaksi" class="form-label">Transaksi</label>
            <input type="text" name="edit_omzet_transaksi" id="edit_omzet_transaksi" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_traffic_online" class="form-label">Traffic Online</label>
            <input type="text" name="edit_omzet_traffic_online" id="edit_omzet_traffic_online" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_traffic_offline" class="form-label">Traffic Offline</label>
            <input type="text" name="edit_omzet_traffic_offline" id="edit_omzet_traffic_offline" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_retail" class="form-label">Retail</label>
            <input type="text" name="edit_omzet_retail" id="edit_omzet_retail" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_instansi" class="form-label">Instansi</label>
            <input type="text" name="edit_omzet_instansi" id="edit_omzet_instansi" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_reseller" class="form-label">Reseller</label>
            <input type="text" name="edit_omzet_reseller" id="edit_omzet_reseller" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_cabang_rp" class="form-label">Cabang</label>
            <input type="text" name="edit_omzet_cabang_rp" id="edit_omzet_cabang_rp" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_omzet_harian" class="form-label">Omzet Harian</label>
            <input type="text" name="edit_omzet_omzet_harian" id="edit_omzet_omzet_harian" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_omzet_terbayar" class="form-label">Omzet Terbayar</label>
            <input type="text" name="edit_omzet_omzet_terbayar" id="edit_omzet_omzet_terbayar" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_leads" class="form-label">Leads</label>
            <input type="text" name="edit_omzet_leads" id="edit_omzet_leads" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_konsumen_bertanya" class="form-label">Konsumen Bertanya</label>
            <input type="text" name="edit_omzet_konsumen_bertanya" id="edit_omzet_konsumen_bertanya" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_cetak_banner_harian" class="form-label">Cetak Banner Harian</label>
            <input type="text" name="edit_omzet_cetak_banner_harian" id="edit_omzet_cetak_banner_harian" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_cetak_a3_harian" class="form-label">Cetak A3 Harian</label>
            <input type="text" name="edit_omzet_cetak_a3_harian" id="edit_omzet_cetak_a3_harian" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_print_outdoor" class="form-label">Print Outdoor</label>
            <input type="text" name="edit_omzet_print_outdoor" id="edit_omzet_print_outdoor" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_print_indoor" class="form-label">Print Indoor</label>
            <input type="text" name="edit_omzet_print_indoor" id="edit_omzet_print_indoor" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_offset" class="form-label">Offset</label>
            <input type="text" name="edit_omzet_offset" id="edit_omzet_offset" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_merchandise" class="form-label">Merchandise</label>
            <input type="text" name="edit_omzet_merchandise" id="edit_omzet_merchandise" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_akrilik" class="form-label">Akrilik</label>
            <input type="text" name="edit_omzet_akrilik" id="edit_omzet_akrilik" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_design" class="form-label">Design</label>
            <input type="text" name="edit_omzet_design" id="edit_omzet_design" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_laminasi_dingin" class="form-label">Laminasi Dingin</label>
            <input type="text" name="edit_omzet_laminasi_dingin" id="edit_omzet_laminasi_dingin" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_laminasi_a3" class="form-label">Laminasi A3</label>
            <input type="text" name="edit_omzet_laminasi_a3" id="edit_omzet_laminasi_a3" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_fotocopy" class="form-label">Fotocopy</label>
            <input type="text" name="edit_omzet_fotocopy" id="edit_omzet_fotocopy" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_dtf" class="form-label">DTF</label>
            <input type="text" name="edit_omzet_dtf" id="edit_omzet_dtf" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_uv" class="form-label">UV</label>
            <input type="text" name="edit_omzet_uv" id="edit_omzet_uv" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_advertising_produk" class="form-label">Advertising Produk</label>
            <input type="text" name="edit_omzet_advertising_produk" id="edit_omzet_advertising_produk" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_advertising_jasa" class="form-label">Advertising Jasa</label>
            <input type="text" name="edit_omzet_advertising_jasa" id="edit_omzet_advertising_jasa" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_cash_harian" class="form-label">Cash Harian</label>
            <input type="text" name="edit_omzet_cash_harian" id="edit_omzet_cash_harian" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_piutang_bulan_berjalan" class="form-label">Piutang Bulan Berjalan</label>
            <input type="text" name="edit_omzet_piutang_bulan_berjalan" id="edit_omzet_piutang_bulan_berjalan" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_piutang_terbayar" class="form-label">Piutang Terbayar</label>
            <input type="text" name="edit_omzet_piutang_terbayar" id="edit_omzet_piutang_terbayar" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_karyawan_sales_id" class="form-label">Sales</label>
            <select name="edit_omzet_karyawan_sales_id" id="edit_omzet_karyawan_sales_id" class="form-control"></select>
          </div>
          <div class="mb-3">
            <label for="edit_omzet_pencapaian_omzet_sales" class="form-label">Pencapaian Omzet Sales</label>
            <input type="text" name="edit_omzet_pencapaian_omzet_sales" id="edit_omzet_pencapaian_omzet_sales" class="form-control">
          </div>
          <div class="mb-3">
            <label for="edit_omzet_pencapaian_cash_sales" class="form-label">Pencapaian Cash Sales</label>
            <input type="text" name="edit_omzet_pencapaian_cash_sales" id="edit_omzet_pencapaian_cash_sales" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary modal-tombol-edit-omzet-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="button" class="btn btn-primary modal-tombol-edit-omzet" style="width: 130px;">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal omzet delete --}}
<div class="modal fade" id="modalOmzetDelete" tabindex="-1" role="dialog" aria-labelledby="modalOmzetDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalOmzetDeleteLabel">Delete Request & Orderan Tertolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin anda akan menghapus?</p>
        <input type="hidden" name="delete_omzet_id" id="delete_omzet_id">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary modal-tombol-delete-omzet-spinner d-none" disabled style="width: 130px;">
          <span class="spinner-grow spinner-grow-sm"></span>
          Loading...
        </button>
        <button type="button" class="btn btn-primary modal-tombol-delete-omzet text-center" style="width: 130px;">Ya</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(document).ready(function () {
    let Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    })

    $("#activity_plan_tabel").DataTable();
    $("#data_member_tabel").DataTable();
    $("#reseller_tabel").DataTable();
    $("#data_reseller_tabel").DataTable();
    $("#instansi_tabel").DataTable();
    $("#survey_kompetitor_tabel").DataTable();
    $("#komplain_tabel").DataTable();
    $("#data_instansi_tabel").DataTable();
    $("#reqor_tabel").DataTable();
    $("#omzet_cabang_tabel").DataTable();

    // activity plan detail
    $(document).on('click', '.btn-detail-activity-plan', function () {
      $('#detail_activity_plan_jumlah').empty();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.activity_plan.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#detail_activity_plan_cabang_id').val(response.activity_plan.cabang.nama_cabang);
          $('#detail_activity_plan_tanggal').val(response.activity_plan.tanggal);

          let data_jumlah = '';
          $.each(response.activity_plan_jumlah, function (index, item) {
            data_jumlah += '' +
            '<div class="mb-3">' +
              '<label for="detail_activity_plan_jumlah_rencana_kunjungan" class="form-label">' + item.nama + '</label>' +
              '<input type="number" id="detail_activity_plan_jumlah_rencana_kunjungan" class="form-control" value="' + item.jumlah + '" disabled>' +
            '</div>';
            $.each(response.activity_plan_rencana, function (index_rencana, item_rencana) {
              if (item_rencana.activity_plan_jumlah_id == item.id) {
                data_jumlah += '<div class="mb-3">' +
                  '<label for="activity_plan_rencana_kunjungan" class="form-label text-success">' + item.nama.replace("Jumlah ", "") + '</label>' +
                  '<input type="text" name="activity_plan_rencana_kunjungan[]" id="activity_plan_rencana_kunjungan" class="form-control" value="' + item_rencana.nama + '" disabled>' +
                '</div>';                    
              }
            })
          })
          $('#detail_activity_plan_jumlah').append(data_jumlah);
          $('#modalActivityPlanDetail').modal('show');
        }
      })
    })
    // activity plan edit
    $(document).on('click', '.btn-edit-activity-plan', function () {
      $('#edit_activity_plan_jumlah').empty();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.activity_plan.edit', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#edit_activity_plan_id').val(response.activity_plan.id);
          $('#edit_activity_plan_cabang_id').val(response.activity_plan.cabang_id);
          $('#edit_activity_plan_cabang').val(response.activity_plan.cabang.nama_cabang);
          $('#edit_activity_plan_tanggal').val(response.activity_plan.tanggal);

          let data_jumlah = '';
          $.each(response.activity_plan_jumlah, function (index, item) {
            data_jumlah += '' +
            '<div class="mb-3">' +
              '<label for="edit_activity_plan_' + item.nama.toLowerCase().replace(/ /g, "_") + '" class="form-label">' + item.nama + '</label>' +
              '<input type="number" name="edit_activity_plan_' + item.nama.toLowerCase().replace(/ /g, "_") + '" id="edit_activity_plan_' + item.nama.toLowerCase().replace(/ /g, "_") + '" class="form-control" value="' + item.jumlah + '">' +
              '<div class="spinner-border spinner-border-sm mt-2 edit_activity_plan_' + item.nama.toLowerCase().replace(/ /g, "_") + '_spinner d-none" role="status">' +
                '<span class="sr-only">Loading...</span>' +
              '</div>' +
            '</div>';

            data_jumlah += '<div id="list_activity_plan_' + item.nama.toLowerCase().replace(/ /g, "_") + '">';
              $.each(response.activity_plan_rencana, function (index_rencana, item_rencana) {
                if (item_rencana.activity_plan_jumlah_id == item.id) {
                    data_jumlah += '' +
                        '<div class="mb-3">' +
                        '<label for="edit_activity_plan_rencana_kunjungan" class="form-label text-success">' + item.nama.replace("Jumlah ", "") + '</label>' +
                        '<input type="text" name="edit_activity_plan_' + item.nama.replace("Jumlah ", "").replace(" ", "_").toLowerCase() + '[]" id="edit_activity_plan_' + item.nama.replace("Jumlah ", "").replace(" ", "_").toLowerCase() + '" class="form-control" value="' + item_rencana.nama + '">' +
                      '</div>';
                  }
              })
            data_jumlah += '</div>';              
          })
          $('#edit_activity_plan_jumlah').append(data_jumlah);
          $('#modalActivityPlanEdit').modal('show');
        }
      })
    })
    let keyupTimer;
    $(document).on('keyup', '#edit_activity_plan_jumlah_rencana_kunjungan', function () {
      $(".edit_activity_plan_jumlah_rencana_kunjungan_spinner").removeClass('d-none');
      $('#list_activity_plan_jumlah_rencana_kunjungan').empty();
      let val_rencana_kunjungan = $('#edit_activity_plan_jumlah_rencana_kunjungan').val();
      clearTimeout(keyupTimer);

      if (val_rencana_kunjungan != "") {
        keyupTimer = setTimeout(function () {
          $(".edit_activity_plan_jumlah_rencana_kunjungan_spinner").addClass('d-none');

          let val_list_activity_plan_jumlah_rencana_kunjungan = "";
          for (let index = 1; index <= val_rencana_kunjungan; index++) {
            val_list_activity_plan_jumlah_rencana_kunjungan += '' +
              '<div class="mb-3">' +
                '<label for="edit_activity_plan_rencana_kunjungan" class="form-label text-success">Rencana Kunjungan ' + index + '</label>' +
                '<input type="text" name="edit_activity_plan_rencana_kunjungan[]" id="edit_activity_plan_rencana_kunjungan" class="form-control">' +
              '</div>';
          }
          $('#list_activity_plan_jumlah_rencana_kunjungan').append(val_list_activity_plan_jumlah_rencana_kunjungan);
        }, 1000);
      } else {
        $(".edit_activity_plan_jumlah_rencana_kunjungan_spinner").addClass('d-none');
      }
    })
    $(document).on('keyup', '#edit_activity_plan_jumlah_rencana_salescall', function () {
      $(".edit_activity_plan_jumlah_rencana_salescall_spinner").removeClass('d-none');
      $('#list_activity_plan_jumlah_rencana_salescall').empty();
      let val_rencana_salescall = $('#edit_activity_plan_jumlah_rencana_salescall').val();
      clearTimeout(keyupTimer);

      if (val_rencana_salescall != "") {
          keyupTimer = setTimeout(function () {
              $(".edit_activity_plan_jumlah_rencana_salescall_spinner").addClass('d-none');

              let val_list_activity_plan_rencana_salescall = "";
              for (let index = 1; index <= val_rencana_salescall; index++) {
                  val_list_activity_plan_rencana_salescall += '' +
                      '<div class="mb-3">' +
                          '<label for="activity_plan_rencana_salescall" class="form-label text-success">Rencana Salescall ' + index + '</label>' +
                          '<input type="text" name="activity_plan_rencana_salescall[]" id="activity_plan_rencana_salescall" class="form-control">' +
                      '</div>';
              }
              $('#list_activity_plan_jumlah_rencana_salescall').append(val_list_activity_plan_rencana_salescall);
          }, 1000);
      } else {
          $(".edit_activity_plan_jumlah_rencana_salescall_spinner").addClass('d-none');
      }
    })
    $(document).on('keyup', '#edit_activity_plan_jumlah_rencana_sebar_brosur', function () {
        $(".edit_activity_plan_jumlah_rencana_sebar_brosur_spinner").removeClass('d-none');
        $('#list_activity_plan_jumlah_rencana_sebar_brosur').empty();
        let val_rencana_sebar_brosur = $('#edit_activity_plan_jumlah_rencana_sebar_brosur').val();
        clearTimeout(keyupTimer);

        if (val_rencana_sebar_brosur != "") {
            keyupTimer = setTimeout(function () {
                $(".edit_activity_plan_jumlah_rencana_sebar_brosur_spinner").addClass('d-none');

                let val_list_activity_plan_rencana_sebar_brosur = "";
                for (let index = 1; index <= val_rencana_sebar_brosur; index++) {
                    val_list_activity_plan_rencana_sebar_brosur += '' +
                        '<div class="mb-3">' +
                            '<label for="activity_plan_rencana_sebar_brosur" class="form-label text-success">Rencana Sebar Brosur ' + index + '</label>' +
                            '<input type="text" name="activity_plan_rencana_sebar_brosur[]" id="activity_plan_rencana_sebar_brosur" class="form-control">' +
                        '</div>';
                }
                $('#list_activity_plan_jumlah_rencana_sebar_brosur').append(val_list_activity_plan_rencana_sebar_brosur);
            }, 1000);
        } else {
            $(".edit_activity_plan_jumlah_rencana_sebar_brosur_spinner").addClass('d-none');
        }
    })
    $(document).on('keyup', '#edit_activity_plan_jumlah_rencana_penawaran', function () {
        $(".edit_activity_plan_jumlah_rencana_penawaran_spinner").removeClass('d-none');
        $('#list_activity_plan_jumlah_rencana_penawaran').empty();
        let val_rencana_penawaran = $('#edit_activity_plan_jumlah_rencana_penawaran').val();
        clearTimeout(keyupTimer);

        if (val_rencana_penawaran != "") {
            keyupTimer = setTimeout(function () {
                $(".edit_activity_plan_jumlah_rencana_penawaran_spinner").addClass('d-none');

                let val_list_activity_plan_rencana_penawaran = "";
                for (let index = 1; index <= val_rencana_penawaran; index++) {
                    val_list_activity_plan_rencana_penawaran += '' +
                        '<div class="mb-3">' +
                            '<label for="activity_plan_rencana_penawaran" class="form-label text-success">Rencana Penawaran ' + index + '</label>' +
                            '<input type="text" name="activity_plan_rencana_penawaran[]" id="activity_plan_rencana_penawaran" class="form-control">' +
                        '</div>';
                }
                $('#list_activity_plan_jumlah_rencana_penawaran').append(val_list_activity_plan_rencana_penawaran);
            }, 1000);
        } else {
            $(".edit_activity_plan_jumlah_rencana_penawaran_spinner").addClass('d-none');
        }
    })
    $(document).on('keyup', '#edit_activity_plan_jumlah_penawaran_merchant', function () {
        $(".edit_activity_plan_jumlah_penawaran_merchant_spinner").removeClass('d-none');
        $('#list_activity_plan_jumlah_penawaran_merchant').empty();
        let val_penawaran_merchant = $('#edit_activity_plan_jumlah_penawaran_merchant').val();
        clearTimeout(keyupTimer);

        if (val_penawaran_merchant != "") {
            keyupTimer = setTimeout(function () {
                $(".edit_activity_plan_jumlah_penawaran_merchant_spinner").addClass('d-none');

                let val_list_activity_plan_penawaran_merchant = "";
                for (let index = 1; index <= val_penawaran_merchant; index++) {
                    val_list_activity_plan_penawaran_merchant += '' +
                        '<div class="mb-3">' +
                            '<label for="activity_plan_penawaran_merchant" class="form-label text-success">Rencana Penawaran Merchant ' + index + '</label>' +
                            '<input type="text" name="activity_plan_penawaran_merchant[]" id="activity_plan_penawaran_merchant" class="form-control">' +
                        '</div>';
                }
                $('#list_activity_plan_jumlah_penawaran_merchant').append(val_list_activity_plan_penawaran_merchant);
            }, 1000);
        } else {
            $(".edit_activity_plan_jumlah_penawaran_merchant_spinner").addClass('d-none');
        }
    })
    $(document).on('click', '.modal-tombol-edit-activity-plan', function () {
      let formData = new FormData($('#form-edit-activity-plan')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.activity_plan.update', [':id']) }}";
      url = url.replace(':id', $('#edit_activity_plan_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-activity-plan-spinner').removeClass('d-none');
          $('.modal-tombol-edit-activity-plan').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // activity plan delete
    $(document).on('click', '.btn-delete-activity-plan', function () {
      var id = $(this).attr('data-id');
      $('#delete_id').val(id);
      $('#modalActivityPlanDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-activity-plan', function () {
      let formData = {
        id: $('#delete_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.activity_plan.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-spinner-activity-plan').removeClass('d-none');
          $('.modal-tombol-delete-activity-plan').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // data member detail
    $(document).on('click', '.btn-detail-data-member', function () {
      $('#detail_data_member_jumlah').empty();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_member.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          console.log(response);
          $('#detail_data_member_cabang').val(response.data_member.cabang.nama_cabang);
          $('#detail_data_member_tanggal').val(response.data_member.tanggal);
          $('#detail_data_member_nama_member').val(response.data_member.nama_member);
          $('#detail_data_member_nomor_hp').val(response.data_member.nomor_hp);
          $('#detail_data_member_alamat').val(response.data_member.alamat);
          
          $('#modalDataMemberDetail').modal('show');
        }
      })
    })
    // data member edit
    $(document).on('click', '.btn-edit-data-member', function () {
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_member.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#edit_data_member_id').val(response.data_member.id);
          $('#edit_data_member_nama_member').val(response.data_member.nama_member);
          $('#edit_data_member_tanggal').val(response.data_member.tanggal);
          $('#edit_data_member_nomor_hp').val(response.data_member.nomor_hp);
          $('#edit_data_member_alamat').val(response.data_member.alamat);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.data_member.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>'
          }) 
          $('#edit_data_member_cabang_id').append(data_cabang);
          
          $('#modalDataMemberEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-data-member', function () {
      let formData = new FormData($('#form-edit-data-member')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.data_member.update', [':id']) }}";
      url = url.replace(':id', $('#edit_data_member_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-data-member-spinner').removeClass('d-none');
          $('.modal-tombol-edit-data-member').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // data member delete
    $(document).on('click', '.btn-delete-data-member', function () {
      var id = $(this).attr('data-id');
      $('#delete_data_member_id').val(id);
      $('#modalDataMemberDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-data-member', function () {
      let formData = {
        id: $('#delete_data_member_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.data_member.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-data-member-spinner').removeClass('d-none');
          $('.modal-tombol-delete-data-member').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // data instansi detail
    $(document).on('click', '.btn-detail-data-instansi', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_instansi.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          console.log(response);
          $('#detail_data_instansi_cabang').val(response.data_instansi.cabang.nama_cabang);
          $('#detail_data_instansi_tanggal').val(response.data_instansi.tanggal);
          $('#detail_data_instansi_nama_instansi').val(response.data_instansi.nama_instansi);
          $('#detail_data_instansi_pic').val(response.data_instansi.pic);
          $('#detail_data_instansi_nomor_hp').val(response.data_instansi.nomor_hp);
          $('#detail_data_instansi_alamat').val(response.data_instansi.alamat);
          
          $('#modalDataInstansiDetail').modal('show');
        }
      })
    })
    // data instansi edit
    $(document).on('click', '.btn-edit-data-instansi', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_instansi.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#edit_data_instansi_id').val(response.data_instansi.id);
          $('#edit_data_instansi_nama_instansi').val(response.data_instansi.nama_instansi);
          $('#edit_data_instansi_tanggal').val(response.data_instansi.tanggal);
          $('#edit_data_instansi_pic').val(response.data_instansi.pic);
          $('#edit_data_instansi_nomor_hp').val(response.data_instansi.nomor_hp);
          $('#edit_data_instansi_alamat').val(response.data_instansi.alamat);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.data_instansi.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>'
          }) 
          $('#edit_data_instansi_cabang_id').append(data_cabang);
          
          $('#modalDataInstansiEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-data-instansi', function () {
      let formData = new FormData($('#form-edit-data-instansi')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.data_instansi.update', [':id']) }}";
      url = url.replace(':id', $('#edit_data_instansi_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-data-instansi-spinner').removeClass('d-none');
          $('.modal-tombol-edit-data-instansi').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // data instansi delete
    $(document).on('click', '.btn-delete-data-instansi', function () {
      var id = $(this).attr('data-id');
      $('#delete_data_instansi_id').val(id);
      $('#modalDataInstansiDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-data-instansi', function () {
      let formData = {
        id: $('#delete_data_instansi_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.data_instansi.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-data-instansi-spinner').removeClass('d-none');
          $('.modal-tombol-delete-data-instansi').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // instansi detail
    $(document).on('click', '.btn-detail-instansi', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.instansi.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.instansi.foto;
          $('#detail_instansi_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          $('#detail_instansi_cabang').val(response.instansi.cabang.nama_cabang);
          $('#detail_instansi_tanggal').val(response.instansi.tanggal);
          $('#detail_instansi_instansi').val(response.instansi.data_instansi.nama_instansi);
          
          $('#modalInstansiDetail').modal('show');
        }
      })
    })
    // instansi edit
    $(document).on('click', '.btn-edit-instansi', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.instansi.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.instansi.foto;
          
          $('#edit_instansi_id').val(response.instansi.id);
          $('#edit_instansi_tanggal').val(response.instansi.tanggal);
          $('#edit_instansi_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.instansi.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_instansi_cabang_id').append(data_cabang);

          let data_instansi = '';
          $.each(response.data_instansis, function (index, item) {
            data_instansi += '<option value="' + item.id + '">' + item.nama_instansi + '</option>';
          })
          $('#edit_instansi_instansi_id').append(data_instansi);

          $('#modalInstansiEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-instansi', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-instansi')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.instansi.update', [':id']) }}";
      url = url.replace(':id', $('#edit_instansi_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-instansi-spinner').removeClass('d-none');
          $('.modal-tombol-edit-instansi').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // instansi delete
    $(document).on('click', '.btn-delete-instansi', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_instansi_id').val(id);
      $('#modalInstansiDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-instansi', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_instansi_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.instansi.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-instansi-spinner').removeClass('d-none');
          $('.modal-tombol-delete-instansi').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // data reseller detail
    $(document).on('click', '.btn-detail-data-reseller', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_reseller.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          console.log(response);
          $('#detail_data_reseller_cabang').val(response.data_reseller.cabang.nama_cabang);
          $('#detail_data_reseller_tanggal').val(response.data_reseller.tanggal);
          $('#detail_data_reseller_nama_reseller').val(response.data_reseller.nama_reseller);
          $('#detail_data_reseller_nama_usaha').val(response.data_reseller.nama_usaha);
          $('#detail_data_reseller_nomor_hp').val(response.data_reseller.nomor_hp);
          $('#detail_data_reseller_alamat').val(response.data_reseller.alamat);
          
          $('#modalDataResellerDetail').modal('show');
        }
      })
    })
    // data reseller edit
    $(document).on('click', '.btn-edit-data-reseller', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.data_reseller.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#edit_data_reseller_id').val(response.data_reseller.id);
          $('#edit_data_reseller_nama_reseller').val(response.data_reseller.nama_reseller);
          $('#edit_data_reseller_tanggal').val(response.data_reseller.tanggal);
          $('#edit_data_reseller_nama_usaha').val(response.data_reseller.nama_usaha);
          $('#edit_data_reseller_nomor_hp').val(response.data_reseller.nomor_hp);
          $('#edit_data_reseller_alamat').val(response.data_reseller.alamat);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.data_reseller.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>'
          }) 
          $('#edit_data_reseller_cabang_id').append(data_cabang);
          
          $('#modalDataResellerEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-data-reseller', function () {
      let formData = new FormData($('#form-edit-data-reseller')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.data_reseller.update', [':id']) }}";
      url = url.replace(':id', $('#edit_data_reseller_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-data-reseller-spinner').removeClass('d-none');
          $('.modal-tombol-edit-data-reseller').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // data reseller delete
    $(document).on('click', '.btn-delete-data-reseller', function () {
      var id = $(this).attr('data-id');
      $('#delete_data_reseller_id').val(id);
      $('#modalDataResellerDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-data-reseller', function () {
      let formData = {
        id: $('#delete_data_reseller_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.data_reseller.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-data-reseller-spinner').removeClass('d-none');
          $('.modal-tombol-delete-data-reseller').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // reseller detail
    $(document).on('click', '.btn-detail-reseller', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.reseller.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.reseller.foto;
          $('#detail_reseller_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          $('#detail_reseller_cabang').val(response.reseller.cabang.nama_cabang);
          $('#detail_reseller_tanggal').val(response.reseller.tanggal);
          $('#detail_reseller_hasil_kunjungan').val(response.reseller.hasil_kunjungan);

          if (response.reseller.data_reseller) {
            $('#detail_reseller_reseller').val(response.reseller.data_reseller.nama_reseller);            
          }
          
          $('#modalResellerDetail').modal('show');
        }
      })
    })
    // reseller edit
    $(document).on('click', '.btn-edit-reseller', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.reseller.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.reseller.foto;
          
          $('#edit_reseller_id').val(response.reseller.id);
          $('#edit_reseller_tanggal').val(response.reseller.tanggal);
          $('#edit_reseller_hasil_kunjungan').val(response.reseller.hasil_kunjungan);
          $('#edit_reseller_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.reseller.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_reseller_cabang_id').append(data_cabang);

          let data_reseller = '';
          $.each(response.data_resellers, function (index, item) {
            data_reseller += '<option value="' + item.id + '">' + item.nama_reseller + '</option>';
          })
          $('#edit_reseller_reseller_id').append(data_reseller);

          $('#modalResellerEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-reseller', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-reseller')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.reseller.update', [':id']) }}";
      url = url.replace(':id', $('#edit_reseller_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-reseller-spinner').removeClass('d-none');
          $('.modal-tombol-edit-reseller').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // reseller delete
    $(document).on('click', '.btn-delete-reseller', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_reseller_id').val(id);
      $('#modalResellerDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-reseller', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_reseller_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.reseller.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-reseller-spinner').removeClass('d-none');
          $('.modal-tombol-delete-reseller').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // survey_kompetitor detail
    $(document).on('click', '.btn-detail-survey-kompetitor', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.survey_kompetitor.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          console.log(response);
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.survey_kompetitor.foto;
          $('#detail_survey_kompetitor_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          $('#detail_survey_kompetitor_cabang').val(response.survey_kompetitor.cabang.nama_cabang);
          $('#detail_survey_kompetitor_tanggal').val(response.survey_kompetitor.tanggal);
          $('#detail_survey_kompetitor_nama_kompetitor').val(response.survey_kompetitor.nama_kompetitor);
          $('#detail_survey_kompetitor_hasil_survey').val(response.survey_kompetitor.hasil_survey);
          $('#detail_survey_kompetitor_promo_kompetitor').val(response.survey_kompetitor.promo_kompetitor);
          
          $('#modalSurveyKompetitorDetail').modal('show');
        }
      })
    })
    // survey kompetitor edit
    $(document).on('click', '.btn-edit-survey-kompetitor', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.survey_kompetitor.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          let asset_url = "{{ asset('/') }}";
          let asset_folder = "public/file/labul/";
          let asset_img = response.survey_kompetitor.foto;
          
          $('#edit_survey_kompetitor_id').val(response.survey_kompetitor.id);
          $('#edit_survey_kompetitor_tanggal').val(response.survey_kompetitor.tanggal);
          $('#edit_survey_kompetitor_nama_kompetitor').val(response.survey_kompetitor.nama_kompetitor);
          $('#edit_survey_kompetitor_hasil_survey').val(response.survey_kompetitor.hasil_survey);
          $('#edit_survey_kompetitor_promo_kompetitor').val(response.survey_kompetitor.promo_kompetitor);
          $('#edit_survey_kompetitor_foto_preview').attr("src", asset_url + asset_folder + asset_img);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.survey_kompetitor.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_survey_kompetitor_cabang_id').append(data_cabang);

          $('#modalSurveyKompetitorEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-survey-kompetitor', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-survey-kompetitor')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.survey_kompetitor.update', [':id']) }}";
      url = url.replace(':id', $('#edit_survey_kompetitor_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-survey-kompetitor-spinner').removeClass('d-none');
          $('.modal-tombol-edit-survey-kompetitor').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // survey kompetitor delete
    $(document).on('click', '.btn-delete-survey-kompetitor', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_survey_kompetitor_id').val(id);
      $('#modalSurveyKompetitorDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-survey-kompetitor', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_survey_kompetitor_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.survey_kompetitor.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-survey-kompetitor-spinner').removeClass('d-none');
          $('.modal-tombol-delete-survey-kompetitor').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // komplain detail
    $(document).on('click', '.btn-detail-komplain', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.komplain.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#detail_komplain_cabang').val(response.komplain.cabang.nama_cabang);
          $('#detail_komplain_tanggal').val(response.komplain.tanggal);
          $('#detail_komplain_nama_customer').val(response.komplain.nama_customer);
          $('#detail_komplain_nomor_hp').val(response.komplain.nomor_hp);
          $('#detail_komplain_kritik_saran').val(response.komplain.kritik_saran);
          $('#detail_komplain_penanganan_awal').val(response.komplain.penanganan_awal);
          
          $('#modalKomplainDetail').modal('show');
        }
      })
    })
    // komplain edit
    $(document).on('click', '.btn-edit-komplain', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.komplain.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {          
          $('#edit_komplain_id').val(response.komplain.id);
          $('#edit_komplain_tanggal').val(response.komplain.tanggal);
          $('#edit_komplain_nama_customer').val(response.komplain.nama_customer);
          $('#edit_komplain_nomor_hp').val(response.komplain.nomor_hp);
          $('#edit_komplain_kritik_saran').val(response.komplain.kritik_saran);
          $('#edit_komplain_penanganan_awal').val(response.komplain.penanganan_awal);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.komplain.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_komplain_cabang_id').append(data_cabang);

          $('#modalKomplainEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-komplain', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-komplain')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.komplain.update', [':id']) }}";
      url = url.replace(':id', $('#edit_komplain_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-komplain-spinner').removeClass('d-none');
          $('.modal-tombol-edit-komplain').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // komplain delete
    $(document).on('click', '.btn-delete-komplain', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_komplain_id').val(id);
      $('#modalKomplainDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-komplain', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_komplain_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.komplain.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-komplain-spinner').removeClass('d-none');
          $('.modal-tombol-delete-komplain').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // reqor detail
    $(document).on('click', '.btn-detail-reqor', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.reqor.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#detail_reqor_cabang').val(response.reqor.cabang.nama_cabang);
          $('#detail_reqor_tanggal').val(response.reqor.tanggal);
          $('#detail_reqor_nama_customer').val(response.reqor.nama_customer);
          $('#detail_reqor_nomor_hp').val(response.reqor.nomor_hp);
          $('#detail_reqor_request_produk').val(response.reqor.request_produk);
          $('#detail_reqor_produk_tertolak').val(response.reqor.produk_tertolak);
          $('#detail_reqor_alasan').val(response.reqor.alasan);
          
          $('#modalReqorDetail').modal('show');
        }
      })
    })
    // reqor edit
    $(document).on('click', '.btn-edit-reqor', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.reqor.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {          
          $('#edit_reqor_id').val(response.reqor.id);
          $('#edit_reqor_tanggal').val(response.reqor.tanggal);
          $('#edit_reqor_nama_customer').val(response.reqor.nama_customer);
          $('#edit_reqor_nomor_hp').val(response.reqor.nomor_hp);
          $('#edit_reqor_request_produk').val(response.reqor.request_produk);
          $('#edit_reqor_produk_tertolak').val(response.reqor.produk_tertolak);
          $('#edit_reqor_alasan').val(response.reqor.alasan);

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.reqor.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_reqor_cabang_id').append(data_cabang);

          $('#modalReqorEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-reqor', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-reqor')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.reqor.update', [':id']) }}";
      url = url.replace(':id', $('#edit_reqor_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-reqor-spinner').removeClass('d-none');
          $('.modal-tombol-edit-reqor').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // reqor delete
    $(document).on('click', '.btn-delete-reqor', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_reqor_id').val(id);
      $('#modalReqorDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-reqor', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_reqor_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.reqor.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-reqor-spinner').removeClass('d-none');
          $('.modal-tombol-delete-reqor').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    // omzet detail
    $(document).on('click', '.btn-detail-omzet', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.omzet.detail', [':id']) }}";
      url = url.replace(':id', id);
      
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#detail_omzet_cabang').val(response.omzet.cabang.nama_cabang);
          $('#detail_omzet_tanggal').val(response.omzet.tanggal);
          $('#detail_omzet_transaksi').val(response.omzet.transaksi);
          $('#detail_omzet_traffic_online').val(response.omzet.traffic_online);
          $('#detail_omzet_traffic_offline').val(response.omzet.traffic_offline);
          $('#detail_omzet_retail').val(format_rupiah(response.omzet.retail));
          $('#detail_omzet_instansi').val(format_rupiah(response.omzet.instansi));
          $('#detail_omzet_reseller').val(format_rupiah(response.omzet.reseller));
          $('#detail_omzet_cabang_rp').val(format_rupiah(response.omzet.cabang_rp));
          $('#detail_omzet_omzet_harian').val(format_rupiah(response.omzet.omzet_harian));
          $('#detail_omzet_omzet_terbayar').val(format_rupiah(response.omzet.omzet_terbayar));
          $('#detail_omzet_leads').val(response.omzet.leads);
          $('#detail_omzet_konsumen_bertanya').val(response.omzet.konsumen_bertanya);
          $('#detail_omzet_cetak_banner_harian').val(format_rupiah(response.omzet.cetak_banner_harian));
          $('#detail_omzet_cetak_a3_harian').val(format_rupiah(response.omzet.cetak_a3_harian));
          $('#detail_omzet_print_outdoor').val(format_rupiah(response.omzet.print_outdoor));
          $('#detail_omzet_print_indoor').val(format_rupiah(response.omzet.print_indoor));
          $('#detail_omzet_offset').val(format_rupiah(response.omzet.offset));
          $('#detail_omzet_merchandise').val(format_rupiah(response.omzet.merchandise));
          $('#detail_omzet_akrilik').val(format_rupiah(response.omzet.akrilik));
          $('#detail_omzet_design').val(format_rupiah(response.omzet.design));
          $('#detail_omzet_laminasi_dingin').val(format_rupiah(response.omzet.laminasi_dingin));
          $('#detail_omzet_laminasi_a3').val(format_rupiah(response.omzet.laminasi_a3));
          $('#detail_omzet_fotocopy').val(format_rupiah(response.omzet.fotocopy));
          $('#detail_omzet_dtf').val(format_rupiah(response.omzet.dtf));
          $('#detail_omzet_uv').val(format_rupiah(response.omzet.uv));
          $('#detail_omzet_advertising_produk').val(format_rupiah(response.omzet.advertising_produk));
          $('#detail_omzet_advertising_jasa').val(format_rupiah(response.omzet.advertising_jasa));
          $('#detail_omzet_cash_harian').val(format_rupiah(response.omzet.cash_harian));
          $('#detail_omzet_piutang_bulan_berjalan').val(format_rupiah(response.omzet.piutang_bulan_berjalan));
          $('#detail_omzet_piutang_terbayar').val(format_rupiah(response.omzet.piutang_terbayar));
          $('#detail_omzet_karyawan_sales_id').val(response.omzet.sales.nama_lengkap);
          $('#detail_omzet_pencapaian_omzet_sales').val(format_rupiah(response.omzet.pencapaian_omset_sales));
          $('#detail_omzet_pencapaian_cash_sales').val(format_rupiah(response.omzet.pencapaian_cash_sales));
          
          $('#modalOmzetDetail').modal('show');
        }
      })
    })
    // omzet edit
    $(document).on('click', '.btn-edit-omzet', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      let url = "{{ URL::route('labul.result.omzet.edit', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        success: function (response) {          
          $('#edit_omzet_id').val(response.omzet.id);
          $('#edit_omzet_tanggal').val(response.omzet.tanggal);
          $('#edit_omzet_transaksi').val(response.omzet.transaksi);
          $('#edit_omzet_traffic_online').val(response.omzet.traffic_online);
          $('#edit_omzet_traffic_offline').val(response.omzet.traffic_offline);
          $('#edit_omzet_retail').val(format_rupiah(response.omzet.retail));
          $('#edit_omzet_instansi').val(format_rupiah(response.omzet.instansi));
          $('#edit_omzet_reseller').val(format_rupiah(response.omzet.reseller));
          $('#edit_omzet_cabang_rp').val(format_rupiah(response.omzet.cabang_rp));
          $('#edit_omzet_omzet_harian').val(format_rupiah(response.omzet.omzet_harian));
          $('#edit_omzet_omzet_terbayar').val(format_rupiah(response.omzet.omzet_terbayar));
          $('#edit_omzet_leads').val(response.omzet.leads);
          $('#edit_omzet_konsumen_bertanya').val(response.omzet.konsumen_bertanya);
          $('#edit_omzet_cetak_banner_harian').val(format_rupiah(response.omzet.cetak_banner_harian));
          $('#edit_omzet_cetak_a3_harian').val(format_rupiah(response.omzet.cetak_a3_harian));
          $('#edit_omzet_print_outdoor').val(format_rupiah(response.omzet.print_outdoor));
          $('#edit_omzet_print_indoor').val(format_rupiah(response.omzet.print_indoor));
          $('#edit_omzet_offset').val(format_rupiah(response.omzet.offset));
          $('#edit_omzet_merchandise').val(format_rupiah(response.omzet.merchandise));
          $('#edit_omzet_akrilik').val(format_rupiah(response.omzet.akrilik));
          $('#edit_omzet_design').val(format_rupiah(response.omzet.design));
          $('#edit_omzet_laminasi_dingin').val(format_rupiah(response.omzet.laminasi_dingin));
          $('#edit_omzet_laminasi_a3').val(format_rupiah(response.omzet.laminasi_a3));
          $('#edit_omzet_fotocopy').val(format_rupiah(response.omzet.fotocopy));
          $('#edit_omzet_dtf').val(format_rupiah(response.omzet.dtf));
          $('#edit_omzet_uv').val(format_rupiah(response.omzet.uv));
          $('#edit_omzet_advertising_produk').val(format_rupiah(response.omzet.advertising_produk));
          $('#edit_omzet_advertising_jasa').val(format_rupiah(response.omzet.advertising_jasa));
          $('#edit_omzet_cash_harian').val(format_rupiah(response.omzet.cash_harian));
          $('#edit_omzet_piutang_bulan_berjalan').val(format_rupiah(response.omzet.piutang_bulan_berjalan));
          $('#edit_omzet_piutang_terbayar').val(format_rupiah(response.omzet.piutang_terbayar));
          $('#edit_omzet_pencapaian_omzet_sales').val(format_rupiah(response.omzet.pencapaian_omset_sales));
          $('#edit_omzet_pencapaian_cash_sales').val(format_rupiah(response.omzet.pencapaian_cash_sales));

          let data_cabang = '';
          $.each(response.cabangs, function (index, item) {
            data_cabang += '<option value="' + item.id + '"';
            
            if (item.id == response.omzet.cabang_id) {
              data_cabang += ' selected';
            }

            data_cabang += '>' + item.nama_cabang + '</option>';
          })
          $('#edit_omzet_cabang_id').append(data_cabang);

          let data_sales = '';
          $.each(response.sales, function (index, item) {
            data_sales += '<option value="' + item.id + '"';
            
            if (item.id == response.omzet.karyawan_sales_id) {
              data_sales += ' selected';
            }

            data_sales += '>' + item.nama_lengkap + '</option>';
          })
          $('#edit_omzet_karyawan_sales_id').append(data_sales);

          $('#modalOmzetEdit').modal('show');
        }
      })
    })
    $(document).on('click', '.modal-tombol-edit-omzet', function (e) {
      e.preventDefault();
      let formData = new FormData($('#form-edit-omzet')[0]);
      formData.append('_method', 'put');

      let url = "{{ URL::route('labul.result.omzet.update', [':id']) }}";
      url = url.replace(':id', $('#edit_omzet_id').val());

      $.ajax({
        url: url,
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.modal-tombol-edit-omzet-spinner').removeClass('d-none');
          $('.modal-tombol-edit-omzet').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil diperbaharui'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })
    // omzet delete
    $(document).on('click', '.btn-delete-omzet', function (e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      $('#delete_omzet_id').val(id);
      $('#modalOmzetDelete').modal('show');
    });
    $(document).on('click', '.modal-tombol-delete-omzet', function (e) {
      e.preventDefault();
      let formData = {
        id: $('#delete_omzet_id').val()
      }

      $.ajax({
        url: "{{ URL::route('labul.result.omzet.delete') }}",
        type: "post",
        data: formData,
        beforeSend: function () {
          $('.modal-tombol-delete-omzet-spinner').removeClass('d-none');
          $('.modal-tombol-delete-omzet').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Sukses <br> data berhasil dihapus'
          })

          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      })
    })

    $(document).on('shown.bs.modal', '#modalOmzetEdit', function() {
      let retail = document.getElementById("edit_omzet_retail");
      retail.addEventListener("keyup", function(e) {
        retail.value = formatRupiah(this.value, "");
      });

      let instansi = document.getElementById("edit_omzet_instansi");
      instansi.addEventListener("keyup", function(e) {
        instansi.value = formatRupiah(this.value, "");
      });

      let reseller = document.getElementById("edit_omzet_reseller");
      reseller.addEventListener("keyup", function(e) {
        reseller.value = formatRupiah(this.value, "");
      });

      let cabang = document.getElementById("edit_omzet_cabang_rp");
      cabang.addEventListener("keyup", function(e) {
        cabang.value = formatRupiah(this.value, "");
      });

      let omzet_harian = document.getElementById("edit_omzet_omzet_harian");
      omzet_harian.addEventListener("keyup", function(e) {
        omzet_harian.value = formatRupiah(this.value, "");
      });

      let omzet_terbayar = document.getElementById("edit_omzet_omzet_terbayar");
      omzet_terbayar.addEventListener("keyup", function(e) {
        omzet_terbayar.value = formatRupiah(this.value, "");
      });

      let cetak_banner_harian = document.getElementById("edit_omzet_cetak_banner_harian");
      cetak_banner_harian.addEventListener("keyup", function(e) {
        cetak_banner_harian.value = formatRupiah(this.value, "");
      });

      let cetak_a3_harian = document.getElementById("edit_omzet_cetak_a3_harian");
      cetak_a3_harian.addEventListener("keyup", function(e) {
        cetak_a3_harian.value = formatRupiah(this.value, "");
      });

      let print_outdoor = document.getElementById("edit_omzet_print_outdoor");
      print_outdoor.addEventListener("keyup", function(e) {
        print_outdoor.value = formatRupiah(this.value, "");
      });

      let print_indoor = document.getElementById("edit_omzet_print_indoor");
      print_indoor.addEventListener("keyup", function(e) {
        print_indoor.value = formatRupiah(this.value, "");
      });

      let offset = document.getElementById("edit_omzet_offset");
      offset.addEventListener("keyup", function(e) {
        offset.value = formatRupiah(this.value, "");
      });

      let merchandise = document.getElementById("edit_omzet_merchandise");
      merchandise.addEventListener("keyup", function(e) {
        merchandise.value = formatRupiah(this.value, "");
      });

      let akrilik = document.getElementById("edit_omzet_akrilik");
      akrilik.addEventListener("keyup", function(e) {
        akrilik.value = formatRupiah(this.value, "");
      });

      let design = document.getElementById("edit_omzet_design");
      design.addEventListener("keyup", function(e) {
        design.value = formatRupiah(this.value, "");
      });

      let laminasi_dingin = document.getElementById("edit_omzet_laminasi_dingin");
      laminasi_dingin.addEventListener("keyup", function(e) {
        laminasi_dingin.value = formatRupiah(this.value, "");
      });

      let laminasi_a3 = document.getElementById("edit_omzet_laminasi_a3");
      laminasi_a3.addEventListener("keyup", function(e) {
        laminasi_a3.value = formatRupiah(this.value, "");
      });

      let fotocopy = document.getElementById("edit_omzet_fotocopy");
      fotocopy.addEventListener("keyup", function(e) {
        fotocopy.value = formatRupiah(this.value, "");
      });

      let dtf = document.getElementById("edit_omzet_dtf");
      dtf.addEventListener("keyup", function(e) {
        dtf.value = formatRupiah(this.value, "");
      });

      let uv = document.getElementById("edit_omzet_uv");
      uv.addEventListener("keyup", function(e) {
        uv.value = formatRupiah(this.value, "");
      });

      let advertising_produk = document.getElementById("edit_omzet_advertising_produk");
      advertising_produk.addEventListener("keyup", function(e) {
        advertising_produk.value = formatRupiah(this.value, "");
      });

      let advertising_jasa = document.getElementById("edit_omzet_advertising_jasa");
      advertising_jasa.addEventListener("keyup", function(e) {
        advertising_jasa.value = formatRupiah(this.value, "");
      });

      let cash_harian = document.getElementById("edit_omzet_cash_harian");
      cash_harian.addEventListener("keyup", function(e) {
        cash_harian.value = formatRupiah(this.value, "");
      });

      let piutang_bulan_berjalan = document.getElementById("edit_omzet_piutang_bulan_berjalan");
      piutang_bulan_berjalan.addEventListener("keyup", function(e) {
        piutang_bulan_berjalan.value = formatRupiah(this.value, "");
      });

      let piutang_terbayar = document.getElementById("edit_omzet_piutang_terbayar");
      piutang_terbayar.addEventListener("keyup", function(e) {
        piutang_terbayar.value = formatRupiah(this.value, "");
      });

      let pencapaian_omset_sales = document.getElementById("edit_omzet_pencapaian_omzet_sales");
      pencapaian_omset_sales.addEventListener("keyup", function(e) {
        pencapaian_omset_sales.value = formatRupiah(this.value, "");
      });

      let pencapaian_cash_sales = document.getElementById("edit_omzet_pencapaian_cash_sales");
      pencapaian_cash_sales.addEventListener("keyup", function(e) {
        pencapaian_cash_sales.value = formatRupiah(this.value, "");
      });
    });
  });
</script>

@endsection
