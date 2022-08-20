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
                                                    <label for="activity_plan_cabang_id">Cabang</label>
                                                    <select name="activity_plan_cabang_id" id="activity_plan_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="activity_plan_start_date">Start Date</label>
                                                    <input type="date" name="activity_plan_start_date" id="activity_plan_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="activity_plan_end_date">End Date</label>
                                                    <input type="date" name="activity_plan_end_date" id="activity_plan_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity_plans as $key => $item)
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
                                                    <label for="data_member_cabang_id">Cabang</label>
                                                    <select name="data_member_cabang_id" id="data_member_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_member_start_date">Start Date</label>
                                                    <input type="date" name="data_member_start_date" id="data_member_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_member_end_date">End Date</label>
                                                    <input type="date" name="data_member_end_date" id="data_member_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="reseller_cabang_id">Cabang</label>
                                                    <select name="reseller_cabang_id" id="reseller_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="reseller_start_date">Start Date</label>
                                                    <input type="date" name="reseller_start_date" id="reseller_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="reseller_end_date">End Date</label>
                                                    <input type="date" name="reseller_end_date" id="reseller_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="data_reseller_cabang_id">Cabang</label>
                                                    <select name="data_reseller_cabang_id" id="data_reseller_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_reseller_start_date">Start Date</label>
                                                    <input type="date" name="data_reseller_start_date" id="data_reseller_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_reseller_end_date">End Date</label>
                                                    <input type="date" name="data_reseller_end_date" id="data_reseller_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="instansi_cabang_id">Cabang</label>
                                                    <select name="instansi_cabang_id" id="instansi_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="instansi_start_date">Start Date</label>
                                                    <input type="date" name="instansi_start_date" id="instansi_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="instansi_end_date">End Date</label>
                                                    <input type="date" name="instansi_end_date" id="instansi_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="survey_kompetitor_cabang_id">Cabang</label>
                                                    <select name="survey_kompetitor_cabang_id" id="survey_kompetitor_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="survey_kompetitor_start_date">Start Date</label>
                                                    <input type="date" name="survey_kompetitor_start_date" id="survey_kompetitor_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="survey_kompetitor_end_date">End Date</label>
                                                    <input type="date" name="survey_kompetitor_end_date" id="survey_kompetitor_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="komplain_cabang_id">Cabang</label>
                                                    <select name="komplain_cabang_id" id="komplain_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="komplain_start_date">Start Date</label>
                                                    <input type="date" name="komplain_start_date" id="komplain_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="komplain_end_date">End Date</label>
                                                    <input type="date" name="komplain_end_date" id="komplain_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="data_instansi_cabang_id">Cabang</label>
                                                    <select name="data_instansi_cabang_id" id="data_instansi_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_instansi_start_date">Start Date</label>
                                                    <input type="date" name="data_instansi_start_date" id="data_instansi_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="data_instansi_end_date">End Date</label>
                                                    <input type="date" name="data_instansi_end_date" id="data_instansi_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="reqor_cabang_id">Cabang</label>
                                                    <select name="reqor_cabang_id" id="reqor_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="reqor_start_date">Start Date</label>
                                                    <input type="date" name="reqor_start_date" id="reqor_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="reqor_end_date">End Date</label>
                                                    <input type="date" name="reqor_end_date" id="reqor_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
                                                    <label for="omzet_cabang_id">Cabang</label>
                                                    <select name="omzet_cabang_id" id="omzet_cabang_id" class="form-control form-control-sm">
                                                        <option value="">--Pilih Cabang--</option>
                                                        @foreach ($cabangs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="omzet_start_date">Start Date</label>
                                                    <input type="date" name="omzet_start_date" id="omzet_start_date" class="form-control form-control-sm" value="{{ date('Y-m-') }}01" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="omzet_end_date">End Date</label>
                                                    <input type="date" name="omzet_end_date" id="omzet_end_date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Aksi</label>
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
    });
</script>

@endsection
