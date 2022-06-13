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
                    <h1>Approval</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Approval</li>
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

                    {{-- cuti --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permohonan Cuti</h3>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Jenis Cuti</th>
                                        <th class="text-center text-indigo">Approve</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuti_details as $key => $item)
                                        @if ($item->hirarki > 1 && $item->status == 0)
                                        @else
                                            @if ($item->cuti)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $item->cuti->masterKaryawan->nama_lengkap }}</td>
                                                    <td>{{ $item->cuti->jenis }}</td>
                                                    <td class="text-center">
                                                        @if ($item->confirm == 1)
                                                            <span class="bg-success px-2">Approved</span>
                                                        @elseif ($item->confirm == 2)
                                                            <span class="bg-danger px-2">Disapproved</span>
                                                        @else
                                                        <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $item->id }}"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-primary btn-sm btn-approve-spinner d-none" disabled>
                                                            <span class="spinner-grow spinner-grow-sm"></span>
                                                        </button>
                                                            <button class="btn btn-sm btn-danger btn-disapprove" style="width: 40px;" data-id="{{ $item->id }}"><i class="fas fa-times"></i></button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
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
                                                                <a
                                                                    href="#" class="dropdown-item btn-detail text-indigo"
                                                                    data-id="{{ $item->cuti->id }}">
                                                                        <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- resign --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permohonan Resign</h3>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="example2" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Karyawan</th>
                                        <th class="text-center text-indigo">Lokasi Kerja</th>
                                        <th class="text-center text-indigo">Tanggal Masuk</th>
                                        <th class="text-center text-indigo">Tanggal Keluar</th>
                                        <th class="text-center text-indigo">Approve</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resign_details as $key => $item)
                                        @if ($item->hirarki > 1 && $item->status == 0)
                                        @else
                                            @if ($item->resign)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $item->resign->masterKaryawan->nama_panggilan }}</td>
                                                    <td>{{ $item->resign->lokasi_kerja }}</td>
                                                    <td>{{ $item->resign->tanggal_masuk }}</td>
                                                    <td>{{ $item->resign->tanggal_keluar }}</td>
                                                    <td class="text-center">
                                                        @if ($item->confirm == 1)
                                                            <span class="bg-success px-2">Approved</span>
                                                        @elseif ($item->confirm == 2)
                                                            <span class="bg-danger px-2">Disapproved</span>
                                                        @else
                                                            <button class="btn btn-sm btn-primary btn-resign-approve" style="width: 40px;" data-id="{{ $item->id }}"><i class="fas fa-check"></i></button>
                                                            <button class="btn btn-primary btn-sm btn-resign-approve-spinner d-none" disabled>
                                                                <span class="spinner-grow spinner-grow-sm"></span>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger btn-resign-disapprove" style="width: 40px;" data-id="{{ $item->id }}"><i class="fas fa-times"></i></button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
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
                                                                <a
                                                                    href="{{ route('approval.resign_show', [$item->resign->id]) }}" class="dropdown-item btn-resign-detail text-indigo"
                                                                    data-id="{{ $item->resign->id }}">
                                                                        <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
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

{{-- modal detail --}}
<div class="modal fade modal-detail" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pengajuan Cuti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" readonly>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <label for="telepon" class="form-label">No Telepon Aktif</label>
                        <input type="number" class="form-control" id="telepon" name="telepon" readonly>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <label for="pengganti">Karyawan Pengganti</label>
                        <input type="text" name="pengganti" id="pengganti" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <label for="jml_hari">Jumlah Hari</label>
                        <input type="text" name="jml_hari" id="jml_hari" class="form-control" readonly>
                        <div id="form_tanggal" class="mt-3">

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <label for="alasan">Alasan Cuti (Secara Lebih Detail)</label>
                        <input type="text" name="alasan" id="alasan" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <label for="sisa_cuti">Sisa Cuti</label>
                        <input type="text" name="sisa_cuti" id="sisa_cuti" class="form-control" readonly>
                    </div>
                </div>
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
    $(function () {
        $("#example1").DataTable({
            paging: false,
            searching: false
        });

        $("#example2").DataTable({
            paging: false,
            searching: false
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

        // btn approve cuti
        $(document).on('click', '.btn-approve', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("approval.approved", ":id") }}';
            url = url.replace(':id', id);

            let formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                beforeSend: function () {
                    $('.btn-approve-spinner').removeClass('d-none');
                    $('.btn-approve').addClass('d-none');
                },
                success: function (response) {
                    console.log(response);
                    Toast.fire({
                        icon: 'success',
                        title: 'Cuti telah disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });

        // btn disapprove cuti
        $(document).on('click', '.btn-disapprove', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("approval.disapproved", ":id") }}';
            url = url.replace(':id', id);

            let formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                beforeSend: function () {
                    $('.btn-approve-spinner').removeClass('d-none');
                    $('.btn-disapprove').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cuti tidak disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });

        // detail cuti
        $(document).on('click', '.btn-detail', function (e) {
            e.preventDefault();
            $('#form_tanggal').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("approval.show", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('#nama').val(response.cuti.master_karyawan.nama_lengkap);
                    $('#telepon').val(response.cuti.telepon);
                    $('#pengganti').val(response.cuti.karyawan_pengganti.nama_lengkap);
                    $('#keterangan').val(response.cuti.jenis);
                    $('#jml_hari').val(response.cuti.jml_hari);
                    $('#alasan').val(response.cuti.alasan);
                    $('#sisa_cuti').val(response.cuti.master_karyawan.total_cuti);

                    var value_tanggal = "";
                    $.each(response.cuti.cuti_tgl, function (index, item) {
                        value_tanggal += "" +
                        "<label>Tanggal " + (index + 1) + "</label>" +
                        "<input type=\"text\" class=\"form-control\" value=\"" + item.tanggal + "\" readonly>";
                    });
                    $('#form_tanggal').append(value_tanggal);
                    console.log(value_tanggal);

                    $('.modal-detail').modal('show');
                }
            });
        });

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("cuti.delete_btn", ":id") }}';
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

        $('#form-delete').submit(function (e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val()
            }

            $.ajax({
                url: "{{ URL::route('cuti.delete') }}",
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.btn-delete-spinner').css('display', 'block');
                    $('.btn-delete-yes').css('display', 'none');
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
                    var errorMessage = xhr.status + ': ' + xhar.statusText

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // btn approve resign
        $(document).on('click', '.btn-resign-approve', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("approval.resign_approved", ":id") }}';
            url = url.replace(':id', id);

            let formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                beforeSend: function () {
                    $('.btn-resign-approve-spinner').removeClass('d-none');
                    $('.btn-resign-approve').addClass('d-none');
                },
                success: function (response) {
                    console.log(response);
                    Toast.fire({
                        icon: 'success',
                        title: 'Resign telah disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });

        // btn disapprove resign
        $(document).on('click', '.btn-resign-disapprove', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("approval.resign_disapproved", ":id") }}';
            url = url.replace(':id', id);

            let formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                beforeSend: function () {
                    $('.btn-resign-approve-spinner').removeClass('d-none');
                    $('.btn-resign-disapprove').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Resign tidak disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });
    });
</script>

@endsection
