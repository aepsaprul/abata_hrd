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
      <div class="row">
        <div class="col-sm-6">
          <h1>Materi {{ $modul->nama }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('training') }}">Training</a></li>
            <li class="breadcrumb-item"><a href="{{ route('training.moduls') }}">Modul</a></li>
            <li class="breadcrumb-item active">Materi</li>
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
              <div class="row">

                {{-- modul id --}}
                <input type="hidden" name="modul_id" id="modul_id" value="{{ $modul->id }}">

                <div class="col-md-4 col-12">
                  <label for="materi">Nama Materi</label>
                  <input type="text" name="materi" id="materi" class="form-control" placeholder="Nama Materi">
                </div>
                <div class="col-4 d-flex align-items-end">
                  <button id="btn_simpan" class="btn btn-primary" style="width: 130px;"><i class="fas fa-plus"></i> Simpan</button>
                  <button id="btn_simpan_spin" class="d-none btn btn-primary" type="button" disabled style="width: 130px;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="tabel_materi" class="table table-bordered table-striped" style="font-size: 13px;">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Materi</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($materis as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td>{{ $item->nama }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="#" class="dropdown-toggle btn bg-gradient-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item border-bottom" id="btn_edit" data-id="{{ $item->id }}">
                              <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                            </a>
                            <a href="#" class="dropdown-item" id="btn_delete" data-id="{{ $item->id }}">
                              <i class="fas fa-trash text-center mr-2" style="width: 20px;"></i> Hapus
                            </a>
                          </div>
                        </div>
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

<div id="modalEdit" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">

          {{-- materi id --}}
          <input type="hidden" name="modal_id" id="modal_id">

          <div class="col-12">
            <label for="modal_materi">Nama Materi</label>
            <input type="text" name="modal_materi" id="modal_materi" class="form-control" placeholder="Nama Materi">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal_btn_close" class="btn btn-danger" data-dismiss="modal" style="width: 130px;">Close</button>
        <button type="button" id="modal_btn_update" class="btn btn-primary" style="width: 130px;">Perbaharui</button>
        <button id="modal_btn_update_spin" class="d-none btn btn-primary" type="button" disabled style="width: 130px;">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
        </button>
      </div>
    </div>
  </div>
</div>

<div id="modalDelete" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <input type="hidden" name="modal_delete_id" id="modal_delete_id">
        <div class="text-center mb-4">
          <span>Apakah yakin akan dihapus?</span>
        </div>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" style="width: 130px;">Tidak</button>
          <button type="button" id="modal_btn_delete" class="btn btn-primary ml-2" style="width: 130px;">Ya</button>
          <button id="modal_btn_delete_spin" class="d-none btn btn-primary ml-2" type="button" disabled style="width: 130px;">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
          </button>
        </div>
      </div>
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

<script>
  $(document).ready(function () {
    $("#tabel_materi").DataTable();

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#btn_simpan').on('click', function() {
      const materi = $('#materi').val();
      const modulId = $('#modul_id').val();

      let formData = {
        modul_id: modulId,
        nama: materi
      }

      if (materi) {
        $.ajax({
          url: "{{ route('training.modul.materi.store') }}",
          type: "post",
          data: formData,
          beforeSend: function () {
            $('#btn_simpan').addClass('d-none');
            $('#btn_simpan_spin').removeClass('d-none');
          },
          success: function (response) {
            $('#btn_simpan').removeClass('d-none');
            $('#btn_simpan_spin').addClass('d-none');

            Toast.fire({
              icon: 'success',
              title: 'Data berhasil disimpan.'
            });

            window.location.reload();
          },
          error: function () {
            alert('Server Error!');
          }
        })
      } else {
        alert('Nama materi harus diisi.');
      }
    })

    // btn edit
    $('#tabel_materi').on('click', function (e) {
      e.preventDefault();
      const id = e.target.getAttribute('id');
      const dataId= e.target.dataset.id;

      if (!id) return;

      if (id === "btn_edit") {
        let url = "{{ route('training.modul.materi.edit', [':id']) }}";
        url = url.replace(':id', dataId);
        
        $.ajax({
          url: url,
          type: "get",
          success: function (response) {
            const materi = response.materi;
            $('#modal_id').val(materi.id);
            $('#modal_materi').val(materi.nama);
            $('#modalEdit').modal('show');
          },
          error: function () {
            alert('Server Error!');
          }
        })
      }

      if (id === "btn_delete") {
        $('#modalDelete #modal_delete_id').val(dataId);
        $('#modalDelete').modal('show');
      }
    })

    // modal btn update
    $('#modal_btn_update').on('click', function (e) {
      e.preventDefault();
      const id = $('#modal_id').val();
      const nama = $('#modal_materi').val();

      let url = "{{ route('training.modul.materi.update', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "put",
        data: {
          id: id,
          nama: nama
        },
        beforeSend: function () {
          $('#modal_btn_update').addClass('d-none');
          $('#modal_btn_update_spin').removeClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Data berhasil diubah.'
          });
          window.location.reload();
          $('#modal_btn_update').removeClass('d-none');
          $('#modal_btn_update_spin').addClass('d-none');
        },
        error: function () {
          alert('Server Error!');
        }
      })
    })

    // modal btn delete
    $('#modal_btn_delete').on('click', function (e) {
      e.preventDefault();
      const id = $('#modalDelete #modal_delete_id').val();
      
      let url = "{{ route('training.modul.materi.delete', [':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
        url: url,
        type: "get",
        beforeSend: function () {
          $('#modal_btn_delete').addClass('d-none');
          $('#modal_btn_delete_spin').removeClass('d-none');
        },
        success: function (response) {
          Toast.fire({
            icon: 'success',
            title: 'Data berhasil dihapus.'
          });
          $('#modal_btn_delete').removeClass('d-none');
          $('#modal_btn_delete_spin').addClass('d-none');
          window.location.reload();
        },
        error: function () {
          alert('Server Error!');
        }
      })
    })
  });
</script>
@endsection
