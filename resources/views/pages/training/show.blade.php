@extends('layouts.app')
@section('style')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>Detail Training</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('training') }}">Training</a></li>
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
                  <label for="kategori" class="form-label">Kategori</label>
                  <select name="kategori" id="kategori" class="form-control" required>
                    <option value="softskill" {{ $training->kategori == "softskill" ? 'selected' : '' }}>SoftSkill</option>
                    <option value="hardskill" {{ $training->kategori == "hardskill" ? 'selected' : '' }}>HardSkill</option>
                  </select>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="judul" class="form-label">Judul</label>
                  <input type="text" name="judul" id="judul" class="form-control" value="{{ $training->judul }}" required>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="divisi_id" class="form-label">Divisi</label>
                  <select name="divisi_id" id="divisi_id" class="form-control" required>
                    <option value="">Pilih Divisi</option>
                    @foreach ($divisis as $divisi)
                      <option value="{{ $divisi->id }}" {{ $training->divisi_id == $divisi->id ? 'selected' : '' }}>{{ $divisi->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ tglCarbon($training->tanggal, 'Y-m-d') }}" required>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="durasi" class="form-label">Durasi (jam)</label>
                  <input type="number" name="durasi" id="durasi" class="form-control" value="{{ $training->durasi }}" required>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="tempat" class="form-label">Tempat</label>
                  <input type="text" name="tempat" id="tempat" class="form-control" value="{{ $training->tempat }}" required>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="goal" class="form-label">Goal</label>
                  <input type="text" name="goal" id="goal" class="form-control" value="{{ $training->goal }}" required>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="jenis" class="form-label">Jenis</label>
                  <select name="jenis" id="jenis" class="form-control" required>
                    <option value="offline" {{ $training->jenis == "offline" ? 'selected' : '' }}>Offline</option>
                    <option value="online" {{ $training->jenis == "online" ? 'selected' : '' }}>Online</option>
                  </select>
                </div>
                <div class="col-md-3 col-12 mb-3">
                  <label for="hasil" class="form-label">Hasil</label>
                  <input type="text" name="hasil" id="hasil" class="form-control" value="{{ $training->hasil }}">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4 col-12 mt-3">
                  <h6 class="border-bottom font-weight-bold py-2">Peserta</h6>
                  <div id="peserta_wrap">
                    @foreach ($training_pesertas as $peserta)
                      <div class="input-group mb-3">
                        <select name="peserta[]" class="form-control select2_peserta" style="pointer-events: none; appearance: none; background-color: #f0f0f0; color: #555;" required>
                          <option value="">Pilih Peserta</option>
                          @foreach ($karyawans as $karyawan_peserta)
                            <option value="{{ $karyawan_peserta->id }}" {{ $karyawan_peserta->id == $peserta->master_karyawan_id ? 'selected' : '' }}>{{ $karyawan_peserta->nama_lengkap }}</option>
                          @endforeach
                        </select>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="col-md-4 col-12 mt-3">
                  <h6 class="border-bottom font-weight-bold py-2">Pengisi</h6>
                  <div id="pengisi_wrap">
                    @foreach ($training_pengisis as $pengisi)
                      <div class="input-group mb-3">
                        <select name="pengisi[]" class="form-control select2_pengisi" style="pointer-events: none; appearance: none; background-color: #f0f0f0; color: #555;" required>
                          <option value="">Pilih Pengisi</option>
                          @foreach ($karyawans as $karyawan_pengisi)
                            <option value="{{ $karyawan_pengisi->id }}" {{ $karyawan_pengisi->id == $pengisi->karyawan_id ? 'selected' : '' }}>{{ $karyawan_pengisi->nama_lengkap }}</option>
                          @endforeach
                        </select>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="col-md-4 col-12 mt-3">
                  <h6 class="border-bottom font-weight-bold py-2">Modul</h6>
                  <div id="modul_wrap">
                    @foreach ($training_moduls as $modul)
                      <div class="input-group mb-3">
                        <select name="modul[]" class="form-control select2_modul" style="pointer-events: none; appearance: none; background-color: #f0f0f0; color: #555;" required>
                          <option value="">Pilih Modul</option>
                          @foreach ($moduls as $data_modul)
                            <option value="{{ $data_modul->id }}" {{ $data_modul->id == $modul->modul_id ? 'selected' : '' }}>{{ $data_modul->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    @endforeach
                  </div>
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
