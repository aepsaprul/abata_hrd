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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (in_array("tambah", $current_data_navigasi))
                            <div class="card-header">
                                <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            @if ($item->masterKaryawan)
                                                {{ $item->masterKaryawan->nama_lengkap }}
                                            @else
                                                {{ $item->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->masterKaryawan)
                                                {{ $item->masterKaryawan->masterJabatan->nama_jabatan }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->masterKaryawan)
                                                {{ $item->masterKaryawan->email }}
                                            @else
                                                {{ $item->email }}
                                            @endif
                                        </td>
                                        <td style="width: 150px;">
                                            @if ($item->masterKaryawan)
                                                {{ $item->masterKaryawan->masterCabang->nama_cabang }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if (in_array("akses", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
                                                    <a
                                                        class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if (in_array("akses", $current_data_navigasi))
                                                            <a
                                                                href="#"
                                                                class="dropdown-item text-indigo btn-access"
                                                                data-id="{{ $item->id }}">
                                                                    <i class="fas fa-lock pr-1"></i> Akses
                                                            </a>
                                                        @endif
                                                        @if (in_array("hapus", $current_data_navigasi))
                                                            @if ($item->master_karyawan_id != 0)
                                                                <a
                                                                    class="dropdown-item text-indigo btn-delete"
                                                                    href="#"
                                                                    data-id="{{ $item->user_id }}">
                                                                        <i class="fa fa-trash-alt pr-1"></i> Hapus
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
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
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{-- modal create  --}}
<div class="modal fade modal-create" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_create">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_karyawan_id" class="form-label">Nama Karyawan</label>
                        <select name="create_karyawan_id" id="create_karyawan_id" class="form-control select2bs4">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-create-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal access --}}
<div class="modal fade modal-access" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-access">

                {{-- karyawan id --}}
                <input type="hidden" name="access_karyawan_id" id="access_karyawan_id">

                <div class="modal-body">
                    <table id="datatable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center text-indigo">Main</th>
                                <th class="text-center text-indigo">Sub</th>
                                <th class="text-center text-indigo">Button</th>
                                <th class="text-center text-indigo">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="data_navigasi">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-access-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-access-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete  --}}
<div class="modal fade modal-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_delete">

                {{-- id  --}}
                <input type="hidden" id="delete_id" name="delete_id">

                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="delete_title text-decoration-underline"></span> ?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">Ya</button>
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
        $("#example1").DataTable({
            'responsive': true
        });
    });

    $(document).ready(function() {
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

        // create
        $('#button-create').on('click', function() {
            $('#create_karyawan_id').empty();
            $.ajax({
                url: '{{ URL::route('user.create') }}',
                type: 'GET',
                success: function (response) {
                    var value_karyawan = "<option value=\"0\">--Pilih Karyawan--</option>";

                    $.each(response.karyawans, function (index, item) {
                        value_karyawan += "<option value=\"" + item.id + "\">" + item.nama_lengkap + " - " + item.master_cabang.nama_cabang + "</option>";
                    });
                    $('#create_karyawan_id').append(value_karyawan);

                    $('.modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_karyawan_id').focus();

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-create")
            });
        });

        $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                karyawan_id: $('#create_karyawan_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('user.store') }} ',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-create-spinner').css("display", "block");
                    $('.btn-create-save').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + error
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // access
        $(document).on('click', '.btn-access', function(e) {
            e.preventDefault();
            $('#data_navigasi').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("user.access", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "get",
                success: function (response) {
                    $('#access_karyawan_id').val(response.karyawan_id);

                    let val_navigasi = '';
                    $.each(response.nav_mains, function (index, iteme) {
                        val_navigasi += '' +
                            '<tr>' +
                                '<td rowspan="' + iteme.navigasi_button.length + '" style="padding: 5px;">' + iteme.title + '</td>';
                                $.each(iteme.navigasi_sub, function (index, item) {
                                    val_navigasi += '' +
                                        '<td rowspan="' + item.navigasi_button.length + '" style="padding: 5px;">';
                                            if (item.title != iteme.title) {
                                                val_navigasi += item.title;
                                            }
                                    val_navigasi += '</td>';
                                    $.each(item.navigasi_button, function (index, item_nav_button) {
                                        val_navigasi += '' +
                                            '<td style="padding: 5px;">' +
                                                item_nav_button.title +
                                            '</td>' +
                                            '<td class="text-center" style="padding: 5px;">' +
                                                '<input type="checkbox" id="button_check_ ' + item_nav_button.id + '" name="button_check[]" value="' + item_nav_button.id + '"';
                                                $.each(response.nav_access, function (index, item_nav_access) {
                                                    if (item_nav_access.button_id == item_nav_button.id) {
                                                        val_navigasi += ' checked';
                                                    }
                                                })
                                                val_navigasi += '>' +
                                            '</td>' +
                                        '</tr>';
                                    })
                                    val_navigasi += '</tr>';
                                })
                                val_navigasi += '</tr>';
                    })
                    $('#data_navigasi').append(val_navigasi);

                    $('.modal-access').modal('show');
                }
            })
        });

        $(document).on('submit', '#form-access', function (e) {
            e.preventDefault();

            let val_check = [];
            $('input[name="button_check[]"]:checked').each(function() {
                data_check = this.value;
                val_check.push(data_check);
            });

            let formData = {
                data_navigasi: val_check,
                karyawan_id: $('#access_karyawan_id').val()
            }

            $.ajax({
                url: "{{ URL::route('user.access_store') }}",
                type: "post",
                data: formData,
                beforeSend: function () {
                    $('.btn-access-spinner').removeClass('d-none');
                    $('.btn-access-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan'
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
            })
        })

        // delete
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            $('#delete_id').val($(this).attr('data-id'));
            $('.modal-delete').modal('show');
        });

        $('#form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('user.delete') }}',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-delete-spinner').css("display", "block");
                    $('.btn-delete-yes').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + error
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
