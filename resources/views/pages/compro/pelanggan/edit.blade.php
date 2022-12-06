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
                    <h1>Edit Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.pelanggan') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.pelanggan.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $pelanggan->id }}">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $pelanggan->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $pelanggan->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $pelanggan->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $pelanggan->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_nama">Nama</label>
                                  <input type="text" name="edit_nama" id="edit_nama" class="form-control" value="{{ $pelanggan->nama }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_gambar">Gambar</label>
                                <input type="file" name="edit_gambar" id="edit_gambar" class="form-control">
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
