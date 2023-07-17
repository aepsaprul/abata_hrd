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
          <h1>Abata Peduli</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Abata Peduli</li>
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
              <div class="card-header">
                @if (in_array("tambah", $current_data_navigasi) || in_array("approver", $current_data_navigasi))
                  <h3 class="card-title">
                    @if (in_array("tambah", $current_data_navigasi))
                      <a href="{{ route('abdul.create') }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                        <i class="fas fa-plus"></i> Buat Pengajuan
                      </a>
                    @endif
                    @if (in_array("approver", $current_data_navigasi))
                      <a href="{{ route('abdul.approver') }}" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                        <i class="fas fa-user"></i> Approver
                      </a>
                    @endif
                  </h3>
                @endif
              </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Nama</th>
                    <th class="text-center text-indigo">Keperluan</th>
                    <th class="text-center text-indigo">Pinjaman</th>
                    <th class="text-center text-indigo">Bayar</th>
                    <th class="text-center text-indigo">Approver</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pengajuans as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td>{{ $item->karyawan ? $item->karyawan->nama_lengkap : $item->nama }}</td>
                      <td>{{ $item->keperluan }}</td>
                      <td class="text-right">{{ rupiah($item->pinjaman) }}</td>
                      <td>{{ $item->metode_bayar }}</td>
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
                                        {{-- @else
                                          {{ $item_karyawan->masterDivisi->nama }} / --}}
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
                        </div>
                      </td>
                      <td class="text-center">
                        @if (in_array("detail", $current_data_navigasi) || in_array("dokumen", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                                  href="{{ route('abdul.show', [$item->id]) }}"
                                  class="dropdown-item">
                                    <i class="fas fa-eye pr-1"></i> Detail
                                </a>
                              @endif
                              @if (in_array("dokumen", $current_data_navigasi))
                                @if($item->approved_percentage >= 100)
                                  <a
                                    href="{{ route('abdul.sp3', [$item->id]) }}"
                                    target="_blank"
                                    class="dropdown-item">
                                      <i class="fas fa-copy pr-1"></i> Dok SP3
                                  </a>
                                  <a
                                    href="{{ route('abdul.akad', [$item->id]) }}"
                                    target="_blank"
                                    class="dropdown-item">
                                      <i class="fas fa-copy pr-1"></i> Dok Akad
                                  </a>
                                @endif
                              @endif
                              @if (in_array("hapus", $current_data_navigasi))
                                <a
                                  href="#"
                                  class="dropdown-item btn-delete"
                                  data-id="{{ $item->id }}">
                                    <i class="fas fa-minus-circle pr-1"></i> Hapus
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

<!-- modal delete -->
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
        keterangan: $('#approved_keterangan').val()
      }

      $.ajax({
        url: "{{ URL::route('abdul.approved') }}",
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
        url: "{{ URL::route('abdul.disapproved') }}",
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

    // delete
    $('body').on('click', '.btn-delete', function (e) {
      e.preventDefault();

      var id = $(this).attr('data-id');
      
      $('#delete_id').val(id);
      $('.modal-delete').modal('show');
    });

    $('#form-delete').submit(function (e) {
      e.preventDefault();

      var formData = {
        id: $('#delete_id').val()
      }

      $.ajax({
        url: "{{ URL::route('abdul.delete') }}",
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
          var errorMessage = xhr.status + ': ' + error

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
