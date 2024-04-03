@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.css') }}">
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
                </h3>
            </div>
            @endif
						<div class="card-body">
							<table id="tabel_persetujuan" class="table table-bordered table-striped">
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
                          @php $no = 0; @endphp
                          @foreach ($item->persetujuanDetail as $persetujuan_detail)
                            @if ($persetujuan_detail->hirarki ==  $no)
                              @php continue; @endphp
                            @endif
                            @php $no = $persetujuan_detail->hirarki; @endphp
                            @if ($persetujuan_detail->dataAtasan)
                              <div class="col">
                                <table style="border: 1px solid #aaa; width: 100%;">
                                  <tr style="border: 1px solid #aaa;">
                                    <th id="approver_title" colspan="2" class="text-center" role="button" data-status="{{ $item->id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}">Approver {{ $persetujuan_detail->hirarki }} <i id="approver_title" data-status="{{ $item->id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}" class="fas fa-eye"></i></th>
                                  </tr>
                                  <tr style="border: 1px solid #aaa;">
                                    @if ($persetujuan_detail->status == "1")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-check text-success" data-id="{{ $persetujuan_detail->id }}"></i></th>
                                    @elseif ($persetujuan_detail->status == "0")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-times text-danger" data-id="{{ $persetujuan_detail->id }}"></i></th>
                                    @else
                                      @foreach ($item->persetujuanDetail as $persetujuan_detail_2)
                                        @if ($persetujuan_detail_2->dataAtasan->id == Auth::user()->master_karyawan_id && $persetujuan_detail_2->hirarki == $persetujuan_detail->hirarki)
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_approved" class="btn btn-sm btn-success my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}" style="width: 40px;"><i id="btn_approved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}" class="fas fa-check"></i></button></th>
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_disapproved" class="btn btn-sm btn-danger my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}" style="width: 40px;"><i id="btn_disapproved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $persetujuan_detail->hirarki }}" class="fas fa-times"></i></button></th>
                                        @endif
                                      @endforeach
                                    @endif
                                  </tr>
                                  @if ($persetujuan_detail->approved_keterangan)
                                    <tr style="border: 1px solid #aaa;">
                                      <th style="border: 1px solid #aaa;">{{ $persetujuan_detail->approved_keterangan }}</th>
                                    </tr>
                                  @endif
                                </table>
                              </div>
                            @endif
                          @endforeach
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
<div id="modal_approved" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_approved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Approved</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" name="status" id="status">
          <input type="text" name="confirm" id="confirm">
          <input type="text" name="hirarki" id="hirarki">
          <div class="mb-3">
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
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
<div id="modal_disapproved" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form_disapproved" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Disapproved</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" name="status" id="status">
          <input type="text" name="confirm" id="confirm">
          <input type="text" name="hirarki" id="hirarki">
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

