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
          <h4>Ubah Konsultasi</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('konsultasi') }}">Konsultasi</a></li>
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
              <form action="{{ route('konsultasi.update', [$konsultasi->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-3 col-12 mb-3">
                    <label for="tanggal_pertemuan" class="form-label">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" class="form-control" value="{{ tglCarbon($konsultasi->tanggal_pertemuan, 'Y-m-d') }}" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="karyawan_id" class="form-label">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control select2-karyawan" required>
                      <option value="">Pilih Karyawan</option>
                      @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ $karyawan->id == $konsultasi->karyawan_id ? 'selected' : '' }}>{{ $karyawan->nama_lengkap }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ $konsultasi->waktu_mulai }}" required>
                  </div>
                  <div class="col-md-3 col-12 mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $konsultasi->waktu_selesai }}" required>
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="point" class="form-label">Point Pertemuan</label>
                    <select name="point" id="point" class="form-control">
                      <option value="kasus" {{ $konsultasi->point == "kasuk" ? 'selected' : '' }}>Kasus</option>
                      <option value="kontrak" {{ $konsultasi->point == "kontrak" ? 'selected' : '' }}>Kontrak</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control">{{ $konsultasi->catatan }}</textarea>
                  </div>
                  <div class="col-md-4 col-12 mb-3">
                    <label for="tindakan" class="form-label">Tindakan Selanjutnya</label>
                    <textarea name="tindakan" id="tindakan" class="form-control">{{ $konsultasi->tindakan }}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
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
