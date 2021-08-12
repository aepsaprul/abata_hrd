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
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ asset('assets/img/maskot.png') }}" alt="maskot" class="mx-auto d-block m-4 image-fluid" style="max-width: 200px;">
                    </div>
                    <div class="col-md-7">
                        <table style="width: 70%; height: 100%;">
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <h1 class="text-uppercase font-weight-bold p-2 selamatdatang">selamat datang</h1>
                                        <p class="text-capitalize font-italic font-weight-bold">silahkan pilih posisi yang akan dilamar</p>
                                        <div class="row">
                                            @foreach ($lokers as $loker)                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-block">{{ $loker->masterJabatan->nama_jabatan }}</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap4/bootstrap.min.js') }}"></script>
    </body>
</html>
