@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<style>
    .content-header,
    .content,
    .content button,
    .content a {
        font-size: 12px;
    }
	table thead tr th {
		text-align: center;
	}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5>Data Penggajian</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Penggajian</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
                        @if (in_array("tambah", $current_data_navigasi))
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button class="btn btn-primary btn-create"><i class="fa fa-plus"></i> Tambah</button>
                                </h3>
                            </div>
                        @endif
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Karyawan</th>
									<th>Keterangan</th>
									<th>Tanggal Upload</th>
                                    <th>File</th>
									<th>Status</th>
                                    <th>Aksi</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($penggajians as $key => $item)
										<tr>
											<td class="text-center">{{ $key + 1 }}</td>
											<td>
                                                @if ($item->masterKaryawan)
                                                    {{ $item->masterKaryawan->nama_lengkap }}
                                                @endif
                                            </td>
											<td>{{ $item->judul }}</td>
											<td class="text-center">
                                                @if ($item->tanggal_upload != null)
                                                    {{ date('d-m-Y', strtotime($item->tanggal_upload)) }}
                                                @else
                                                    Kosong
                                                @endif
                                            </td>
											<td class="text-center">
                                                <a href="{{ url('public/file/pengajuan/' . $item->file) }}" class="text-primary"><i class="fas fa-download"></i> {{ $item->file }}</a>
                                            </td>
											<td>
												@if ($item->approved_percentage >= 100)
                                                    @if ($item->alasan)
                                                        <span>
                                                            <span>Disapproved: {{ $item->alasan }}</span>
                                                        </span>
                                                    @else
                                                        <div class="text-center mt-2">
                                                            @if ($item->approvedLeader)
                                                                <img src="{{ url('public/assets/' . $item->approvedLeader->ttd) }}" alt="ttd" style="max-width: 50px;">
                                                            @endif
                                                        </div>
                                                    @endif
                                                @else
                                                    @foreach ($penggajian_details as $key => $item_detail)
                                                        @if ($item_detail->penggajian_id == $item->id)
                                                            <button class="btn btn-primary btn-sm btn-approve-spinner d-none" disabled>
                                                                <span class="spinner-grow spinner-grow-sm"></span>
                                                            </button>
                                                            <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $item_detail->id }}" title="Approved"><i class="fas fa-check"></i></button>
                                                            <button class="btn btn-sm btn-danger btn-disapprove" style="width: 40px;" data-id="{{ $item_detail->id }}" title="Disapproved"><i class="fas fa-times"></i></button>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                {{-- <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $item->approved_background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percent }}%;">
                                                            <span class="">{{ $percent }}%</span>
                                                    </div>
                                                </div> --}}

											</td>
                                            <td class="text-center">
                                                @if (in_array("hapus", $current_data_navigasi))
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-delete"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Hapus"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fa fa-trash-alt"></i>
                                                    </button>
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

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('penggajian.store') }}" id="form-create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-judul">Pengajuan</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="baru">Baru</option>
                            <option value="revisi">Revisi</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create-judul">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    @php
                                        $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        $jml_bulan = count($nama_bulan);
                                        $nomor_bulan = date('n') - 1;
                                    @endphp

                                    @for ($i = 0; $i < $jml_bulan; $i++)
                                        <option value="{{ $nama_bulan[$i] }}"

                                        @if ($i == $nomor_bulan)
                                            {{ "selected" }}
                                        @endif

                                        >{{ $nama_bulan[$i] }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create-judul">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    @php $date = date('Y'); @endphp
                                    @for ($i = 2021; $i <= 2040; $i++)
                                        <option value="{{ $i }}"

                                        @if ($i == $date)
                                            {{ "selected" }}
                                        @endif

                                        >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create-file">File</label>
                        <input type="file" class="form-control-file" id="create-file" name="create_file">
                        <span class="notif font-italic text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                </div>
            </form>
            <div id="progress" class="progress m-2">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <div id="uploadStatus"></div>
        </div>
    </div>
</div>

{{-- modal alasan --}}
<div class="modal fade modal-alasan" tabindex="-1" role="dialog" id="modal-default">
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
    </div>
</div>

@endsection

@section('script')


<!-- DataTables -->
<script src="{{ asset('public/themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('[data-toggle="tooltip"]').tooltip()
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

        $('#progress').hide();

        // btn create click
        $('.btn-create').on('click', function() {
            $('#modal-create').modal('show');
        });

        // form create submit
        $('#form-create').submit(function(e) {
            e.preventDefault();

            if ($('#create-file').val() == "") {
                $('.notif').append("File harus diisi !!!");
            } else {
                $('#progress').show();
                var form = this;

                $.ajax({
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if(e.lengthComputable) {
                                console.log('Byte Loaded: ' + e.loaded);
                                console.log('Total Size: ' + e.total);
                                console.log('Percenage Upload:' + (e.loaded / e.total));

                                var percent = Math.round((e.loaded / e.total) * 100);

                                $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%')
                            }
                        });

                        return xhr;
                    },
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function(){
                        $('.btn-spinner').removeClass('d-none');
                        $('.btn-save').addClass('d-none');
                        $(".progress-bar").width('100%');
                        $('#uploadStatus').html('<p class=\"m-2\">File Siap</p>');
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Upload berhasil'
                        });

                        setTimeout(() => {
                            window.location.reload(1);
                        }, 100);
                    }
                });
            }
        });

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("penggajian.delete_btn", ":id") }}';
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
                url: "{{ URL::route('penggajian.delete') }}",
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
                    var errorMessage = xhr.status + ': ' + xhar.statusText

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // btn approve
        $(document).on('click', '.btn-approve', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let url = '{{ route("penggajian.approved", ":id") }}';
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
                url: "{{ URL::route('penggajian.disapproved') }}",
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
