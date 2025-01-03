@extends('layouts.app')

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG') . 'themes/plugins/summernote/summernote-bs4.css') }}">
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
                            <div class="col-lg-4 col-md-3 col-sm-6 col-12">
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
                            <div class="col-lg-4 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_icon">Icon</label>
                                  <input type="text" name="edit_icon" id="edit_icon" class="form-control" value="{{ $kontak->icon }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_title">Title</label>
                                <input type="text" name="edit_title" id="edit_title" class="form-control" value="{{ $kontak->title }}">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label for="edit_deskripsi">Deskripsi</label>
                                <textarea id="summernote" name="edit_deskripsi" id="edit_deskripsi" cols="30" rows="3" class="form-control" required>{{ $kontak->deskripsi }}</textarea>
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
<!-- Summernote -->
<script src="{{ asset(env('APP_URL_IMG') . 'themes/plugins/summernote/summernote-bs4.js') }}"></script>
<script>
  // Summernote
  $('#summernote').summernote()
</script>
@endsection
