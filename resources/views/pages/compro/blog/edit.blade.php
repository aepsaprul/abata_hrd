@extends('layouts.app')

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('compro.blog') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('compro.blog.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="edit_id" id="edit_id" value="{{ $blog->id }}">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_grup">Grup</label>
                                <select name="edit_grup" id="edit_grup" class="form-control">
                                  <option value="">--Pilih Grup--</option>
                                  <option value="abata" {{ $blog->grup == "abata" ? "selected" : "" }}>Abata</option>
                                  <option value="adaya" {{ $blog->grup == "adaya" ? "selected" : "" }}>Adaya</option>
                                  <option value="utakatik" {{ $blog->grup == "utakatik" ? "selected" : "" }}>Utak atik</option>
                                  <option value="wahana" {{ $blog->grup == "wahana" ? "selected" : "" }}>Wahana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_judul">Judul</label>
                                  <input type="text" name="edit_judul" id="edit_judul" class="form-control" value="{{ $blog->judul }}">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="form-group">
                                <label for="edit_gambar">Gambar</label>
                                <input type="file" name="edit_gambar" id="edit_gambar" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="edit_deskripsi">deskripsi</label>
                                  <textarea id="summernote" name="edit_deskripsi">{{ $blog->deskripsi }}</textarea>
                                </div>
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
<script src="{{ asset('public/themes/plugins/summernote/summernote-bs4.js') }}"></script>

<script>
  $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

      // Summernote
      $('#summernote').summernote()
  });
</script>
@endsection
