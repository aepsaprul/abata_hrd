@extends('layouts.app')
@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>Tambah Training</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('training') }}">Training</a></li>
            <li class="breadcrumb-item active">Tambah</li>
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
              <form action="{{ route('training.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-3 col-12 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                      <option value="softskill">SoftSkill</option>
                      <option value="hardskill">HardSkill</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="judul" class="form-label">Modul</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="divisi_id" class="form-label">Divisi</label>
                    <select name="divisi_id" id="divisi_id" class="form-control" required>
                      <option value="">Pilih Divisi</option>
                      @foreach ($divisis as $divisi)
                        <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="durasi" class="form-label">Durasi (jam)</label>
                    <input type="number" name="durasi" id="durasi" class="form-control" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="tempat" class="form-label">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="goal" class="form-label">Goal</label>
                    <input type="text" name="goal" id="goal" class="form-control" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control" required>
                      <option value="offline">Offline</option>
                      <option value="online">Online</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="hasil" class="form-label">Hasil</label>
                    <input type="text" name="hasil" id="hasil" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4 col-12 mt-3">
                    <button type="button" id="btn_tambah_modul" class="btn bg-gradient-secondary px-3 mb-3"><i class="fas fa-plus"></i> Tambah Modul</button>
                    <div id="modul_wrap"></div>
                  </div>
                  <div class="col-md-4 col-12 mt-3">
                    <button type="button" id="btn_tambah_pengisi" class="btn bg-gradient-secondary px-3 mb-3"><i class="fas fa-plus"></i> Tambah Pengisi</button>
                    <div id="pengisi_wrap"></div>
                  </div>
                  <div class="col-md-4 col-12 mt-3">
                    <button type="button" id="btn_tambah_peserta" class="btn bg-gradient-secondary px-3 mb-3"><i class="fas fa-plus"></i> Tambah Peserta</button>
                    <div id="peserta_wrap"></div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn bg-gradient-primary" style="width: 150px;"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function () {
    // tambah peserta
    $('#btn_tambah_peserta').click(function() {
      $.ajax({
        url: "{{ URL::route('training.getKaryawan') }}",
        type: "get",
        success: function(response) {          
          // Membuat elemen field baru
          let newSelect = `
            <div class="input-group mb-3">
              <select name="peserta[]" class="form-control select2_peserta" required>
                <option value="">Pilih Peserta</option>`;
                $.each(response.data, function(index, item) {
                  newSelect += `<option value="${item.id}">${item.nama_lengkap}</option>`;
                })
              newSelect += `</select>
              <div class="input-group-append">
                <button type="button" class="btn btn-danger btn_hapus"><i class="fas fa-times"></i></button>
              </div>
            </div>`;
          
          // Menambah elemen field baru ke dalam formulir
          $('#peserta_wrap').append(newSelect);

          $('#peserta_wrap .select2_peserta').last().select2({
            placeholder: "Pilih Peserta",
            allowClear: true,
            theme: 'bootstrap4'
          })
        }
      })
    });

    // hapus peserta
    $('#peserta_wrap').on('click', '.btn_hapus', function() {
      // Menghapus elemen .form-group terdekat
      $(this).closest('#peserta_wrap .input-group').remove();
    });

    // tambah pengisi
    $('#btn_tambah_pengisi').click(function() {
      $.ajax({
        url: "{{ URL::route('training.getKaryawan') }}",
        type: "get",
        success: function(response) {          
          // Membuat elemen field baru
          let newSelect = `
            <div class="input-group mb-3">
              <select name="pengisi[]" class="form-control select2_pengisi" required>
                <option value="">Pilih Pengisi</option>`;
                $.each(response.data, function(index, item) {
                  newSelect += `<option value="${item.id}">${item.nama_lengkap}</option>`;
                })
              newSelect += `</select>
              <div class="input-group-append">
                <button type="button" class="btn btn-danger btn_hapus"><i class="fas fa-times"></i></button>
              </div>
            </div>`;
          
          // Menambah elemen field baru ke dalam formulir
          $('#pengisi_wrap').append(newSelect);

          $('#pengisi_wrap .select2_pengisi').last().select2({
            placeholder: "Pilih Pengisi",
            allowClear: true,
            theme: 'bootstrap4'
          })
        }
      })
    });

    // hapus pengisi
    $('#pengisi_wrap').on('click', '.btn_hapus', function() {
      // Menghapus elemen .form-group terdekat
      $(this).closest('#pengisi_wrap .input-group').remove();
    });

    // tambah modul
    $('#btn_tambah_modul').click(function() {
      $.ajax({
        url: "{{ URL::route('training.getModul') }}",
        type: "get",
        success: function(response) {
          // Membuat elemen field baru
          let newSelect = `
            <div class="input-group mb-3">
              <select name="modul[]" class="form-control select2_modul" required>
                <option value="">Pilih Modul</option>`;
                $.each(response.data, function(index, item) {
                  newSelect += `<option value="${item.id}">${item.nama}</option>`;
                })
              newSelect += `</select>
              <div class="input-group-append">
                <button type="button" class="btn btn-danger btn_hapus"><i class="fas fa-times"></i></button>
              </div>
            </div>`;
          
          // Menambah elemen field baru ke dalam formulir
          $('#modul_wrap').append(newSelect);

          $('#modul_wrap .select2_modul').last().select2({
            placeholder: "Pilih Modul",
            allowClear: true,
            theme: 'bootstrap4'
          })
        }
      })
    });

    // hapus modul
    $('#modul_wrap').on('click', '.btn_hapus', function() {
      // Menghapus elemen .form-group terdekat
      $(this).closest('#modul_wrap .input-group').remove();
    });
  });
</script>
@endsection
