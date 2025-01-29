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
          <h1>Training</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Training</li>
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
                <a href="{{ route('training.create') }}" class="btn bg-gradient-primary btn-sm px-3">
                  <i class="fas fa-plus"></i> Tambah
                </a>
                <a href="{{ route('training.moduls') }}" class="btn bg-gradient-info btn-sm px-3">
                  <i class="fas fa-copy"></i> Halaman Modul
                </a>
                <button type="button" id="btn-create" class="btn btn-outline-primary btn-sm px-3" data-toggle="collapse" data-target="#form_filter" style="width: 120px;">
                  <i class="fas fa-copy"></i> Laporan
                </button>
              </h3>
            </div>
            <form action="{{ route('training.laporan') }}" class="mx-4" method="POST">
              @csrf
              <div id="form_filter" class="row collapse mt-3">
                <div class="col-12 mb-3">
                  <div class="row">
                    <div class="col-3">
                      <label for="tahun">Tahun</label>
                      <select name="tahun" id="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @for ($i = 2010; $i < 2050; $i++)
                          <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-3">
                      <label for="bulan">Bulan</label>
                      <select name="bulan" id="bulan" class="form-control">
                        <option value="">Pilih Bulan</option>
                        <option value="01" {{ date('m') == '01' ? 'selected' : ''}}>Januari</option>
                        <option value="02" {{ date('m') == '02' ? 'selected' : ''}}>Februari</option>
                        <option value="03" {{ date('m') == '03' ? 'selected' : ''}}>Maret</option>
                        <option value="04" {{ date('m') == '04' ? 'selected' : ''}}>April</option>
                        <option value="05" {{ date('m') == '05' ? 'selected' : ''}}>Mei</option>
                        <option value="06" {{ date('m') == '06' ? 'selected' : ''}}>Juni</option>
                        <option value="07" {{ date('m') == '07' ? 'selected' : ''}}>Juli</option>
                        <option value="08" {{ date('m') == '08' ? 'selected' : ''}}>Agustus</option>
                        <option value="09" {{ date('m') == '09' ? 'selected' : ''}}>September</option>
                        <option value="10" {{ date('m') == '10' ? 'selected' : ''}}>Oktober</option>
                        <option value="11" {{ date('m') == '11' ? 'selected' : ''}}>November</option>
                        <option value="12" {{ date('m') == '12' ? 'selected' : ''}}>Desember</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" id="btn_excel" class="btn btn-sm btn-primary px-3"><i class="fas fa-paper-plane"></i> Excel</button>
                </div>
              </div>
            </form>
            <div class="card-body">
              {{-- @if (Auth::user()->master_karyawan_id != 0)
                <div class="row mb-3">
                  <div class="col-12">
                    <div><span class="font-weight-bold">Durasi:</span> 8 Jam</div>
                    <div><span class="font-weight-bold">Modul:</span> Company Profile, Produk Knowledge, Service Excellent, Leadership, SOP</div>
                  </div>
                </div>
                <hr>
              @endif --}}
              <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Durasi</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($trainings as $key => $item)
                    <tr>
                      <td class="text-center">{{ $key + 1 }}</td>
                      <td class="text-center">{{ tglCarbon($item->tanggal, 'd/m/Y') }}</td>
                      <td class="text-uppercase">{{ $item->kategori }}</td>
                      <td class="text-capitalize">{{ $item->judul }}</td>
                      <td class="text-capitalize text-right">{{ $item->durasi }} Jam</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="#" class="dropdown-toggle btn bg-gradient-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('training.show', [$item->id]) }}" class="dropdown-item border-bottom">
                              <i class="fas fa-eye text-center mr-2" style="width: 20px;"></i> Detail
                            </a>
                            <a href="{{ route('training.edit', [$item->id]) }}" class="dropdown-item border-bottom">
                              <i class="fas fa-pencil-alt text-center mr-2" style="width: 20px;"></i> Ubah
                            </a>
                            <a href="{{ route('training.delete', [$item->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')">
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
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $("#example1").DataTable();
  });
</script>
@endsection
