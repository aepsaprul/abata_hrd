<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-daun.png') }}" type="image/x-icon">

        <title>Abata HO</title>
        
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
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/maskot.png') }}" alt="maskot" class="mx-auto d-block m-4 image-fluid" style="max-width: 200px;">
                    </div>
                    <div class="col-md-6">
                        <table style="height: 100%;">
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h1 class="text-uppercase font-weight-bold p-2 selamatdatang">selamat datang</h1>
                                        <h1 class="text-uppercase">abata head office</h1>
                                        <h4 class="text-uppercase"><a href="login" class="text-white btn bg-primary rounded-pill pl-4 pr-4">login</a></h4>
                                    </td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap4/bootstrap.min.js') }}"></script>
    </body>
</html>
