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
                    <h1>Edit Testimoni</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.testimoni') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.testimoni.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $testimoni->id }}">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $testimoni->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $testimoni->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $testimoni->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $testimoni->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_nama">Nama</label>
                                  <input type="text" name="edit_nama" id="edit_nama" class="form-control" value="{{ $testimoni->nama }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_foto">Foto</label>
                                <input type="file" name="edit_foto" id="edit_foto" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                              <div class="form-group">
                                <label for="edit_komentar">Komentar</label>
                                <textarea name="edit_komentar" id="edit_komentar" cols="30" rows="3" class="form-control" required>{{ $testimoni->komentar }}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                              <button class="btn btn-primary"><i class="fas fa-save"></i> Perbaharui</button>
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

@endsection