{{-- modal approver detail --}}
<div id="modal_approver_detail" class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div id="data_approver"></div>
            </div>
          </div>
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

    $("#tabel_persetujuan").DataTable({
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

    $('#tabel_persetujuan').on('click', function (e) {
      const id = e.target.getAttribute('id');
      const dataStatus = e.target.dataset.status;
      const dataConfirm = e.target.dataset.confirm;
      const dataHirarki = e.target.dataset.hirarki;

      if (!id) return;

      if (id == "btn_approved") {
        $('#modal_approved #status').val(dataStatus);
        $('#modal_approved #confirm').val(dataConfirm);
        $('#modal_approved #hirarki').val(dataHirarki);
        $('#modal_approved').modal('show');
      }

      if (id == "btn_disapproved") {
        $('#modal_disapproved #status').val(dataStatus);
        $('#modal_disapproved #confirm').val(dataConfirm);
        $('#modal_disapproved #hirarki').val(dataHirarki);
        $('#modal_disapproved').modal('show');
      }

      if(id == "approver_title") {
        $('#modal_approver_detail #data_approver').empty();

        let formData = {
          id: dataStatus,
          hirarki: dataHirarki
        }

        $.ajax({
          url: "{{ route('persetujuan.detailApprover') }}",
          type: "post",
          data: formData,
          success: function(response) {
            let val = ``;
            $.each(response.persetujuan_detail, function(index, item) {
              val += `
                <div class="row">
                  <div class="col">`;
                  if (item.confirm == 1) {
                    val += `<span class="text-primary">${item.data_atasan.nama_lengkap}</span>`;
                  } else {
                    val += `<span>${item.data_atasan.nama_lengkap}</span>`;
                  }
                  val += `</div>
                </div>
              `;
            })
            $('#modal_approver_detail #data_approver').append(val);
            $('#modal_approver_detail').modal('show');
          }
        })
      }
    })

    $('#form_approved').submit(function(e) {
      e.preventDefault();
      let formData = {
        status: $('#modal_approved #status').val(),
        confirm: $('#modal_approved #confirm').val(),
        hirarki: $('#modal_approved #hirarki').val(),
        keterangan: $('#modal_approved #keterangan').val(),
        disposisi: $('#modal_approved #disposisi').val()
      }

      $.ajax({
        url: "{{ route('persetujuan.approved') }}",
        type: "post",
        data: formData,
        success: function(response) {
          window.location.reload();
        }
      })
    })

    $('#form_disapproved').submit(function(e) {
      e.preventDefault();
      let formData = {
        status: $('#modal_disapproved #status').val(),
        confirm: $('#modal_disapproved #confirm').val(),
        hirarki: $('#modal_disapproved #hirarki').val(),
        keterangan: $('#modal_disapproved #keterangan').val(),
        disposisi: $('#modal_disapproved #disposisi').val()
      }

      $.ajax({
        url: "{{ route('persetujuan.disapproved') }}",
        type: "post",
        data: formData,
        success: function(response) {
          window.location.reload();
        }
      })
    })

    // btn approve pengajuan
    // $(document).on('click', '.btn-approve', function (e) {
    //   e.preventDefault();
    //   let id = $(this).attr('data-id');
    //   $('#approved_id').val(id);
    //   $('.modal_approved').modal('show');
    // })

    // $(document).on('submit', '#form_approved', function (e) {
    //   e.preventDefault();

    //   let formData = {
    //     id: $('#approved_id').val(),
    //     keterangan: $('#approved_keterangan').val(),
    //     disposisi: $('#disposisi').val()
    //   }

    //   $.ajax({
    //     url: "{{ URL::route('persetujuan.approved') }}",
    //     type: 'post',
    //     data: formData,
    //     beforeSend: function () {
    //       $('.btn-approved-spinner').removeClass('d-none');
    //       $('.btn-approved-save').addClass('d-none');
    //     },
    //     success: function (response) {
    //       Toast.fire({
    //         icon: 'success',
    //         title: 'Pengajuan telah disetujui'
    //       });

    //       setTimeout( () => {
    //         $('.btn-approved-spinner').addClass('d-none');
    //         $('.btn-approved-save').removeClass('d-none');
    //         window.location.reload(1);
    //       }, 1000);
    //     }
    //   });
    // });

    // btn disapprove
    // $(document).on('click', '.btn-disapprove', function (e) {
    //   e.preventDefault();
    //   let id = $(this).attr('data-id');
    //   $('#disapproved_id').val(id);
    //   $('.modal_disapproved').modal('show');
    // })

    // $(document).on('submit', '#form_disapproved', function (e) {
    //   e.preventDefault();

    //   let formData = {
    //     id: $('#disapproved_id').val(),
    //     keterangan: $('#disapproved_keterangan').val()
    //   }

    //   $.ajax({
    //     url: "{{ URL::route('persetujuan.disapproved') }}",
    //     type: 'post',
    //     data: formData,
    //     beforeSend: function () {
    //       $('.btn-disapproved-spinner').removeClass('d-none');
    //       $('.btn-disapproved-save').addClass('d-none');
    //     },
    //     success: function (response) {
    //       Toast.fire({
    //         icon: 'success',
    //         title: 'Pengajuan tidak disetujui'
    //       });

    //       setTimeout( () => {
    //         window.location.reload(1);
    //       }, 1000);
    //     }
    //   });
    // });
  });
</script>

@endsection
