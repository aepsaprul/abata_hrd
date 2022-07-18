@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Loker</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Loker</li>
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
                        @if (in_array("tambah", $current_data_navigasi))
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                </h3>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Lokasi</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                        <th class="text-center text-indigo">Detail</th>
                                        <th class="text-center text-indigo">Publish</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokers as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                @if ($item->cabang)
                                                    {{ $item->cabang->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>{{ $item->lokasi }}</td>
                                            <td>
                                                @if ($item->jabatan)
                                                    {{ $item->jabatan->nama_jabatan }}
                                                @endif
                                            </td>
                                            <td class="text-center"><a href="#" class="btn-img" data-id="{{ $item->id }}">Gambar</a></td>
                                            <td class="text-center"><input type="checkbox" name="index[]" id="index_{{ $item->id }}" data-id="{{ $item->id }}" value="{{ $item->publish }}" {{ $item->publish == "y" ? 'checked' : '' }}></td>
                                            <td class="text-center">
                                                @if (in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                                                            @if (in_array("ubah", $current_data_navigasi))
                                                                <a
                                                                    href="#"
                                                                    class="dropdown-item border-bottom btn-edit"
                                                                    data-id="{{ $item->id }}">
                                                                        <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                                                </a>
                                                            @endif
                                                            @if (in_array("hapus", $current_data_navigasi))
                                                                <a
                                                                    href="#"
                                                                    class="dropdown-item btn-delete"
                                                                    data-id="{{ $item->id }}">
                                                                        <i class="fas fa-minus-circle pr-1"></i> Hapus
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
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

{{-- modal create --}}
<div class="modal fade modal-create" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Loker</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_cabang_id" class="form-label">Nama Cabang</label>
                        <select name="create_cabang_id" id="create_cabang_id" class="form-control select2">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="create_lokasi" id="create_lokasi" class="form-control" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="create_jabatan_id" class="form-label">Nama Jabatan</label>
                        <select name="create_jabatan_id" id="create_jabatan_id" class="form-control select2">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_img" class="form-label">Gambar</label>
                        <input type="file" name="create_img" id="create_img" class="form-control">
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

{{-- modal edit --}}
<div class="modal fade modal-edit" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-edit">
                <input type="hidden" id="edit_id" name="edit_id">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Loker</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_cabang_id" class="form-label">Nama Cabang</label>
                        <select name="edit_cabang_id" id="edit_cabang_id" class="form-control select2">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="edit_lokasi" id="edit_lokasi" class="form-control" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="edit_jabatan_id" class="form-label">Nama Jabatan</label>
                        <select name="edit_jabatan_id" id="edit_jabatan_id" class="form-control select2">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_img" class="form-label">Ganti Gambar</label>
                        <input type="file" name="edit_img" id="edit_img" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-edit-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog modal-dialog-centered">
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

{{-- modal detail --}}
<div class="modal fade modal-detail" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-detail">
                <div class="modal-body">
                    <img src="" alt="" class="detail_img" style="max-width: 100%;">
                </div>
            </form>
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
<!-- Select2 -->
<script src="{{ asset('public/themes/plugins/select2/js/select2.full.min.js') }}"></script>

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

        // publish
        $('input[name="index[]"]').on('change', function() {
            var id = $(this).attr('data-id');
            var formData;

            var id = $(this).attr('data-id');
            var url = '{{ route("loker.publish", ":id") }}';
            url = url.replace(':id', id );

            if($('#index_' + id).is(":checked")) {
                formData = {
                    id: id,
                    show: "y"
                }
            } else {
                formData = {
                    id: id,
                    show: "n"
                }
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan.'
                    });
                }
            });
        });

        // create
        $('#btn-create').on('click', function() {
            $.ajax({
                type: "get",
                url: "{{ URL::route('loker.create') }}",
                success: function (response) {
                    var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
                    $.each(response.cabangs, function (index, value) {
                        value_cabang += "<option value=\"" + value.id + "\">" + value.nama_cabang + "</option>";
                    });
                    $('#create_cabang_id').append(value_cabang);

                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                        value_jabatan += "<option value=\"" + value.id + "\">" + value.nama_jabatan + "</option>";
                    });
                    $('#create_jabatan_id').append(value_jabatan);

                    $('.modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_jabatan_id').focus();

            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-create")
            });
        });

        $('#form-create').submit(function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                url: "{{ URL::route('loker.store') }}",
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
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // edit
        $('body').on('click', '.btn-edit', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("loker.edit", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#edit_id').val(response.loker.id);
                    $('#edit_lokasi').val(response.loker.lokasi);

                    var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
                    $.each(response.cabangs, function (index, value) {
                        value_cabang += "<option value=\"" + value.id + "\"";
                        if (value.id == response.loker.cabang_id) {
                            value_cabang += " selected";
                        }
                        value_cabang += ">" + value.nama_cabang + "</option>";
                    });
                    $('#edit_cabang_id').append(value_cabang);

                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                        value_jabatan += "<option value=\"" + value.id + "\"";
                        if (value.id == response.loker.jabatan_id) {
                            value_jabatan += " selected";
                        }
                        value_jabatan += ">" + value.nama_jabatan + "</option>";
                    });
                    $('#edit_jabatan_id').append(value_jabatan);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $(document).on('shown.bs.modal', '.modal-edit', function() {
            $('#edit_jabatan_id').focus();

            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-edit")
            });
        });

        $('#form-edit').submit(function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-edit')[0]);

            $.ajax({
                url: "{{ URL::route('loker.update') }}",
                type: 'post',
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
                    var errorMessage = xhr.status + ': ' + error

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
            var url = '{{ route("loker.delete_btn", ":id") }}';
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
                url: "{{ URL::route('loker.delete') }}",
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

        // detail
        $(document).on('click', '.btn-img', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("loker.show", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "get",
                success: function (response) {
                    console.log(response);
                    $('.detail_img').prop("src", "{{ URL::to('') }}" + "/public/file/loker/" + response.loker.image);
                    $('.modal-detail').modal('show');
                }
            })
        })
    });
</script>

@endsection
