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
          <h4>Ubah Struktur</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('struktur') }}">Struktur</a></li>
            <li class="breadcrumb-item active">Ubah</li>
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
              <form action="{{ route('struktur.update', [$struktur->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-4 col-12 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $struktur->nama }}" required>
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $struktur->title }}" required>
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="parent_id" class="form-label">Parent Id</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                      <option value="">Pilih Parent</option>
                      @foreach ($strukturs as $item)
                        <option value="{{ $item->id }}" {{ $item->id ==  $struktur->parent_id ? 'selected' : '' }}>{{ $item->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn bg-gradient-primary" style="width: 150px;"><i class="fas fa-save"></i> Perbaharui</button>
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
    $('.select2-karyawan').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endsection