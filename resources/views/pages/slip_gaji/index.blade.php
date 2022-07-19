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
                    <h1>Slip Gaji</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Slip Gaji</li>
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
                        @if (in_array("import_file", $current_data_navigasi) || in_array("download_template", $current_data_navigasi) || in_array("update_template", $current_data_navigasi))
                            <div class="card-header">
                                <div class="row">
                                    @if (in_array("import_file", $current_data_navigasi))
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <button type="button" class="btn bg-gradient-primary btn-sm btn-block" data-toggle="modal" data-target="#importExcel">
                                                <i class="fas fa-file-upload mr-1"></i> Import File
                                            </button>
                                        </div>
                                    @endif
                                    @if (in_array("download_template", $current_data_navigasi))
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <a href="{{ route('slip_gaji.export') }}" id="btn-create" class="btn bg-gradient-success btn-sm btn-block">
                                                <i class="fas fa-file-download mr-1"></i> Download Template
                                            </a>
                                        </div>
                                    @endif
                                    @if (in_array("update_template", $current_data_navigasi))
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <a href="{{ route('slip_gaji.update_template') }}" class="btn bg-gradient-warning btn-sm btn-block">
                                                <i class="fas fa-pencil-alt mr-1"></i> Update Template
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Tahun</th>
                                        <th class="text-center text-indigo">Bulan</th>
                                        <th class="text-center text-indigo">Periode</th>
                                        {{-- <th class="text-center text-indigo">Berkas</th> --}}
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slips as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $item->tahun }}</td>
                                            <td class="text-center text-uppercase">{{ $item->bulan }}</td>
                                            <td class="text-center text-uppercase">{{ $item->periode }}</td>
                                            {{-- <td class="text-center">
                                                <a href="{{ route('slip_gaji.cetak_pdf', [$item->id]) }}" target="_blank">Lihat Berkas</a>
                                            </td> --}}
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
                                                            href="{{ route('slip_gaji.cetak_pdf', [$item->id]) }}"
                                                            class="dropdown-item text-indigo"
                                                            target="_blank">
                                                                <i class="fas fa-archive text-center mr-2" style="width: 20px;"></i> Lihat Berkas
                                                        </a>
                                                        <a
                                                            href="{{ route('slip_gaji.cetak_pdf_karyawan', [$item->id]) }}"
                                                            class="dropdown-item text-indigo btn-detail"
                                                            target="_blank">
                                                                <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-edit text-indigo"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                                                        </a>
                                                        <a
                                                            href="{{ route('slip_gaji.delete', [$item->id]) }}"
                                                            class="dropdown-item btn-delete text-indigo"
                                                            onclick="return confirm('Yakin akan dihapus?')">
                                                                <i class="fas fa-trash-alt text-center mr-2" style="width: 20px;"></i> Hapus
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


<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('slip_gaji.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Pilih file excel</label>
                            <input type="file" name="file" required="required">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" id="tahun" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Bulan</label>
                            <input type="text" name="bulan" id="bulan" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Periode</label>
                            <input type="text" name="periode" id="periode" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- edit -->
<div class="modal fade modal-edit" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-edit" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Slip Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="edit_id" id="edit_id">

                    <div class="mb-3">
                        <label for="edit_tahun" class="form-label">Tahun</label>
                        <input type="text"
                            class="form-control form-control-sm"
                            id="edit_tahun"
                            name="edit_tahun"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_bulan" class="form-label">Bulan</label>
                        <input type="text"
                            class="form-control form-control-sm"
                            id="edit_bulan"
                            name="edit_bulan"
                            maxlength="10"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_periode" class="form-label">Periode</label>
                        <input type="text"
                            class="form-control form-control-sm"
                            id="edit_periode"
                            name="edit_periode"
                            maxlength="50"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-edit-spinner d-none" disabled style="width: 130px;">
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

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();

        $('#edit_tahun').empty();
        $('#edit_bulan').empty();
        $('#edit_periode').empty();
        $('#edit_berkas').val(null);
        $('#edit_berkas').hide();

        let id = $(this).attr('data-id');
        let url = '{{ route("slip_gaji.edit", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
                $('#edit_id').val(response.slip.id);
                $('#edit_tahun').val(response.slip.tahun);
                $('#edit_bulan').val(response.slip.bulan);
                $('#edit_periode').val(response.slip.periode);

                $('.modal-edit').modal('show');
            }
        })
    })

    $('#edit_berkas').hide();

    $(document).on('click', '#ganti', function (e) {
        e.preventDefault();
        $('#edit_berkas').show();
    })

    $(document).on('submit', '#form-edit', function (e) {
        e.preventDefault();

        let formData = new FormData($('#form-edit')[0]);

        $.ajax({
            url: "{{ URL::route('slip_gaji.update') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.btn-edit-spinner').removeClass('d-none');
                $('.btn-edit-save').addClass('d-none');
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
        })
    })
});
</script>

@endsection
