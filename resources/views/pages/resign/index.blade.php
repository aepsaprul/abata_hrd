@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Resign</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Resign</li>
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
            @if (in_array("tambah", $current_data_navigasi))
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('resign.create') }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                    <i class="fas fa-plus"></i> Tambah
                  </a>
                </h3>
              </div>
            @endif
            <div class="card-body">
              <table id="tabel_resign" class="table table-bordered" style="font-size: 13px;">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Karyawan</th>
                    <th class="text-center text-indigo">Cabang</th>
                    <th class="text-center text-indigo">Tgl Pengajuan</th>
                    <th class="text-center text-indigo">Tgl Keluar</th>
                    <th class="text-center text-indigo">Approver</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($resigns as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td>
                        @if ($item->masterKaryawan)
                          {{ $item->masterKaryawan->nama_panggilan }}
                          @if ($item->approved_percentage >= 100)
                            @if ($item->status == 1)
                              <span class="float-right">
                                <a href="{{ route('resign.paklaring', [$item->masterKaryawan->id]) }}" target="_blank">
                                  <i class="fas fa-download ml-2"></i> Paklaring
                                </a>
                              </span>
                            @endif
                          @endif

                          <br>
                          @if (file_exists(env('APP_URL_IMG') . 'image/' . $item->masterKaryawan->foto))
                            @if ($item->masterKaryawan->foto)
                              <center><img src="{{ asset(env('APP_URL_IMG') . 'image/' . $item->masterKaryawan->foto) }}" alt="img" style="max-width: 100px;"></center>
                            @endif
                          @endif
                        @endif
                      </td>
                      <td>{{ $item->lokasi_kerja }}</td>
                      <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                      <td class="text-center">{{ tgl_indo($item->tanggal_keluar) }}</td>
                      <td>
                        <div class="row">
                          @php $no = 0; @endphp
                          @foreach ($item->resignDetail as $resign_detail)
                            @if ($resign_detail->hirarki ==  $no)
                              @php continue; @endphp
                            @endif
                            @php $no = $resign_detail->hirarki; @endphp
                            @if ($resign_detail->dataAtasan)
                              <div class="col">
                                <table style="border: 1px solid #aaa; width: 100%;">
                                  <tr style="border: 1px solid #aaa;">
                                    <th id="approver_title" colspan="2" class="text-center" role="button" data-status="{{ $item->id }}" data-hirarki="{{ $resign_detail->hirarki }}">Approver {{ $resign_detail->hirarki }} <i id="approver_title" data-status="{{ $item->id }}" data-hirarki="{{ $resign_detail->hirarki }}" class="fas fa-eye"></i></th>
                                  </tr>
                                  <tr style="border: 1px solid #aaa;">
                                    @if ($resign_detail->status == "1")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-check text-success" data-id="{{ $resign_detail->id }}"></i></th>
                                    @elseif ($resign_detail->status == "0")
                                      <th class="text-center" style="border: 1px solid #aaa;"><i class="fas fa-times text-danger" data-id="{{ $resign_detail->id }}"></i></th>
                                    @else
                                      @foreach ($item->resignDetail as $resign_detail_2)
                                        @if ($resign_detail_2->dataAtasan->id == Auth::user()->master_karyawan_id && $resign_detail_2->hirarki == $resign_detail->hirarki)
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_approved" class="btn btn-sm btn-success my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $resign_detail->hirarki }}" style="width: 40px;"><i id="btn_approved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $resign_detail->hirarki }}" class="fas fa-check"></i></button></th>
                                          <th class="text-center" style="border: 1px solid #aaa;"><button id="btn_disapproved" class="btn btn-sm btn-danger my-1" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $resign_detail->hirarki }}" style="width: 40px;"><i id="btn_disapproved" data-status="{{ $item->id }}" data-confirm="{{ Auth::user()->master_karyawan_id }}" data-hirarki="{{ $resign_detail->hirarki }}" class="fas fa-times"></i></button></th>
                                        @endif
                                      @endforeach
                                    @endif
                                  </tr>
                                  @if ($resign_detail->approved_keterangan)
                                    <tr style="border: 1px solid #aaa;">
                                      <th style="border: 1px solid #aaa;">{{ $resign_detail->approved_keterangan }}</th>
                                    </tr>
                                  @endif
                                </table>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </td>
                      <td class="text-center">
                        @if (in_array("detail", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                              @if (in_array("detail", $current_data_navigasi))
                                <a
                                  href="{{ route('resign.show', [$item->id]) }}" class="dropdown-item btn-detail text-indigo"
                                  data-id="{{ $item->id }}">
                                    <i class="fa fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                                </a>
                              @endif
                              @if (in_array("hapus", $current_data_navigasi))
                                <a
                                  href="#"
                                  class="dropdown-item btn-delete text-indigo"
                                  data-id="{{ $item->id }}">
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

{{-- modal approved --}}
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
          <input type="hidden" name="status" id="status">
          <input type="hidden" name="confirm" id="confirm">
          <input type="hidden" name="hirarki" id="hirarki">
          <div class="mb-3">
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-approved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-success btn-approved-save" style="width: 130px;">
            <i class="fas fa-paper-plane"></i> Approved
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal disapproved --}}
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
          <input type="hidden" name="status" id="status">
          <input type="hidden" name="confirm" id="confirm">
          <input type="hidden" name="hirarki" id="hirarki">
          <div class="mb-3">
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="kosongkan bila tidak ada">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-disapproved-spinner d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-danger btn-disapproved-save" style="width: 130px;">
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

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
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
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#tabel_resign").DataTable({
      'responsive': true
    });
  });
  
  $(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#tabel_resign').on('click', function (e) {
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
          url: "{{ route('resign.detailApprover') }}",
          type: "post",
          data: formData,
          success: function(response) {
            let val = ``;
            $.each(response.resign_detail, function(index, item) {
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
        keterangan: $('#modal_approved #keterangan').val()
      }

      $.ajax({
        url: "{{ route('resign.approved') }}",
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
        keterangan: $('#modal_disapproved #keterangan').val()
      }

      $.ajax({
        url: "{{ route('resign.disapproved') }}",
        type: "post",
        data: formData,
        success: function(response) {
          window.location.reload();
        }
      })
    })

    // btn approve resign
    $(document).on('click', '.btn-resign-approve', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = '{{ route("resign.resign_approved", ":id") }}';
      url = url.replace(':id', id);

      let formData = {
        id: id
      }

      $.ajax({
        url: url,
        type: 'GET',
        data: formData,
        beforeSend: function () {
          $('.btn-resign-approve-spinner').removeClass('d-none');
          $('.btn-resign-approve').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Resign telah disetujui'
          });

          setTimeout( () => {
            window.location.reload(1);
          }, 1000);
        }
      });
    });

    // btn disapprove resign
    $(document).on('click', '.btn-resign-disapprove', function (e) {
      e.preventDefault();

      let id = $(this).attr('data-id');
      let url = '{{ route("resign.resign_disapproved", ":id") }}';
      url = url.replace(':id', id);

      let formData = {
        id: id
      }

      $.ajax({
        url: url,
        type: 'GET',
        data: formData,
        beforeSend: function () {
          $('.btn-resign-approve-spinner').removeClass('d-none');
          $('.btn-resign-disapprove').addClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Resign tidak disetujui'
          });

          setTimeout( () => {
            window.location.reload(1);
          }, 1000);
        }
      });
    });

    // delete
    $('body').on('click', '.btn-delete', function (e) {
      e.preventDefault();

      var id = $(this).attr('data-id');
      var url = '{{ route("resign.delete_btn", ":id") }}';
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
        url: "{{ URL::route('resign.delete') }}",
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
