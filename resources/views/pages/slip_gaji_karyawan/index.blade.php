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
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Tahun</th>
                                        <th class="text-center text-indigo">Bulan</th>
                                        <th class="text-center text-indigo">Periode</th>
                                        <th class="text-center text-indigo">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slips as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $item->tahun }}</td>
                                            <td class="text-center text-uppercase">{{ $item->bulan }}</td>
                                            <td class="text-center text-uppercase">{{ $item->periode }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn-detail">Detail</a>
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

{{-- modal show --}}
<div class="modal fade modal-show" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-show" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Slip Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row border-bottom mb-3">
                                <div class="col"><h5 class="text-uppercase float-left">pt haehoe cemerlang mulia</h5></div>
                                <div class="col"><h5 class="text-uppercase float-right">slip gaji mei 2022</h5></div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2">NIP</label>
                                        <div class="col-sm-10 border-bottom">
                                          <span>12345678</span>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2">NIP</label>
                                        <div class="col-sm-10 border-bottom">
                                          <span>12345678</span>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2">NIP</label>
                                        <div class="col-sm-10 border-bottom">
                                          <span>12345678</span>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    $(document).on('click', '.btn-detail', function (e) {
        e.preventDefault();

        $('.modal-show').modal('show');
    })
});
</script>

@endsection
