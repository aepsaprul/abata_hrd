@guest

@yield('content')

@else

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('public/themes/dist/img/logo-daun.png') }}" rel="icon" type="image/x-icon">
    <title>{{ config('app.name', 'HO') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/font-google/font-google.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/themes/dist/css/adminlte.min.css') }}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed skin-blue">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('public/themes/dist/img/logo-biru.png') }}" alt="AdminLTELogo" height="60" width="110">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <div class="badge_notifikasi"></div>
                        @if (count($current_cuti) > 0 || count($current_resign) > 0)
                            <span class="badge badge-warning navbar-badge">!</span>
                        @endif
                    </a>
                    <div class="dropdown_notifikasi"></div>
                    @if (count($current_cuti) > 0 || count($current_resign) > 0)
                        <div class="dropdown-menu dropdown-menu-right">
                            @if (count($current_cuti) > 0)
                                <a href="{{ route('cuti.index') }}" class="dropdown-item">
                                    <i class="fas fa-mug-hot text-center mr-2" style="width: 20px;"></i> pengajuan cuti
                                </a>
                            @endif
                            @if (count($current_resign) > 0)
                                <a href="{{ route('resign.index') }}" class="dropdown-item">
                                    <i class="fas fa-handshake text-center mr-2" style="width: 20px;"></i> pengajuan resign
                                </a>
                            @endif
                        </div>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                            <i class="fa fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a
                            class="dropdown-item"
                            href="{{ route('profile.index') }}">
                                <i class="fa fa-id-card px-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item"
                            href="{{ route('change.password.index') }}">
                                <i class="fa fa-lock-open px-2"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
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
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('public/themes/dist/img/logo-daun.png') }}" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-light">Abata Group</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center;">
                <div class="image">
                  @if (Auth::user()->masterKaryawan)
                    <img src="{{ asset('public/image/' . Auth::user()->masterKaryawan->foto) }}" class="img-circle elevation-2" alt="User Image" style="width: 50px; height: 50px; object-fit: cover;">
                  @else
                    <img src="{{ asset('public/themes/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 50px; height: 50px; object-fit: cover;">
                  @endif
                </div>
                <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                      {{-- @if (Auth::user()->roles == "admin_hc" || Auth::user()->roles == "admin")
                          <li class="nav-item">
                              <a href="{{ route('home.index') }}" class="nav-link {{ request()->is(['home', 'home/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-tachometer-alt text-center mr-2" style="width: 30px;"></i><p>Dashboard</p>
                              </a>
                          </li>
                          <li class="nav-item {{ request()->is('master/*') ? 'menu-open' : '' }}">
                              <a href="#" class="nav-link {{ request()->is('master/*') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-user-lock text-center mr-2" style="width: 30px;"></i><p>Master<i class="right fas fa-angle-left"></i></p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('nav.index') }}" class="nav-link {{ request()->is('master/nav') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Navigasi</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('master/user') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>User</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('cabang.index') }}" class="nav-link {{ request()->is('master/cabang') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Cabang</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is('master/jabatan') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Jabatan</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('divisi.index') }}" class="nav-link {{ request()->is('master/divisi') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Divisi</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('master/role') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Role</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('loker.index') }}" class="nav-link {{ request()->is('master/loker') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Loker</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('cuti_approver.index') }}" class="nav-link {{ request()->is('master/cuti_approver') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Cuti Approver</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('resign_approver.index') }}" class="nav-link {{ request()->is('master/resign_approver') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Resign Approver</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('penggajian_approver.index') }}" class="nav-link {{ request()->is('master/penggajian_approver') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Penggajian Approver</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->is(['karyawan', 'karyawan/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-user-tie text-center mr-2" style="width: 30px;"></i><p>Karyawan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('cuti.index') }}" class="nav-link {{ request()->is(['cuti', 'cuti/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-mug-hot text-center mr-2" style="width: 30px;"></i><p>Data Cuti</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('approval.index') }}" class="nav-link {{ request()->is(['approval', 'approval/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-check text-center mr-2" style="width: 30px;"></i><p>Approval</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('approval_penggajian.index') }}" class="nav-link {{ request()->is(['approval_penggajian', 'approval_penggajian/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-check text-center mr-2" style="width: 30px;"></i><p>Approval Penggajian</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('resign.index') }}" class="nav-link {{ request()->is(['resign', 'resign/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-hand-paper text-center mr-2" style="width: 30px;"></i><p>Data Resign</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('lamaran.index') }}" class="nav-link {{ request()->is(['lamaran', 'lamaran/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-paperclip text-center mr-2" style="width: 30px;"></i><p>Lamaran</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('penggajian.index') }}" class="nav-link {{ request()->is(['penggajian', 'penggajian/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-money-bill-wave text-center mr-2" style="width: 30px;"></i><p>Penggajian</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('slip_gaji.index') }}" class="nav-link {{ request()->is(['slip_gaji', 'slip_gaji/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-file-invoice-dollar text-center mr-2" style="width: 30px;"></i><p>Slip Gaji</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('slip_gaji_karyawan.index') }}" class="nav-link {{ request()->is(['slip_gaji_karyawan', 'slip_gaji_karyawan/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-file-invoice-dollar text-center mr-2" style="width: 30px;"></i><p>Slip Gaji Karyawan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('training.index') }}" class="nav-link {{ request()->is(['training', 'training/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-comment-alt text-center mr-2" style="width: 30px;"></i><p>Training</p>
                              </a>
                          </li>
                          <li class="nav-item {{ request()->is('pengajuan/*') ? 'menu-open' : '' }}">
                              <a href="#" class="nav-link {{ request()->is('pengajuan/*') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-file-import text-center mr-2" style="width: 30px;"></i><p>Pengajuan<i class="right fas fa-angle-left"></i></p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('pengajuan_cuti.index') }}" class="nav-link {{ request()->is('pengajuan/cuti') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Cuti</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('pengajuan_resign.index') }}" class="nav-link {{ request()->is('pengajuan/resign') ? 'active' : '' }}">
                                          <i class="fas fa-angle-right nav-icon"></i><p>Resign</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('complaint.index') }}" class="nav-link {{ request()->is(['complaint', 'complaint/*']) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-inbox text-center mr-2" style="width: 30px;"></i><p>Kritik & Saran</p>
                              </a>
                          </li>
                      @else --}}
                      @foreach ($current_nav_button as $item)
                          @if ($item->navigasiMain->link == '#')
                              <li class="nav-item {{ request()->is(''.$item->navigasiMain->aktif.'/*') ? 'menu-open' : '' }}">
                                  <a href="#" class="nav-link {{ request()->is(''.$item->navigasiMain->aktif.'/*') ? 'active' : '' }} text-capitalize">
                                      <i class="nav-icon {{ $item->navigasiMain->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->navigasiMain->title }}<i class="right fas fa-angle-left"></i></p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                      @foreach ($current_nav_button_sub as $item_sub)
                                          @if ($item_sub->navigasiSub->link != '#' && $item_sub->navigasiSub->main_id == $item->navigasiMain->id)
                                              <li class="nav-item">
                                                  <a href="{{ route($item_sub->navigasiSub->link) }}" class="nav-link {{ request()->is([''.$item_sub->navigasiSub->aktif.'', ''.$item_sub->navigasiSub->aktif.'/*']) ? 'active' : '' }} text-capitalize">
                                                      <i class="fas fa-angle-right nav-icon"></i> <p>{{ $item_sub->navigasiSub->title }}</p>
                                                  </a>
                                              </li>
                                          @endif
                                      @endforeach
                                  </ul>
                              </li>
                          @else
                              <li class="nav-item">
                                  <a href="{{ route($item->navigasiMain->link) }}" class="nav-link {{ request()->is([''.$item->navigasiMain->aktif.'', ''.$item->navigasiMain->aktif.'/*']) ? 'active' : '' }} text-capitalize">
                                      <i class="nav-icon {{ $item->navigasiMain->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->navigasiMain->title }}</p>
                                  </a>
                              </li>
                          @endif
                      @endforeach
                      {{-- @endif --}}
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('public/themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('public/themes/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/themes/dist/js/adminlte.js') }}"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
      $(document).ready(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      })
    </script>
    
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // dev
        var pusher = new Pusher('1304fb22794d15099e3e', {
            cluster: 'ap1'
        });

        // prod
        // var pusher = new Pusher('5df84db3442172c7d71a', {
        //     cluster: 'ap1'
        // });

        var channel = pusher.subscribe('pengajuan-channel');
        channel.bind('pengajuan-event', function(data) {
            let badge_notifikasi = '<span class="badge badge-warning navbar-badge">!</span>';
            $('.badge_notifikasi').append(badge_notifikasi);

            if (data.nama_pengajuan == "cuti") {
                let dropdown_notifikasi = '' +
                    '<div class="dropdown-menu dropdown-menu-right">' +
                        '<div>' +
                            '<a href="{{ route("cuti.index") }}" class="dropdown-item">' +
                                '<i class="fas fa-mug-hot text-center mr-2" style="width: 20px;"></i> Pengajuan Cuti' +
                            '</a>' +
                        '</div>' +
                    '</div>';
                $('.dropdown_notifikasi').append(dropdown_notifikasi);
            }

            if (data.nama_pengajuan == "resign") {
                let dropdown_notifikasi = '' +
                    '<div class="dropdown-menu dropdown-menu-right">' +
                        '<div>' +
                            '<a href="{{ route("resign.index") }}" class="dropdown-item">' +
                                '<i class="fas fa-handshake text-center mr-2" style="width: 20px;"></i> Pengajuan Resign' +
                            '</a>' +
                        '</div>' +
                    '</div>';
                $('.dropdown_notifikasi').append(dropdown_notifikasi);
            }

            if (Notification.permission === "granted") {
                showNotification();
            } else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                        showNotification();
                    }
                });
            }

            function showNotification() {
                const notification = new Notification("Ada pengajuan baru", {
                    body: "Buka halaman"
                });

                notification.onclick = (e) => {
                    window.location.href = "";
                }
            }
        });
    </script>

    <script>
      function tanggalIndo(date) {
        var date = new Date(date);
        var tahun = date.getFullYear();
        var bulan = date.getMonth();
        var tanggal = date.getDate();
        var hari = date.getDay();
        var jam = date.getHours();
        var menit = date.getMinutes();
        var detik = date.getSeconds();
        switch(hari) {
          case 0: hari = "Minggu"; break;
          case 1: hari = "Senin"; break;
          case 2: hari = "Selasa"; break;
          case 3: hari = "Rabu"; break;
          case 4: hari = "Kamis"; break;
          case 5: hari = "Jum'at"; break;
          case 6: hari = "Sabtu"; break;
        }
        switch(bulan) {
          case 0: bulan = "Januari"; break;
          case 1: bulan = "Februari"; break;
          case 2: bulan = "Maret"; break;
          case 3: bulan = "April"; break;
          case 4: bulan = "Mei"; break;
          case 5: bulan = "Juni"; break;
          case 6: bulan = "Juli"; break;
          case 7: bulan = "Agustus"; break;
          case 8: bulan = "September"; break;
          case 9: bulan = "Oktober"; break;
          case 10: bulan = "November"; break;
          case 11: bulan = "Desember"; break;
        }
        var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
        var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;

        return tampilTanggal;
      }

      function format_rupiah(bilangan) {
        var	number_string = bilangan.toString(),
          split	= number_string.split('.'),
          sisa 	= split[0].length % 3,
          rupiah 	= split[0].substr(0, sisa),
          ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
          separator = sisa ? ',' : '';
          rupiah += separator + ribuan.join(',');
        }
        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;

        return rupiah;
      }

      function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^.\d]/g, "").toString(),
          split = number_string.split("."),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
          separator = sisa ? "," : "";
          rupiah += separator + ribuan.join(",");
        }

        rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
      }

      /* fungsi rupiah titik */
      function format_rupiah_titik(bilangan) {
        var	number_string = bilangan.toString(),
          split	= number_string.split(','),
          sisa 	= split[0].length % 3,
          rupiah 	= split[0].substr(0, sisa),
          ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return rupiah;
      }
      function formatRupiahTitik(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
  
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
      }
    </script>

    @yield('script')
</body>
</html>

@endguest
