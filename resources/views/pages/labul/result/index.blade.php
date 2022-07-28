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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Activity Plan</span>
                                <a href="{{ route('labul.result.export_activity_plan') }}" class="btn btn-sm btn-success px-4">Excel</a>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Data Member</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Reseller</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Data Reseller</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Instansi</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Survey Kompetitor</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Komplain (Kritik & Saran)</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Data Instansi</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Request & Orderan Tertolak</span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header text-center">
                            <span class="font-weight-bold">Omzet Cabang</span>
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
