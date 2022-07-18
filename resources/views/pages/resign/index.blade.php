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
                    <h1>Data Resign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Resign</li>
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
                                    <a href="{{ route('resign.create') }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </h3>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Karyawan</th>
                                        <th class="text-center text-indigo">Lokasi Kerja</th>
                                        <th class="text-center text-indigo">Tanggal Masuk</th>
                                        <th class="text-center text-indigo">Tanggal Keluar</th>
                                        <th class="text-center text-indigo">Approver</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resigns as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                {{ $item->masterKaryawan ? $item->masterKaryawan->nama_panggilan : '' }}
                                                @if ($item->approved_percentage >= 100)
                                                    @if ($item->status == 1)
                                                        <span class="float-right">
                                                            <a href="{{ route('resign.paklaring', [$item->masterKaryawan->id]) }}" target="_blank">
                                                                <i class="fas fa-download ml-2"></i> Paklaring
                                                            </a>
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $item->lokasi_kerja }}</td>
                                            <td class="text-center">{{ $item->tanggal_masuk }}</td>
                                            <td class="text-center">{{ $item->tanggal_keluar }}</td>
                                            <td>
                                                <div class="row">
                                                    @foreach ($item->resignDetail as $item_resign_detail)
                                                        <div class="col-6">
                                                            <div class="text-center border-top border-left border-right">
                                                                @php
                                                                    $atasan = preg_replace("/[^0-9\,]/", "", $item_resign_detail->atasan);
                                                                    $atasan_replace = str_replace(",","/",$atasan);
                                                                    $atasan_explode = explode("/", $atasan_replace);
                                                                @endphp
                                                                @foreach ($atasan_explode as $key => $item_atasan)
                                                                    @foreach ($karyawans as $item_karyawan)
                                                                        @if ($item_karyawan->id == $item_atasan)
                                                                            @if (count($atasan_explode) > 1)
                                                                                @if ($key === array_key_last($atasan_explode))
                                                                                    {{ $item_karyawan->masterDivisi->nama }}
                                                                                {{-- @else
                                                                                    {{ $item_karyawan->nama_panggilan }} / --}}
                                                                                @endif
                                                                            @else
                                                                                {{ $item_karyawan->masterJabatan->nama_jabatan }} - {{ $item_karyawan->masterCabang->nama_cabang }}
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <div class="text-center border p-2">
                                                                <div>
                                                                    @php
                                                                        $karyawan_id = Auth::user()->master_karyawan_id;
                                                                    @endphp
                                                                    @if ($item_resign_detail->confirm == 1)
                                                                        <span class="bg-success px-2">Approved</span><br><br>
                                                                        <span>{{ $item_resign_detail->approvedLeader->nama_lengkap }}</span>
                                                                    @elseif ($item_resign_detail->confirm == 2)
                                                                        <span class="bg-danger px-2">Disapproved</span><br><br>
                                                                        <span>{{ $item_resign_detail->approvedLeader->nama_lengkap }}</span>
                                                                    @else
                                                                        @if (preg_match("/\b$karyawan_id\b/i", $atasan, ))
                                                                            <button class="btn btn-sm btn-primary btn-resign-approve" style="width: 40px;" data-id="{{ $item_resign_detail->id }}"><i class="fas fa-check"></i></button>
                                                                            <button class="btn btn-primary btn-sm btn-resign-approve-spinner d-none" disabled>
                                                                                <span class="spinner-grow spinner-grow-sm"></span>
                                                                            </button>
                                                                            <button class="btn btn-sm btn-danger btn-resign-disapprove" style="width: 40px;" data-id="{{ $item_resign_detail->id }}"><i class="fas fa-times"></i></button>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if (in_array("detail", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                                                            @if (in_array("detail", $current_data_navigasi))
                                                                <a
                                                                    href="{{ route('resign.show', [$item->id]) }}" class="dropdown-item btn-detail text-indigo"
                                                                    data-id="{{ $item->id }}">
                                                                        <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                                </a>
                                                            @endif
                                                            @if (in_array("hapus", $current_data_navigasi))
                                                                <a
                                                                    href="#"
                                                                    class="dropdown-item btn-delete text-indigo"
                                                                    data-id="{{ $item->id }}">
                                                                        <i class="fas fa-trash text-center mr-2" style="width: 20px;"></i> Hapus
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

        // btn approve resign
        $(document).on('click', '.btn-resign-approve', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("resign.resign_approved", ":id") }}';
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
            let url = '{{ route("resign.resign_disapproved", ":id") }}';
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

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("resign.delete_btn", ":id") }}';
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
                url: "{{ URL::route('resign.delete') }}",
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
