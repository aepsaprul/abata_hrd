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
          <h4>Tambah Modul</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('training.moduls') }}">Modul</a></li>
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
              <form action="{{ route('training.modul.update', [$modul->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-6 col-12 mb-3">
                    <label for="nama" class="form-label">Nama Modul</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $modul->nama }}">
                  </div>
                  <div class="col-md-6 col-12 mb-3">
                    <label for="file" class="form-label">Ganti File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                  </div>
                </div>
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
