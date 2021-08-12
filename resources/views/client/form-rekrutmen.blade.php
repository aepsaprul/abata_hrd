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
                                    {{-- nama lengkap  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="nama lengkap" required autofocus value="{{ old('nama_lengkap') }}">
                                        </div>
                                    </div>

                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- nama panggilan  --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_panggilan">Nama Panggilan</label>
                                            <input type="text" name="nama_panggilan" class="form-control @error('nama_panggilan') is-invalid @enderror" id="nama_panggilan" placeholder="nama panggilan" required autofocus value="{{ old('nama_panggilan') }}">
                                        </div>
                                    </div>

                                    @error('nama_panggilan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- telepon  --}}
									<div class="col-md-3">
										<div class="form-group">
											<label for="telepon">Telepon</label>
											<input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="telepon" required autofocus value="{{ old('telepon') }}">
										</div>
									</div>

									@error('telepon')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

                                    {{-- email  --}}
									<div class="col-md-3">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required autofocus value="{{ old('email') }}">
										</div>
									</div>

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

                                    {{-- nomor ktp  --}}
									<div class="col-md-3">
										<div class="form-group">
											<label for="nomor_ktp">Nomor KTP</label>
											<input type="text" name="nomor_ktp" class="form-control @error('nomor_ktp') is-invalid @enderror" id="nomor_ktp" placeholder="nomor KTP" required autofocus value="{{ old('nomor_ktp') }}">
										</div>
									</div>

									@error('nomor_ktp')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

                                    {{-- agama  --}}
									<div class="col-md-3">
										<div class="form-group">
											<label for="agama">Agama</label>
											<select name="agama" id="agama" class="form-control">
												<option value="Islam">Islam</option>
												<option value="Kristen">Kristen</option>
												<option value="Hindu">Hindu</option>
												<option value="Budha">Budha</option>
											</select>
										</div>
									</div>

                                    {{-- status  --}}
									<div class="col-md-3">
										<div class="form-group">
											<label for="status_perkawinan">Status Perkawinan</label>
											<select name="status_perkawinan" id="status_perkawinan" class="form-control">
												<option value="Lajang">Lajang</option>
												<option value="Menikah">Menikah</option>
												<option value="Cerai">Cerai</option>
												<option value="Janda/Duda">Janda/Duda</option>
											</select>
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
