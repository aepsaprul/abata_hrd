@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5>Data Persetujuan</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Persetujuan</li>
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
            @if (in_array("tambah", $current_data_navigasi) || in_array("approver", $current_data_navigasi))
              <div class="card-header">
                <h3 class="card-title">
                  @if (in_array("tambah", $current_data_navigasi))
                    <a href="{{ route('persetujuan.create') }}" class="btn btn-primary btn-sm" style="width: 130px;"><i class="fa fa-plus"></i> Tambah</a>                      
                  @endif
                  @if (in_array("approver", $current_data_navigasi))
                    <a href="{{ route('persetujuan.approver') }}" class="btn btn-warning btn-sm" style="width: 130px;"><i class="fas fa-user"></i> Approver</a>
                  @endif
                </h3>
            </div>
            @endif
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Judul</th>
									<th class="text-center">Pemohon</th>
									<th class="text-center">Sifat</th>
									<th class="text-center">Lampiran</th>
                  <th class="text-center">Approver</th>
                  @if (in_array("hapus", $current_data_navigasi))
                    <th class="text-center">Aksi</th>
                  @endif
								</tr>
								</thead>
								<tbody>
									@foreach ($persetujuans as $key => $item)
										<tr>
											<td class="text-center">{{ $key + 1 }}</td>
                      <td><a href="{{ route('persetujuan.show', [$item->id]) }}">{{ $item->judul }}</a></td>
                      <td>{{ $item->pemohon }}</td>
                      <td>{{ $item->sifat }}</td>
                      <td><a href="{{ url(env('APP_URL_IMG') . 'img_persetujuan/' . $item->lampiran) }}" target="_blank">Lampiran</a></td>
                      <td>
                        <div class="row">
                          @foreach ($item->pengajuanApprover as $approver)
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                              <div class="text-center border-top border-left border-right">
                                @php
                                  $atasan = preg_replace("/[^0-9\,]/", "", $approver->atasan);
                                  $atasan_replace = str_replace(",","/",$atasan);
                                  $atasan_explode = explode("/", $atasan_replace);
                                @endphp
                                @foreach ($atasan_explode as $key => $item_atasan)
                                  @foreach ($karyawans as $item_karyawan)
                                    @if ($item_karyawan->id == $item_atasan)
                                      @if (count($atasan_explode) > 1)
                                        @if ($key === array_key_last($atasan_explode))
                                          {{ $item_karyawan->masterDivisi->nama }}
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
                                  @if ($approver->confirm == 1)
                                    <span class="bg-success px-2">Approved</span><br>
                                    <span>{{ $approver->approvedLeader->nama_lengkap }}</span>
                                    <br>
                                    <span>{{ $approver->approved_keterangan }}</span>
                                  @elseif ($approver->confirm == 2)
                                    <span class="bg-danger px-2">Disapproved</span><br>
                                    <span>{{ $approver->approvedLeader->nama_lengkap }}</span>
                                    <br>
                                    <span>{{ $approver->approved_keterangan }}</span>
                                  @else
                                    @if (preg_match("/\b$karyawan_id\b/i", $atasan, ))
                                      <button class="btn btn-sm btn-primary btn-approve" style="width: 40px;" data-id="{{ $approver->id }}"><i class="fas fa-check"></i></button>
                                      <button class="btn btn-primary btn-sm btn-approve-spinner d-none" disabled>
                                          <span class="spinner-grow spinner-grow-sm"></span>
                                      </button>
                                      <button class="btn btn-sm btn-danger btn-disapprove" style="width: 40px;" data-id="{{ $approver->id }}"><i class="fas fa-times"></i></button>
                                    @else
                                      -
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          @endforeach
                          @if ($item->disposisi)
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                              <div class="text-center border">Disposisi</div>
                              <div class="border">{{ $item->disposisi }}</div>
                            </div>                              
                          @endif
                        </div>
                      </td>
                      @if (in_array("hapus", $current_data_navigasi))
                        <td class="text-center">
                          <a href="{{ route('persetujuan.delete', [$item->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Hapus" onclick="return confirm('Yakin akan dihapus?')"><i class="fa fa-trash-alt"></i></a>
                        </td>
                      @endif
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

<!-- modal approved -->
<div class="modal fade modal_approved" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_approved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Keterangan Approve</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="approved_id" id="approved_id">
          <div class="mb-3">
            <input type="text" name="approved_keterangan" id="approved_keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
          <div class="mb-3">
            <select name="disposisi" id="disposisi" class="form-control">
              <option value="">Pilih Disposisi (jika ada)</option>
              @foreach ($jabatans as $item)
                <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-approved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-approved-save" style="width: 130px;">
            <i class="fas fa-paper-plane"></i> Approved
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal disapproved -->
<div class="modal fade modal_disapproved" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_disapproved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Keterangan Disapprove</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="disapproved_id" id="disapproved_id">
          <div class="mb-3">
            <input type="text" name="disapproved_keterangan" id="disapproved_keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-disapproved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-disapproved-save" style="width: 130px;">
            <i class="fas fa-paper-plane"></i> Disapproved
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')


<!-- DataTables -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('#disposisi').select2({
      theme: 'bootstrap4'
    });

    $('[data-toggle="tooltip"]').tooltip()

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    // btn approve pengajuan
    $(document).on('click', '.btn-approve', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $('#approved_id').val(id);
      $('.modal_approved').modal('show');
    })

    $(document).on('submit', '#form_approved', function (e) {
      e.preventDefault();

      let formData = {
        id: $('#approved_id').val(),
        keterangan: $('#approved_keterangan').val(),
        disposisi: $('#disposisi').val()
      }

      $.ajax({
        url: "{{ URL::route('persetujuan.approved') }}",
        type: 'post',
        data: formData,
        beforeSend: function () {
          $('.btn-approved-spinner').removeClass('d-none');
          $('.btn-approved-save').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Pengajuan telah disetujui'
          });

          setTimeout( () => {
            $('.btn-approved-spinner').addClass('d-none');
            $('.btn-approved-save').removeClass('d-none');
            window.location.reload(1);
          }, 1000);
        }
      });
    });

    // btn disapprove
    $(document).on('click', '.btn-disapprove', function (e) {
      e.preventDefault();
      let id = $(this).attr('data-id');
      $('#disapproved_id').val(id);
      $('.modal_disapproved').modal('show');
    })

    $(document).on('submit', '#form_disapproved', function (e) {
      e.preventDefault();

      let formData = {
        id: $('#disapproved_id').val(),
        keterangan: $('#disapproved_keterangan').val()
      }

      $.ajax({
        url: "{{ URL::route('persetujuan.disapproved') }}",
        type: 'post',
        data: formData,
        beforeSend: function () {
          $('.btn-disapproved-spinner').removeClass('d-none');
          $('.btn-disapproved-save').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Pengajuan tidak disetujui'
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
