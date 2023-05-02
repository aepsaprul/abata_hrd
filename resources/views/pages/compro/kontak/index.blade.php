@extends('layouts.app')

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kontak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kontak</li>
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
            {{-- @if (in_array("tambah", $current_data_navigasi)) --}}
              <div class="card-header">
                <form action="{{ route('compro.kontak.store') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <label for="create_grup">Grup</label>
                        <select name="create_grup" id="create_grup" class="form-control" required>
                          <option value="">--Pilih Grup--</option>
                          <option value="abata">Abata</option>
                          <option value="adaya">Adaya</option>
                          <option value="utakatik">Utak atik</option>
                          <option value="wahana">Wahana</option>
                          <option value="makzon">Makzon</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <label for="create_icon">Icon</label>
                        <input type="text" name="create_icon" id="create_icon" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <label for="create_title">Title</label>
                        <input type="text" name="create_title" id="create_title" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="create_deskripsi">Deskripsi</label>
                        <textarea id="summernote" name="create_deskripsi" id="create_deskripsi" cols="30" rows="3" class="form-control" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 mt-3">
                      <button type="submit" id="btn-simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            {{-- @endif --}}
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Grup</th>
                    <th class="text-center text-indigo">Icon</th>
                    <th class="text-center text-indigo">Title</th>
                    <th class="text-center text-indigo">Deskripsi</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kontaks as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td>{{ $item->grup }}</td>
                      <td>{!! $item->icon !!}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->deskripsi }}</td>
                      <td class="text-center">
                        {{-- @if (in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
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
                              {{-- @if (in_array("ubah", $current_data_navigasi)) --}}
                                <a
                                  href="{{ route('compro.kontak.edit', [$item->id]) }}"
                                  class="dropdown-item border-bottom btn-edit">
                                    <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                </a>
                              {{-- @endif --}}
                              {{-- @if (in_array("hapus", $current_data_navigasi)) --}}
                              <a
                                href="#"
                                class="dropdown-item btn-delete"
                                data-id="{{ $item->id }}">
                                  <i class="fas fa-trash pr-1"></i> Hapus
                              </a>
                              {{-- @endif --}}
                            </div>
                          </div>
                        {{-- @endif --}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <table id="tabel-kontak-form" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center text-indigo">No</th>
                    <th class="text-center text-indigo">Grup</th>
                    <th class="text-center text-indigo">Nama</th>
                    <th class="text-center text-indigo">Email</th>
                    <th class="text-center text-indigo">Subjek</th>
                    <th class="text-center text-indigo">Pesan</th>
                    <th class="text-center text-indigo">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kontak_forms as $item)
                    <tr>
                      <td class="text-center">{{ $item->id }}</td>
                      <td>{{ $item->grup }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->subjek }}</td>
                      <td>{{ $item->pesan }}</td>
                      <td class="text-center">
                        {{-- @if (in_array("ubah", $current_data_navigasi) || in_array("hapus", $current_data_navigasi)) --}}
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
                              {{-- @if (in_array("hapus", $current_data_navigasi)) --}}
                              <a
                                href="#"
                                class="dropdown-item btn-delete-pesan"
                                data-id="{{ $item->id }}">
                                  <i class="fas fa-trash-alt pr-1"></i> Hapus
                              </a>
                              {{-- @endif --}}
                            </div>
                          </div>
                        {{-- @endif --}}
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
  <div class="modal-dialog modal-dialog-centered">
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

{{-- modal delete pesan --}}
<div class="modal fade modal-delete-pesan" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form-delete-pesan">
        <input type="hidden" id="pesan_delete_id" name="pesan_delete_id">
        <div class="modal-header">
          <h5 class="modal-title">Yakin akan dihapus?</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
          <button class="btn btn-primary btn-delete-spinner-pesan d-none" disabled style="width: 130px;">
            <span class="spinner-grow spinner-grow-sm"></span>
            Loading...
          </button>
          <button type="submit" class="btn btn-primary btn-delete-yes-pesan text-center" style="width: 130px;">
            Ya
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<!-- Summernote -->
<script src="{{ asset('public/themes/plugins/summernote/summernote-bs4.js') }}"></script>
<script>
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

    // Summernote
    $('#summernote').summernote()

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
        url: "{{ URL::route('compro.kontak.delete') }}",
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

    // delete pesan
    $('body').on('click', '.btn-delete-pesan', function (e) {
      e.preventDefault();

      var id = $(this).attr('data-id');
      
      $('#pesan_delete_id').val(id);
      $('.modal-delete-pesan').modal('show');
    });

    $('#form-delete-pesan').submit(function (e) {
      e.preventDefault();

      var formData = {
        id: $('#pesan_delete_id').val()
      }

      $.ajax({
        url: "{{ URL::route('compro.kontak.form.delete') }}",
        type: 'POST',
        data: formData,
        beforeSend: function () {
          $('.btn-delete-spinner-pesan').removeClass('d-none');
          $('.btn-delete-yes-pesan').addClass('d-none');
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
