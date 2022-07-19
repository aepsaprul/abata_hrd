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
                    <h1>Update Template</h1>
                </div>
                <div class="col-sm-6">

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
                        <div class="card-header">
                            <h3 class="card-title">
                                <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fa fa-plus"></i> Tambah</button>
                            </h3>
                            <div class="card-tools mr-0">
                                <a href="{{ route('slip_gaji.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slips as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                @if ($item->karyawan)
                                                    {{ $item->karyawan->nama_lengkap }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->hirarki_cabang == 1) Wahana Satria
                                                @elseif ($item->hirarki_cabang == 2) Abata Situmpur
                                                @elseif ($item->hirarki_cabang == 3) Abata Cilacap
                                                @elseif ($item->hirarki_cabang == 4) Abata Purbalingga
                                                @elseif ($item->hirarki_cabang == 5) Adaya Berkah Mulia
                                                @elseif ($item->hirarki_cabang == 6) Abata Dukuh Waluh
                                                @elseif ($item->hirarki_cabang == 7) Abata HR
                                                @elseif ($item->hirarki_cabang == 8) Utak Atik
                                                @elseif ($item->hirarki_cabang == 9) Makzon
                                                @elseif ($item->hirarki_cabang == 10) Abata Bumiayu
                                                @elseif ($item->hirarki_cabang == 11) Abasoft
                                                @elseif ($item->hirarki_cabang == 12) Head Office
                                                @else Head Office
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a
                                                    href="#"
                                                    class="btn btn-sm btn-danger btn-delete"
                                                    title="hapus"
                                                    data-id="{{ $item->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                </a>
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
                    <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;"><i class="fa fa-save"></i> Simpan</button>
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
                    <button class="btn btn-primary btn-delete-spinner d-none" disabled style="width: 130px;">
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

    $('#datatable').DataTable();

    // create
    $('#button-create').on('click', function() {
        $('#create_karyawan_id').empty();
        $.ajax({
            url: "{{ URL::route('slip_gaji.update_template.create') }}",
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
            karyawan_id: $('#create_karyawan_id').val()
        }

        $.ajax({
            url: "{{ URL::route('slip_gaji.update_template.store') }} ",
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('.btn-create-spinner').removeClass("d-none");
                $('.btn-create-save').addClass("d-none");
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

    // delete
    $('body').on('click', '.btn-delete', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#delete_id').val(id);
        $('.modal-delete').modal('show');
    });

    $('#form-delete').submit(function (e) {
        e.preventDefault();

        var formData = {
            id: $('#delete_id').val()
        }

        $.ajax({
            url: "{{ URL::route('slip_gaji.update_template.delete') }}",
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('.btn-delete-spinner').removeClass('d-none');
                $('.btn-delete-yes').addClass('d-none');
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
