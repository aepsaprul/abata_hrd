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
                    <h1>Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.produk') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.produk.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $produk->id }}">
                          <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $produk->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $produk->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $produk->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $produk->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_nama_produk">Nama Produk</label>
                                  <input type="text" name="edit_nama_produk" id="edit_nama_produk" class="form-control" value="{{ $produk->nama_produk }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_kategori">Kategori</label>
                                  <select name="edit_kategori" id="edit_kategori" class="form-control">
                                    <option value="">--Pilih Kategori--</option>
                                    <option value="a3" {{ $produk->kategori == "a3" ? "selected" : "" }}>A3</option>
                                    <option value="indoor" {{ $produk->kategori == "indoor" ? "selected" : "" }}>Indoor</option>
                                    <option value="outdoor" {{ $produk->kategori == "outdoor" ? "selected" : "" }}>Outdoor</option>
                                    <option value="merchandise" {{ $produk->kategori == "merchandise" ? "selected" : "" }}>Merchandise</option>
                                    <option value="advertising" {{ $produk->kategori == "advertising" ? "selected" : "" }}>Advertising</option>
                                    <option value="uv" {{ $produk->kategori == "uv" ? "selected" : "" }}>UV</option>
                                    <option value="dtf" {{ $produk->kategori == "dtf" ? "selected" : "" }}>DTF</option>
                                    <option value="akrilik" {{ $produk->kategori == "akrilik" ? "selected" : "" }}>Akrilik</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_harga">Harga</label>
                                  <input type="text" name="edit_harga" id="edit_harga" class="form-control" value="{{ $produk->harga }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_gambar">Gambar</label>
                                <input type="file" name="edit_gambar" id="edit_gambar" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12" style="display: flex;align-items: center; justify-content: end; margin-top: 10px;">
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

