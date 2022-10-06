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
          console.log(response);
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
        }
      })
      $('#modalActivityPlanDetail').modal('show');
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
          console.log(response);
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
        }
      })
      $('#modalActivityPlanEdit').modal('show');
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
  });
</script>

@endsection
