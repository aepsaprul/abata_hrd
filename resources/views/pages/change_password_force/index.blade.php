<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/font-google/font-google.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Abata</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out-alt px-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <div class="card card-primary col-4">
                                    <!-- form start -->
                                    <form method="POST" action="{{ route('change.password') }}">
                                        @csrf
                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="text-success">
                                                    <i>{{ session('status') }}</i>
                                                </div>
                                            @endif
                                            @foreach ($errors->all() as $error)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="password" class="text-danger">{{ $error }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <h6 class="text-uppercase text-danger">Silahkan Ubah Password Anda Terlebih Dahulu</h6>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="current_password">Password Sekarang</label>
                                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="new_password">Password Baru</label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="new_confirm_password">Ulangi Password Baru</label>
                                                    <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>


    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/dist/js/adminlte.js') }}"></script>
</body>
</html>
