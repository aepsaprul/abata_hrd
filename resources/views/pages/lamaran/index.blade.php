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
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ $item->biodata->nama_lengkap }}</td>
                                            <td>{{ $item->biodata->telepon }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">{{ $item->status }}</td>
                                            <td class="text-center">
                                                @if (in_array("whatsapp", $current_data_navigasi) || in_array("interview", $current_data_navigasi) || in_array("gagal", $current_data_navigasi) || in_array("detail", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                                                            @php $nomor_telepon =  substr($item->biodata->telepon, 1,13); @endphp

                                                            @if ($item->status == "cek berkas")
                                                                @if (in_array("whatsapp", $current_data_navigasi))
                                                                    <a
                                                                        href="https://api.whatsapp.com/send?phone=+62{{ $nomor_telepon }}&text=Terima kasih atas lamarannya, berkas anda sudah kami terima dan sedang kami cek." target="_blank"
                                                                        class="dropdown-item border-bottom"
                                                                        title="view">
                                                                            <i class="fas fa-comment text-center mr-2" style="width: 20px;"></i> Whatsapp
                                                                    </a>
                                                                @endif
                                                                @if (in_array("interview", $current_data_navigasi))
                                                                    <a
                                                                        href="{{ route('lamaran.interview', [$item->id]) }}"
                                                                        class="dropdown-item border-bottom"
                                                                        title="view">
                                                                            <i class="fas fa-check text-center mr-2" style="width: 20px;"></i> Interview
                                                                    </a>
                                                                @endif
                                                                @if (in_array("gagal", $current_data_navigasi))
                                                                    <a
                                                                        href="{{ route('lamaran.gagal', [$item->id]) }}"
                                                                        class="dropdown-item border-bottom"
                                                                        title="view">
                                                                            <i class="fas fa-times text-center mr-2" style="width: 20px;"></i> Gagal
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            @if (in_array("detail", $current_data_navigasi))
                                                                <a
                                                                    href="{{ route('lamaran.show', [$item->email]) }}"
                                                                    class="dropdown-item border-bottom"
                                                                    title="view">
                                                                        <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Detail
                                                                </a>
                                                            @endif
                                                            @if (in_array("hapus", $current_data_navigasi))
                                                                <a
                                                                    href="{{ route('lamaran.delete', [$item->id]) }}"
                                                                    class="dropdown-item"
                                                                    onclick="return confirm('Yakin akan dihapus?')"
                                                                    title="hapus">
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
