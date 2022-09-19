@extends('layouts.app')

@section('style')

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Tentang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.tentang') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <form action="{{ route('compro.tentang.update') }}" method="POST">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $tentang->id }}">
                          <div class="mb-3">
                            <label for="edit_grup">Grup</label>
                            <select name="edit_grup" id="edit_grup" class="form-control">
                              <option value="">--Pilih Grup--</option>
                              <option value="abata" {{ $tentang->nama == "abata" ? "selected" : "" }}>Abata</option>
                              <option value="adaya" {{ $tentang->nama == "adaya" ? "selected" : "" }}>Adaya</option>
                              <option value="utakatik" {{ $tentang->nama == "utakatik" ? "selected" : "" }}>Utak atik</option>
                              <option value="wahana" {{ $tentang->nama == "wahana" ? "selected" : "" }}>Wahana</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="edit_nama">Nama</label>
                            <select name="edit_nama" id="edit_nama" class="form-control">
                              <option value="">--Pilih Nama--</option>
                              <option value="sejarah" {{ $tentang->nama == "sejarah" ? "selected" : "" }}>Sejarah</option>
                              <option value="visi" {{ $tentang->nama == "visi" ? "selected" : "" }}>Visi</option>
                              <option value="misi" {{ $tentang->nama == "misi" ? "selected" : "" }}>Misi</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea name="edit_deskripsi" id="edit_deskripsi" cols="30" rows="10" class="form-control">{{ $tentang->deskripsi }}</textarea>
                          </div>
                          <div class="mb-3">
                            <button class="btn btn-primary"><i class="fas fa-save"></i> Perbaharui</button>
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

@endsection
