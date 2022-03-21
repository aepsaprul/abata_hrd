@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Resign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Resign</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('pengajuan_resign.create') }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Lokasi Kerja</th>
                                        <th class="text-center text-indigo">Tanggal Masuk</th>
                                        <th class="text-center text-indigo">Tanggal Keluar</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resigns as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->lokasi_kerja }}</td>
                                            <td class="text-center">{{ $item->tanggal_masuk }}</td>
                                            <td class="text-center">{{ $item->tanggal_keluar }}</td>
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
                                                        style="width: {{ $percent }}%;">
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
        </div>
    </section>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable();
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
    });
</script>

@endsection
