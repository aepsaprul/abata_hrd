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
                    <h1>Edit Kontak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.kontak') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.kontak.update') }}" method="POST">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $kontak->id }}">
                          <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $kontak->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $kontak->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $kontak->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $kontak->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_img">Img</label>
                                  <input type="text" name="edit_img" id="edit_img" class="form-control" value="{{ $kontak->img }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_nomor">Nomor</label>
                                <input type="text" name="edit_nomor" id="edit_nomor" class="form-control" value="{{ $kontak->nomor }}">
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_link">Link</label>
                                <input type="text" name="edit_link" id="edit_link" class="form-control" value="{{ $kontak->link }}">
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
