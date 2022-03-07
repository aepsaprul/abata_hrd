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
                    <h1>Lamaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lamaran</li>
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
                                        <th class="text-center text-indigo">Posisi</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamarans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                @if ($item->masterJabatan)
                                                    {{ $item->masterJabatan->nama_jabatan }}
                                                @else
                                                    Kosong
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->status_lamaran == 1)
                                                    @php
                                                        $status = "Persyaratan Masuk";
                                                        $percentase = "20%";
                                                        $background = "secondary";
                                                    @endphp
												@elseif ($item->status_lamaran == 2)
                                                    @php
                                                        $status = "Mengisi Form Rekrutmen";
                                                        $percentase = "40%";
                                                        $background = "info";
                                                    @endphp
												@elseif ($item->status_lamaran == 3)
                                                    @php
                                                        $status = "Form Rekrutmen Telah Diisi";
                                                        $percentase = "60%";
                                                        $background = "primary";
                                                    @endphp
												@elseif ($item->status_lamaran == 4)
                                                    @php
                                                        $status = "Gagal Interview";
                                                        $percentase = "100%";
                                                        $background = "danger";
                                                    @endphp
												@elseif ($item->status_lamaran == 5)
                                                    @php
                                                        $status = "Lanjut Interview";
                                                        $percentase = "80%";
                                                        $background = "warning";
                                                    @endphp
												@elseif ($item->status_lamaran == 6)
                                                    @php
                                                        $status = "Gagal";
                                                        $percentase = "100%";
                                                        $background = "danger";
                                                    @endphp
												@elseif ($item->status_lamaran == 7)
                                                    @php
                                                        $status = "Terima";
                                                        $percentase = "100%";
                                                        $background = "success";
                                                    @endphp
												@else
                                                    @php
                                                        $status = "-";
                                                        $percentase = "0%";
                                                        $background = "transparent";
                                                    @endphp
												@endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percentase }}">
                                                            <span class="">{{ $percentase }}</span>
                                                    </div>
                                                </div>
                                                <span> {{ $status }} </span>
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
                                                        @if ($item->status_lamaran == 1)
															@php $nomor_telepon =  substr($item->telepon, 1,13); @endphp
															    <a
                                                                    href="https://api.whatsapp.com/send?phone=+62{{ $nomor_telepon }}&text=Terima kasih dokumen lamaran anda sudah kami terima. Silahkan login kembali pada website untuk mengisi formulir data diri.
                                                                    Silahkan klik link untuk menuju ke halaman login website : https://abata-printing.com/loker/" target="_blank" class="dropdown-item border-bottom">
                                                                        <i class="fas fa-comment text-center mr-2" style="width: 20px;"></i> WA
                                                                </a>
															    <a
                                                                    href="{{ route('lamaran.rekrutmen', [$item->id]) }}"
                                                                    class="dropdown-item border-bottom">
                                                                        <i class="fas fa-angle-double-right text-center mr-2" style="width: 20px;"></i> Lanjut
                                                                </a>
														@elseif ($item->status_lamaran == 2)
															<a
                                                                href="{{ route('lamaran.rekrutmen', [$item->id]) }}"
                                                                class="dropdown-item border-bottom">
                                                                    <i class="fas fa-angle-double-right text-center mr-2" style="width: 20px;"></i> Lanjut
                                                            </a>
														@elseif ($item->status_lamaran == 3)
														    @php $nomor_telepon =  substr($item->telepon, 1,13); @endphp
														        <a
                                                                    href="https://api.whatsapp.com/send?phone=+62{{ $nomor_telepon }}&text=Terima kasih dokumen lamaran anda sudah kami terima. Silahkan login kembali pada website untuk mengisi formulir data diri.
                                                                    Silahkan klik link untuk menuju ke halaman login website : https://abata-printing.com/loker/" target="_blank" class="dropdown-item border-bottom">
                                                                        <i class="fas fa-comment text-center mr-2" style="width: 20px;"></i> WA
                                                                </a>
															<a
                                                                href="{{ route('lamaran.gagal.interview', [$item->id]) }}"
                                                                class="dropdown-item border-bottom">
                                                                    <i class="fas fa-ban text-center mr-2" style="width: 20px;"></i> Gagal Interview
                                                            </a>
															<a
                                                                href="{{ route('lamaran.interview', [$item->id]) }}"
                                                                class="dropdown-item border-bottom">
                                                                    <i class="fas fa-angle-double-right text-center mr-2" style="width: 20px;"></i> Lanjut Interview
                                                            </a>
														@elseif ($item->status_lamaran == 5)
															<a
                                                                href="{{ route('lamaran.gagal', [$item->id]) }}"
                                                                class="dropdown-item border-bottom">
                                                                    <i class="fas fa-ban text-center mr-2" style="width: 20px;"></i> Gagal
                                                            </a>
															<a
                                                                href="{{ route('lamaran.terima', [$item->id]) }}"
                                                                class="dropdown-item border-bottom">
                                                                    <i class="fas fa-check text-center mr-2" style="width: 20px;"></i> Terima
                                                            </a>
														@else
														@endif
														<a
                                                            href="{{ route('lamaran.show', [$item->id]) }}"
                                                            class="dropdown-item border-bottom"
                                                            title="view">
                                                                <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Detail
                                                        </a>
														<a
                                                            href="{{ route('lamaran.delete', [$item->id]) }}"
                                                            class="dropdown-item"
                                                            onclick="return confirm('Yakin akan dihapus?')"
                                                            title="hapus">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<div class="modal fade modal-create" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_nama" class="form-label">Nama Cabang</label>
                        <input type="text"
                            class="form-control form-control-sm"
                            id="create_nama"
                            name="create_nama"
                            maxlength="30"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner-create" disabled style="width: 130px; display: none;">
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

<div class="modal fade modal-edit" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-edit">
                <input type="hidden" id="edit_id" name="edit_id">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Cabang</label>
                        <input type="text"
                            class="form-control form-control-sm"
                            id="edit_nama"
                            name="edit_nama"
                            maxlength="30"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner-edit" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Perbaharui
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#btn-create').on('click', function() {
            $('.modal-create').modal('show');
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_nama').focus();
        });

        $('#form-create').submit(function (e) {
            e.preventDefault();

            var formData = {
                nama: $('#create_nama').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('cabang.store') }}",
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.btn-spinner-create').css('display', 'inline-block');
                    $('.btn-create-save').css('display', 'none');
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
                    var errorMessage = xhr.status + ': ' + statusText

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
            var url = '{{ route("cabang.edit", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nama').val(response.nama);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $('#form-edit').submit(function (e) {
            e.preventDefault();

            var formData = {
                nama: $('#edit_nama').val(),
                _token: CSRF_TOKEN
            }

            var id = $('#edit_id').val();
            var url = '{{ route("cabang.update", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                beforeSend: function () {
                    $('.btn-spinner-edit').css("display", "block");
                    $('.btn-edit-save').css("display", "none");
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
                    var errorMessage = xhr.status + ': ' + xhar.statusText

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
            var url = '{{ route("cabang.delete_btn", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id,
                _token: CSRF_TOKEN
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
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('cabang.delete') }}",
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
