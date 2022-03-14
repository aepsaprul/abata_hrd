@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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
                    <div class="card">
                        <div class="card-body">
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
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $item->cuti->masterKaryawan->nama_lengkap }}</td>
                                                <td>{{ $item->cuti->jenis }}</td>
                                                <td class="text-center">
                                                    @if ($item->confirm == 1)
                                                        <span class="bg-success px-2">Approve</span>
                                                    @else
                                                        <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $item->id }}"><i class="fas fa-check"></i></button>
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
                                                                href="#" class="dropdown-item border-bottom btn-detail text-indigo"
                                                                data-id="{{ $item->id }}">
                                                                    <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                            </a>
                                                            <a
                                                                href="#"
                                                                class="dropdown-item btn-delete text-indigo"
                                                                data-id="{{ $item->id }}">
                                                                    <i class="fas fa-trash text-center mr-2" style="width: 20px;"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
<!-- /.content-wrapper -->

{{-- modal detail --}}
<div class="modal fade modal-detail" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-detail">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Cuti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="master_karyawan_id" id="master_karyawan_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Atasan Langsung</label>
                                <input type="text" name="atasan" id="atasan" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- formulir cuti  --}}
                    <div id="formulir_cuti">
                        <table class="table table-bordered">
                            <tr>
                                <td><label>Jabatan</label></td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="master_jabatan_id" id="master_jabatan_id" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td><label>No Telp yg aktif</label></td>
                                <td>:</td>
                                <td><input type="number" name="telepon" id="telepon" class="form-control"></td>
                            </tr>
                        </table>
                        <label for="">Menerangkan dengan ini bahwa saya bermaksud untuk mengambil cuti :</label>
                        <input type="text" name="jenis" id="jenis" class="form-control">
                        <br>
                        <table id="data_maksud_cuti" class="table table-bordered">
                            {{-- data di jquery --}}
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
    </div>
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

        // btn approve
        $(document).on('click', '.btn-approve', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            alert(id);
        });

        // btn disapprove
        $(document).on('click', '.btn-disapprove', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            alert(id);
        });

        // detail
        $(document).on('click', '.btn-detail', function (e) {
            e.preventDefault();
            $('#data_maksud_cuti').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("cuti.show", ":id") }}';
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
                    $('#atasan').val(response.cuti.atasan_langsung.nama_lengkap);
                    $('#master_karyawan_id').val(response.cuti.master_karyawan.nama_lengkap);
                    $('#master_jabatan_id').val(response.cuti.master_jabatan.nama_jabatan);
                    $('#telepon').val(response.cuti.telepon);
                    $('#jenis').val(response.cuti.jenis);

                    let value_maksud_cuti = "";
                    $.each(response.cuti_tgls, function (index, item) {
                         value_maksud_cuti += "" +
                            "<tr>" +
                                "<td>Tanggal " + (index + 1) + "</td>" +
                                "<td><input type=\"text\" name=\"cuti_tgl\" id=\"cuti_tgl\" class=\"form-control\" value=\"" + item.tanggal + "\"></td>" +
                            "</tr>";
                    });
                    value_maksud_cuti += "" +
                        "<tr>" +
                            " <td>Nama karyawan pengganti saat cuti adalah</td>" +
                            "<td>" +
                                "<input type=\"text\" name=\"pengganti\" id=\"pengganti\" class=\"form-control\" value=\"" + response.cuti.karyawan_pengganti + "\">" +
                            "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>Alasan Cuti (secara lebih detail)</td>" +
                            "<td><input type=\"text\" name=\"alasan\" id=\"alasan\" class=\"form-control\" value=\"" + response.cuti.alasan + "\"></td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>Dan saya bersedia berangkat kerja lagi mulai tanggal</td>" +
                            "<td><input type=\"text\" name=\"tanggal_kerja\" id=\"tanggal_kerja\" class=\"form-control\" value=\"" + response.cuti.tanggal_kerja + "\"></td>" +
                        "</tr>";

                    $('#data_maksud_cuti').append(value_maksud_cuti);

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
    });
</script>

@endsection
