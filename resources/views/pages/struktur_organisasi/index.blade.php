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
          <h1>Struktur Jabatan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Struktur Jabatan</li>
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
              <h3 class="card-title">
                <a href="{{ route('struktur.create') }}" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fas fa-plus"></i> Tambah</a>
                <a href="{{ route('struktur.display') }}" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fas fa-tv"></i> Display</a>
              </h3>
            </div>
            <div class="card-body">
              <table id="tabel_struktur" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Parent</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($strukturs as $key => $struktur)
                    <tr>
                      <td>{{ $struktur->nama }}</td>
                      <td>{{ $struktur->title }}</td>
                      <td>{{ $struktur->parent ? $struktur->parent->title : '' }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                            <a href="#" class="dropdown-toggle btn bg-gradient-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a href="{{ route('struktur.edit', [$struktur->id]) }}" class="dropdown-item border-bottom">
                                <i class="fas fa-pencil-alt pr-1"></i> Ubah
                              </a>
                              <a href="#" class="dropdown-item">
                                <i class="fas fa-minus-circle pr-1"></i> Hapus
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
@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $("#tabel_struktur").DataTable();
  });
</script>
@endsection
