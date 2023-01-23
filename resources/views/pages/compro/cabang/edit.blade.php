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
                    <h1>Edit Cabang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.cabang') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.cabang.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $cabang->id }}">
                          <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $cabang->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $cabang->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $cabang->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $cabang->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_nama">Nama Cabang</label>
                                  <input type="text" name="edit_nama" id="edit_nama" class="form-control" value="{{ $cabang->nama }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_kontak">kontak</label>
                                <input type="text" name="edit_kontak" id="edit_kontak" class="form-control" value="{{ $cabang->kontak }}">
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_maps">Maps</label>
                                <input type="text" name="edit_maps" id="edit_maps" class="form-control" value="{{ $cabang->maps }}">
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                              <div class="form-group">
                                <label for="edit_alamat">Alamat</label>
                                <input type="text" name="edit_alamat" id="edit_alamat" class="form-control" value="{{ $cabang->alamat }}">
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
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
