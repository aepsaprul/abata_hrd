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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Karyawan Aktif</span>
                            <span class="info-box-number">{{ $count_karyawan_aktif }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Karyawan Nonaktif</span>
                            <span class="info-box-number">{{ $count_karyawan_nonaktif }}</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-mug-hot"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengajuan Cuti</span>
                            <span class="info-box-number">{{ $count_cuti }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengajuan Resign</span>
                            <span class="info-box-number">{{ $count_resign }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    {{-- karyawan kontrak --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Karyawan Kontrak</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_kontrak" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Mulai Kontrak</th>
                                        <th class="text-center text-indigo">Akhir Kontrak</th>
                                        <th class="text-center text-indigo">Batas Kontrak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan_kontrak as $key => $item)
                                        @php
                                            $waktu_sekarang  = Date('Y-m-d');
                                            $akhir_kontrak = Date($item->akhir_kontrak);
                                        @endphp
                                        @if (strtotime($waktu_sekarang) < strtotime($akhir_kontrak))
                                            @php
                                                $waktuawal  = date_create($akhir_kontrak);
                                                $waktuakhir = date_create();
                                                $diff  = date_diff($waktuawal, $waktuakhir);
                                            @endphp

                                            @if ($diff->days < 90 && $diff->days > 1)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>
                                                        @if ($item->karyawan)
                                                            {{ $item->karyawan->nama_lengkap }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $item->mulai_kontrak }}</td>
                                                    <td class="text-center">{{ $item->akhir_kontrak }}</td>
                                                    <td>
                                                        @if ($diff->m > 0)
                                                            @php echo $diff->format('Kontrak Habis <strong> %m Bulan %d Hari </strong> Lagi') @endphp
                                                        @else
                                                            @php echo $diff->format('Kontrak Habis <strong> %d Hari </strong> Lagi') @endphp
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- karyawan aktif --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Karyawan Aktif</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_aktif" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan_aktif as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td class="text-center">{{ $item->telepon }}</td>
                                            <td>{{ $item->masterCabang->nama_cabang }}</td>
                                            <td>
                                                @if ($item->masterJabatan)
                                                    {{ $item->masterJabatan->nama_jabatan }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- karyawan nonaktif --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase" style="font-weight: 600;">Karyawan Nonaktif</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_nonaktif" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan_nonaktif as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td class="text-center">{{ $item->telepon }}</td>
                                            <td>{{ $item->masterCabang->nama_cabang }}</td>
                                            <td>{{ $item->masterJabatan->nama_jabatan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- cuti --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase"><strong>Pengajuan Cuti</strong></h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_cuti" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Alasan</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuti as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->karyawan->nama_lengkap }}</td>
                                            <td>{{ $item->alasan }}</td>
                                            <td>
                                                @if ($item->approved_percentage > 100)
                                                    @php
                                                        $percent = 100;
                                                    @endphp
                                                @else
                                                    @php
                                                        $percent = $item->approved_percentage
                                                    @endphp
                                                @endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $item->approved_background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percent }}%">
                                                            <span class="">{{ $percent }}%</span>
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px;">
                                                    {{ $item->approved_text }} {{ $item->approvedLeader ? $item->approvedLeader->nama_panggilan : "" }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- resign --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Pengajuan Resign</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_resign" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Alasan</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resign as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->karyawan->nama_lengkap }}</td>
                                            <td>{{ $item->alasan }}</td>
                                            <td>
                                                @if ($item->approved_percentage > 100)
                                                    @php
                                                        $percent = 100;
                                                    @endphp
                                                @else
                                                    @php
                                                        $percent = $item->approved_percentage
                                                    @endphp
                                                @endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $item->approved_background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percent }}%">
                                                            <span class="">{{ $percent }}%</span>
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px;">
                                                    {{ $item->approved_text }} {{ $item->approvedLeader ? $item->approvedLeader->nama_panggilan : "" }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
    $(function () {
        $("#tabel_karyawan_kontrak").DataTable();
        $("#tabel_karyawan_aktif").DataTable();
        $("#tabel_karyawan_nonaktif").DataTable();
        $("#tabel_cuti").DataTable();
        $("#tabel_resign").DataTable();
    });
</script>
@endsection
