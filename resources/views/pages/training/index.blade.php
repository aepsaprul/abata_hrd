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
                    <h1>Training</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Training</li>
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
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Kategori</th>
                                        <th class="text-center text-indigo">Judul</th>
                                        <th class="text-center text-indigo">Divisi</th>
                                        <th class="text-center text-indigo">Tanggal</th>
                                        <th class="text-center text-indigo">Modul</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainings as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-uppercase">{{ $item->kategori }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>
                                                @if ($item->masterDivisi)
                                                    {{ $item->masterDivisi->nama }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->tanggal }}</td>
                                            <td class="text-center">
                                                @if ($item->modul)
                                                    <a href="{{ route('training.modul', [$item->modul]) }}">download</a>
                                                @else
                                                    Modul Kosong
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
                                                            href="#"
                                                            class="dropdown-item border-bottom btn-show"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item border-bottom btn-edit"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-delete"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-trash text-center mr-2" style="width: 20px;"></i> Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade modal-create" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-create" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Training</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="create_kategori" class="form-control" required>
                                {{-- data di jquery --}}
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="create_judul" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_divisi_id" class="form-label">Divisi</label>
                            <select name="divisi_id" id="create_divisi_id" class="form-control" required>
                                {{-- data di jquery --}}
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="create_tanggal" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_durasi" class="form-label">Durasi</label>
                            <input type="text" name="durasi" id="create_durasi" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_peserta" class="form-label">Peserta</label>
                            <input type="text" name="peserta" id="create_peserta" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_tempat" class="form-label">Tempat</label>
                            <input type="text" name="tempat" id="create_tempat" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_goal" class="form-label">Goal</label>
                            <input type="text" name="goal" id="create_goal" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_pengisi" class="form-label">pengisi</label>
                            <input type="text" name="pengisi" id="create_pengisi" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_jenis" class="form-label">Jenis</label>
                            <select name="jenis" id="create_jenis" class="form-control" required>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_hasil" class="form-label">Hasil</label>
                            <input type="text" name="hasil" id="create_hasil" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_status" class="form-label">Status</label>
                            <input type="text" name="status" id="create_status" class="form-control" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label for="create_modul" class="form-label">Modul</label>
                            <input type="file" name="modul" id="create_modul" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

        $('#btn-create').on('click', function(e) {
            e.preventDefault();
            $('#create_divisi_id').empty();

            $.ajax({
                url: "{{ URL::route('training.create') }}",
                type: "GET",
                success: function (response) {
                    // kategori
                    let value_kategori = "";
                    "<option value=\"softskill\">Softskill</option>" +
                    "<option value=\"hardskill\">Hardskill</option>";
                    $('#kategori').append(value_kategori);

                    // divisi
                    let value_divisi = "<option value=\"\">--Pilih Divisi--</option>";
                    $.each(response.divisis, function(index, item) {
                        value_divisi += "<option value=\"" + item.id + "\">" + item.nama + "</option>";
                    });
                    $('#cdivisi_id').append(value_divisi);

                    // jenis
                    let value_jenis = "" +

                    $('.modal').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_kategori').focus();
        });

        $(document).on('submit', '#form-create', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                url: "{{ URL::route('training.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-create-spinner').removeClass('d-none');
                    $('.btn-create-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil ditambah'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // edit
        $('body').on('click', '.btn-edit', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("training.edit", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#edit_id').val(response.training.id);
                    $('#edit_judul').val(response.training.judul);
                    $('#edit_tanggal').val(response.training.tanggal);
                    $('#edit_durasi').val(response.training.durasi);
                    $('#edit_peserta').val(response.training.peserta);
                    $('#edit_tempat').val(response.training.tempat);
                    $('#edit_goal').val(response.training.goal);
                    $('#edit_pengisi').val(response.training.pengisi);
                    $('#edit_hasil').val(response.training.hasil);
                    $('#edit_status').val(response.training.status);

                    // ketegori
                    let value_kategori = "" +
                    "<option value=\"softskill\"";
                    if (response.training.kategori == "softskill") {
                        value_kategori += " selected";
                    }
                    value_kategori += ">Softskill</option>" +
                    "<option value=\"hardskill\"";
                    if (response.training.kategori == "hardskill") {
                        value_kategori += " selected";
                    }
                    value_kategori += ">Hardskill</option>";
                    $('#edit_kategori').append(value_kategori);

                    // divisi
                    let value_divisi = "<option value=\"\">--Pilih Divisi--</option>";
                    $.each(response.divisis, function(index, item) {
                        value_divisi += "<option value=\"" + item.id + "\"";
                        if (item.id == response.training.master_divisi_id) {
                            value_divisi += " selected";
                        }
                        value_divisi += ">" + item.nama + "</option>";
                    });
                    $('#edit_divisi_id').append(value_divisi);

                    // jenis
                    let value_jenis = "";
                    value_jenis += "<option value=\"online\"";
                    if (response.training.jenis == "online") {
                        value_jenis += " selected";
                    }
                    value_jenis += ">Online</option>";
                    value_jenis += "<option value=\"offline\"";
                    if (response.training.jenis == "offline") {
                        value_jenis += " selected";
                    }
                    value_jenis += ">Offline</option>";
                    $('#edit_jenis').append(value_jenis);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $('#form-edit').submit(function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-edit')[0]);

            $.ajax({
                url: "{{ URL::route('training.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-edit-spinner').removeClass("d-none");
                    $('.btn-edit-save').addClass("d-none");
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil diperbaharui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("training.delete_btn", ":id") }}';
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
                url: "{{ URL::route('training.delete') }}",
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
                    var errorMessage = xhr.status + ': ' + xhr.statusText

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
