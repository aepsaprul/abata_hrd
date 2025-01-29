@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>Detail Konsultasi</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('konsultasi') }}">Konsultasi</a></li>
            <li class="breadcrumb-item active">Detail</li>
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
              <div class="row">
                <div class="col-md-3 col-12 mb-3">
                  <label class="form-label">Tanggal Pertemuan</label>
                  <input type="date" class="form-control" value="{{ tglCarbon($konsultasi->tanggal_pertemuan, 'Y-m-d') }}" readonly>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label class="form-label">Karyawan</label>
                  <input type="text" class="form-control" value="{{ $konsultasi->nama_karyawan }}" readonly>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label class="form-label">Waktu Mulai</label>
                  <input type="text" class="form-control" value="{{ $konsultasi->waktu_mulai }}" readonly>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label class="form-label">Waktu Selesai</label>
                  <input type="text" class="form-control" value="{{ $konsultasi->waktu_selesai }}" readonly>
                </div>
                <div class="col-md-4 col-12 mb-3">
                  <label class="form-label">Point Pertemuan</label>
                  <input type="text" class="form-control" value="{{ $konsultasi->point }}" readonly>
                </div>
                <div class="col-md-4 col-12 mb-3">
                  <label class="form-label">Catatan</label>
                  <textarea class="form-control" readonly>{{ $konsultasi->catatan }}</textarea>
                </div>
                <div class="col-md-4 col-12 mb-3">
                  <label class="form-label">Tindakan Selanjutnya</label>
                  <textarea class="form-control" readonly>{{ $konsultasi->tindakan }}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
