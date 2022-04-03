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
                    <h1>Karyawan Akses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan Akses</li>
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
                                @if (count($syncs) != 0)
                                        {{ $karyawan->nama_lengkap }}
                                        <button class="btn btn-success btn-sm btn-sync-spinner" disabled style="width: 120px; display: none;">
                                            <span class="spinner-grow spinner-grow-sm"></span>
                                            Loading..
                                        </button>
                                        <button class="btn btn-success btn-sm btn-sync" data-id="{{ $karyawan->id }}" style="width: 120px"><i class="fa fa-refresh"></i> Sync</button>
                                @else
                                    {{ $karyawan->nama_lengkap }}
                                @endif
                            </h3>
                            <div class="card-tools mr-0">
                                <a href="{{ route('user.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">Main</th>
                                        <th class="text-center text-indigo">Sub</th>
                                        <th class="text-center text-indigo">Index</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subs as $key => $item)
                                        <tr>
                                            <td rowspan="{{ $item->total }}">{{ $item->navMain->title }}</td>
                                            @foreach ($menus as $item_menu)
                                                @if ($item_menu->main_id == $item->main_id)
                                                        <td>
                                                            @if ($item_menu->navSub->link != '#')
                                                                {{ $item_menu->navSub->title }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="index[]" id="index_{{ $item_menu->id }}" data-id="{{ $item_menu->id }}" value="{{ $item_menu->tampil }}" {{ $item_menu->tampil == "y" ? 'checked' : '' }}>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
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
<!-- AdminLTE App -->
<script src="{{ asset('public/themes/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/themes/dist/js/demo.js') }}"></script>
<!-- Page specific script -->

<script>
    $(function () {
        $("#example1").DataTable({
            'responsive': true
        });
    });

    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        // index
        $('input[name="index[]"]').on('change', function() {
            var id = $(this).attr('data-id');
            var formData;

            var id = $(this).attr('data-id');
            var url = '{{ route("user.access_save", ":id") }}';
            url = url.replace(':id', id );

            if($('#index_' + id).is(":checked")) {
                formData = {
                    id: id,
                    show: "y",
                    _token: CSRF_TOKEN
                }
            } else {
                formData = {
                    id: id,
                    show: "n",
                    _token: CSRF_TOKEN
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

        // sync
        $('.btn-sync').on('click', function() {
            var formData = {
                id: $(this).attr('data-id'),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('user.sync') }}",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-sync-spinner').css("display", "inline-block");
                    $('.btn-sync').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil sinkron.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    });
</script>

@endsection
