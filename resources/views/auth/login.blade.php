@extends('layouts.app')

@section('content')
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
                                    <td>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Input email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Ingat Saya</label>
                                                <br><br>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap4/bootstrap.min.js') }}"></script>
</body>
</html>
@endsection
