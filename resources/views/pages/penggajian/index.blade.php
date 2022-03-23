@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

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
					<h5>Data Approval Penggajian</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Approval Penggajian</li>
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
                        @if (Auth::user()->masterKaryawan->masterJabatan->id != 1)
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button class="btn btn-primary btn-create"><i class="fa fa-plus"></i></button>
                                </h3>
                            </div>
                        @endif
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Nama Karyawan</th>
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
											<td>{{ $item->karyawan->nama_lengkap }}</td>
											<td>{{ $item->judul }}</td>
											<td class="text-center">
                                                @if ($item->tanggal_upload != null)
                                                    {{ date('d-m-Y', strtotime($item->tanggal_upload)) }}
                                                @else
                                                    Kosong
                                                @endif
                                            </td>
											<td class="text-center">
                                                <a href="{{ url('../storage/app/file/' . $item->file) }}" class="text-primary"><i class="fas fa-download"></i> {{ $item->file }}</a>
                                            </td>
											<td class="text-center">
												@if ($item->status == 1)
													<span class="text-success font-weight-bold p-2 rounded">Menunggu Persetujuan</span>
												@elseif ($item->status == 2)
                                                    <span class="text-primary font-weight-bold p-2 rounded">Disetujui</span>
                                                    <br>
													<img src="{{ asset('assets/img/ttd.png') }}" alt="img-ttd" style="max-width: 50px;">
												@elseif ($item->status == 3)
                                                    <span class="text-danger font-weight-bold p-2 rounded">Ditolak</span>
                                                    <br>
                                                    <span>
                                                        @if ($item->alasan)
                                                            {{ $item->alasan }}
                                                        @endif
                                                    </span>
												@else

												@endif
											</td>
                                            <td class="text-center">
                                                @if (Auth::user()->masterKaryawan->masterJabatan->id == 1 && $item->status == 1)
                                                    <a href="{{ route('penggajian.approve', [$item->id]) }}"
                                                        type="button"
                                                        class="btn btn-primary btn-approve"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Approve"
                                                        data-id="{{ $item->id }}">
                                                            Approve
                                                    </a> |
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-reject"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Tolak"
                                                        data-id="{{ $item->id }}">
                                                            Tolak
                                                    </button>
                                                @elseif (Auth::user()->masterKaryawan->masterJabatan->id == 1 && $item->status != 1)
                                                -
                                                @elseif ($item->status == 2 || $item->status == 3)
                                                -
                                                @else
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-delete"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Hapus"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fas fa-trash"></i>
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
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
            <div class="progress m-2">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <div id="uploadStatus"></div>
        </div>
    </div>
</div>


{{-- modal delete  --}}
<div class="modal fade modal-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_delete">

                {{-- id  --}}
                <input type="hidden" id="delete_id" name="delete_id">

                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus ?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary text-center" data-dismiss="modal" style="width: 100px;">Tidak</button>
                    <button type="submit" class="btn btn-primary text-center" style="width: 100px;">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal reject  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-reject">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-reject">

                {{-- id --}}
                <input type="hidden" id="reject_id" name="reject_id">

                <div class="modal-header">
                    <h5 class="modal-title">Alasan Ditolak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reject_alasan">Alasan:</label>
                        <textarea class="form-control" id="reject_alasan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal proses berhasil  --}}
<div class="modal fade modal-proses" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                Proses sukses.... <i class="fas fa-check" style="color: #32a893;"></i>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')


<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('.progress').hide();

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
                $('.progress').show();
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
                        $(".progress-bar").width('100%');
                        $('#uploadStatus').html('<p class=\"m-2\">Berhasil Upload</p>');
                    },
                    success: function(response) {
                        setTimeout(() => {
                            window.location.reload(1);
                        }, 100);
                    }
                });
            }
        });

        // btn delete click
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).attr('data-id');

            $('#delete_id').val(id);
            $('.modal-delete').modal('show');
        });

        // form delete submit
        $('#form_delete').submit(function(e) {
            e.preventDefault();

            $('.modal-delete').modal('hide');

            var formData = {
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('penggajian.delete') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('.modal-proses').modal('show');
                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });

        // btn reject click
        $('.btn-reject').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            $('#reject_id').val(id);
            $('#modal-reject').modal('show');
        });

        // form reject submit
        $('#form-reject').submit(function(e) {
            e.preventDefault();
            $('#modal-reject').hide();

            var formData = {
                id: $('#reject_id').val(),
                alasan: $('#reject_alasan').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('penggajian.reject') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('.modal-proses').modal('show');
                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        });
    });
</script>

@endsection
