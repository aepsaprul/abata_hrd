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
          <h1>Cabang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Cabang</li>
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
            @if (in_array("tambah", $current_data_navigasi))
              <div class="card-header">
                <h3 class="card-title">
                  <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                    <i class="fas fa-plus"></i> Tambah
                  </button>
                </h3>
              </div>
            @endif
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Nama Cabang</th>
                    <th class="text-center text-indigo">Alias</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cabangs as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td>{{ $item->nama_cabang }}</td>
                      <td>{{ $item->alias }}</td>
                      <td class="text-center">
                        @if (in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi))
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
                              @if (in_array("ubah", $current_data_navigasi))
                                <a
                                  href="#"
                                  class="dropdown-item btn-edit"
                                  data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                </a>
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


<!-- modal create -->
<div class="modal fade modal-create" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form-create">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Cabang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="create_nama" class="form-label">Nama Cabang</label>
            <input type="text" class="form-control form-control-sm" id="create_nama" name="create_nama" maxlength="30" required>
          </div>
          <div class="mb-3">
            <label for="create_alias" class="form-label">Alias</label>
            <input type="text" class="form-control form-control-sm" id="create_alias" name="create_alias" maxlength="30" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-spinner-create" disabled style="width: 130px; display: none;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal edit -->
<div class="modal fade modal-edit" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form-edit">
        <input type="hidden" id="edit_id" name="edit_id">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Data Cabang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_nama" class="form-label">Nama Cabang</label>
            <input type="text" class="form-control form-control-sm" id="edit_nama" name="edit_nama" maxlength="30" required>
          </div>
          <div class="mb-3">
            <label for="edit_alias" class="form-label">Nama Alias</label>
            <input type="text" class="form-control form-control-sm" id="edit_alias" name="edit_alias" maxlength="30" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary btn-spinner-edit" disabled style="width: 130px; display: none;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;">
            <i class="fas fa-save"></i> Perbaharui
          </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
  $(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#btn-create').on('click', function() {
      $('.modal-create').modal('show');
    });

    $(document).on('shown.bs.modal', '.modal-create', function() {
      $('#create_nama').focus();
    });

    $('#form-create').submit(function (e) {
      e.preventDefault();

      var formData = {
        nama: $('#create_nama').val(),
        alias: $('#create_alias').val(),
        _token: CSRF_TOKEN
      }

      $.ajax({
        url: "{{ URL::route('cabang.store') }}",
        type: 'POST',
        data: formData,
        beforeSend: function () {
          $('.btn-spinner-create').css('display', 'inline-block');
          $('.btn-create-save').css('display', 'none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Data behasil ditambah'
          });

          setTimeout(() => {
            window.location.reload(1);
          }, 1000);
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + statusText

          Toast.fire({
            icon: 'danger',
            title: 'Error - ' + errorMessage
          });
        }
      });
    });

    // edit
    $('body').on('click', '.btn-edit', function (e) {
      e.preventDefault();

      var id = $(this).attr('data-id');
      var url = '{{ route("cabang.edit", ":id") }}';
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
          $('#edit_id').val(response.id);
          $('#edit_nama').val(response.cabang.nama_cabang);
          $('#edit_alias').val(response.cabang.alias);

          $('.modal-edit').modal('show');
        }
      })
    });

    $('#form-edit').submit(function (e) {
      e.preventDefault();

      var formData = {
        nama: $('#edit_nama').val(),
        alias: $('#edit_alias').val(),
        _token: CSRF_TOKEN
      }

      var id = $('#edit_id').val();
      var url = '{{ route("cabang.update", ":id") }}';
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: 'PUT',
        data: formData,
        beforeSend: function () {
          $('.btn-spinner-edit').css("display", "block");
          $('.btn-edit-save').css("display", "none");
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Data berhasil diperbaharui'
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
