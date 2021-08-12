@guest

@yield('content')

@else

@if (Auth::user()->roles == "pelamar")
  Akses ditolak - <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <p>
      Kembali
    </p>
  </a>
@else

  <!doctype html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="shortcut icon" href="{{ asset('assets/img/logo-daun.png') }}" type="image/x-icon">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Abata') }}</title>

      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

      @yield('style')
  </head>
  <body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
      <div class="wrapper">
          <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
              <div class="container">
                  <a href="../../index3.html" class="navbar-brand">
                      <img src="{{ asset('assets/img/logo-biru.png') }}" alt="AdminLTE Logo" class="brand-image">
                      <span class="brand-text font-weight-light">Abata Head Office</span>
                  </a>
                
                  <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-widget="pushmenu" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                      <!-- Left navbar links -->
                      <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                      </ul>
                  </div>
                  <!-- Right navbar links -->
                  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                      <li class="nav-item">
                          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                              </form>
                              <p>
                                LOGOUT
                              </p>
                          </a>
                      </li>
                  </ul>
              </div>
          </nav>
          <!-- /.navbar -->

          <aside class="main-sidebar sidebar-dark-primary elevation-4">
              <!-- Brand Logo -->
              <a href="#" class="brand-link">
                  <img src="{{ asset('assets/img/logo-biru.png') }}"
                      alt="Abata Logo"
                      class="brand-image">
                  <span class="brand-text font-weight-light">Abata HO</span>
              </a>
          
              <!-- Sidebar -->
              <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                    <img src="{{ asset('assets/img/logo-biru.png') }}" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                  </div>
                </div>
          
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    @foreach (Auth::user()->load('masterKaryawan.karyawanMenu')->masterKaryawan->karyawanMenu as $item)
                      <li class="nav-item">
                        <a href="{{ url($item->masterMenu->link) }}" class="nav-link">
                          <i class="nav-icon fas fa-arrow-circle-right"></i>
                          <p>
                            {{ $item->masterMenu->nama_menu }}
                          </p>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
              <!-- /.sidebar -->
            </aside>

            @yield('content')
      </div>

      <!-- jQuery -->
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

      @yield('script')
  </body>
  </html>

@endif

@endguest
