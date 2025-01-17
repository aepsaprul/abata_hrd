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
          <h1>Konsultasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Konsultasi</li>
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
                <a href="{{ route('konsultasi.create') }}" class="btn bg-gradient-primary btn-sm px-3">
                  <i class="fas fa-plus"></i> Tambah
                </a>
              </h3>
            </div>
            <div class="card-body">
              <table id="tabel_konsultasi" class="table table-bordered table-striped" style="font-size: 13px;">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Karyawan</th>
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Editor</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($konsultasis as $key => $konsultasi)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td class="text-center">{{ tglCarbon($konsultasi->tanggal_pertemuan, 'd/m/Y') }}</td>
                      <td class="text-uppercase">{{ $konsultasi->nama_karyawan }}</td>
                      <td class="text-capitalize">{{ $konsultasi->cabang }}</td>
                      <td class="text-capitalize">{{ $konsultasi->jabatan }}</td>
                      <td class="text-capitalize">{{ $konsultasi->dataUser ? $konsultasi->dataUser->name : '' }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="#" class="dropdown-toggle btn bg-gradient-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('konsultasi.show', [$konsultasi->id]) }}" class="dropdown-item border-bottom">
                              <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                            </a>
                            <a href="{{ route('konsultasi.edit', [$konsultasi->id]) }}" class="dropdown-item border-bottom">
                              <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                            </a>
                            <a href="{{ route('konsultasi.delete', [$konsultasi->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')">
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
@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $("#tabel_konsultasi").DataTable();
  });
</script>
@endsection
