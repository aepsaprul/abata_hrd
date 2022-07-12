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
                    <h1>Cuti</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cuti</li>
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
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Jenis Cuti</th>
                                        {{-- <th class="text-center text-indigo">Status</th> --}}
                                        <th class="text-center text-indigo">Approver</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cutis as $key => $item)
                                        <tr>
                                            <td class="text-center" width="30px">{{ $key + 1 }}</td>
                                            <td width="150px">{{ $item->masterKaryawan->nama_lengkap }}</td>
                                            <td width="150px">{{ $item->jenis }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @foreach ($item->cutiDetail as $item_cuti_detail)
                                                        <div class="col-4">
                                                            <div class="text-center border">
                                                                @php
                                                                    $atasan = preg_replace("/[^0-9\,]/", "", $item_cuti_detail->atasan);
                                                                    $atasan_replace = str_replace(",","/",$atasan);
                                                                    $atasan_explode = explode("/", $atasan_replace);
                                                                @endphp
                                                                @foreach ($atasan_explode as $key => $item_atasan)
                                                                    @foreach ($karyawans as $item_karyawan)
                                                                        @if ($item_karyawan->id == $item_atasan)
                                                                            @if (count($atasan_explode) > 1)
                                                                                @if ($key === array_key_last($atasan_explode))
                                                                                    {{ $item_karyawan->nama_panggilan }}
                                                                                @else
                                                                                    {{ $item_karyawan->nama_panggilan }} /
                                                                                @endif
                                                                            @else
                                                                            {{ $item_karyawan->nama_panggilan }}
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
                                                                    @if ($item_cuti_detail->confirm == 1)
                                                                        <span class="bg-success px-2">Approved</span>
                                                                    @elseif ($item_cuti_detail->confirm == 2)
                                                                        <span class="bg-danger px-2">Disapproved</span>
                                                                    @else
                                                                        @if (preg_match("/\b$karyawan_id\b/i", $atasan, ))
                                                                            <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $item_cuti_detail->id }}"><i class="fas fa-check"></i></button>
                                                                            <button class="btn btn-primary btn-sm btn-approve-spinner d-none" disabled>
                                                                                <span class="spinner-grow spinner-grow-sm"></span>
                                                                            </button>
                                                                            <button class="btn btn-sm btn-danger btn-disapprove" style="width: 40px;" data-id="{{ $item_cuti_detail->id }}"><i class="fas fa-times"></i></button>
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
                                            {{-- <td>
                                                @if ($item->approved_percentage > 100)
                                                    @php
                                                        $percent = 100;
                                                    @endphp
                                                @else
                                                    @if ($item->approved_percentage == null)
                                                        @php
                                                            $percent = 0;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $percent = $item->approved_percentage;
                                                        @endphp
                                                    @endif
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
                                            </td> --}}
                                            <td class="text-center" width="70px">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="alasan">Alasan Cuti (Secara Lebih Detail)</label>
                        <input type="text" name="alasan" id="alasan" class="form-control" readonly>
                    </div>
                </div>
            </div>
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
            let url = '{{ route("cuti.approved", ":id") }}';
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
            let url = '{{ route("cuti.disapproved", ":id") }}';
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

        // detail
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
    });
</script>

@endsection
