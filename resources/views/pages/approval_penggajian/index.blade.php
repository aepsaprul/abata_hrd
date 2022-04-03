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
                    <h1>Approval Penggajian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Approval Penggajian</li>
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

                    {{-- penggajian --}}
                    <div class="card">
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Karyawan</th>
                                        <th class="text-center text-indigo">Keterangan</th>
                                        <th class="text-center text-indigo">Tanggal Upload</th>
                                        <th class="text-center text-indigo">File</th>
                                        <th class="text-center text-indigo">Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penggajian_details as $key => $item)
                                        @if ($item->hirarki > 1 && $item->status == 0)
                                        @else
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $item->penggajian->masterKaryawan->nama_lengkap }}</td>
                                                <td>{{ $item->penggajian->judul }}</td>
                                                <td>{{ $item->penggajian->tanggal_upload }}</td>
                                                <td><a href="{{ url('file/pengajuan/' . $item->penggajian->file) }}" class="text-primary"><i class="fas fa-download"></i> {{ $item->penggajian->file }}</a></td>
                                                <td class="text-center">
                                                    @if ($item->confirm == 1)
                                                        <span class="bg-success px-2">Approved</span>
                                                    @elseif ($item->confirm == 2)
                                                        <span class="bg-danger px-2">Disapproved</span>
                                                    @else
                                                        <button class="btn btn-primary btn-sm btn-approve-spinner d-none" disabled>
                                                            <span class="spinner-grow spinner-grow-sm"></span>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $item->id }}" title="Approved"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" style="width: 40px;" data-id="{{ $item->id }}" title="Disapproved"><i class="fas fa-times"></i></button>
                                                    @endif
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

{{-- modal alasan --}}
<div class="modal fade modal-alasan" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-alasan">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan Ditolak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <textarea name="alasan" id="alasan" cols="10" rows="3" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-alasan-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-alasan-save" style="width: 130px;">
                        <i class="fas fa-paper-plane"></i> Submit
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
        $("#example1").DataTable({
            paging: false,
            searching: false
        });
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
            let url = '{{ route("approval_penggajian.approved", ":id") }}';
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
                        title: 'Penggajian telah disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });

        // btn disapprove
        $(document).on('click', '.btn-disapprove', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');

            $('#id').val(id);

            $('.modal-alasan').modal('show');
        });

        $('#form-alasan').submit(function(e) {
            e.preventDefault();

            let formData = {
                id: $('#id').val(),
                alasan: $('#alasan').val()
            }

            $.ajax({
                url: "{{ URL::route('approval_penggajian.disapproved') }}",
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.btn-alasan-spinner').removeClass('d-none');
                    $('.btn-alasan-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Penggajian tidak disetujui'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });
    });
</script>

@endsection
