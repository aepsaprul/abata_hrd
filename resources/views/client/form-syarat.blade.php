<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-daun.png') }}" type="image/x-icon">

        <title>Abata HC</title>
        
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap4/bootstrap.min.css') }}">

        <!-- Styles -->
        <style>
            body, .container-fluid {
                background-color: #FFDD00;
            }
            .navbar {
                background-color: #176BB3;
            }
            .selamatdatang {
                color: #176BB3;
                border-bottom: 2px solid #000;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/img/logo.png') }}" width="100" height="50" alt="">
                </a>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    {{-- content empty  --}}
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <img src="{{ asset('assets/img/facebook.png') }}" width="30" height="30" alt="" class="m-2">
                    <img src="{{ asset('assets/img/instagram.png') }}" width="30" height="30" alt="" class="m-2">
                    <img src="{{ asset('assets/img/youtube.png') }}" width="30" height="30" alt="" class="m-2">
                </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="container">
                <h4 class="text-uppercase text-center mt-4 mb-4">persyaratan lamaran</h4>
                <div class="row">
                    <div class="col-md-12">
                            <form role="form" action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- Surat Lamaran  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Surat Lamaran</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- Curriculum vitae  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Curriculum Vitae</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- Ijazah  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Ijazah</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- Transkip Nilai  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Transkip Nilai</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- foto 3x4  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Foto 3x4</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- kartu keluarga  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">Kartu Keluarga</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>

                                    {{-- ktp  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="foto">KTP</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" placeholder="Masukkan foto" required autofocus value="{{ old('foto') }}">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap4/bootstrap.min.js') }}"></script>
    </body>
</html>
