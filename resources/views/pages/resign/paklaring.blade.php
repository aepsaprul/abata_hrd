<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('public/assets/logo-daun.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Surat Paklaring</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/themes/dist/css/adminlte.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Zen Antique Soft', serif;
        }
    </style>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        <div class="row">
            <div class="col-md-1">
                <img src="{{ asset('public/assets/paklaring.jpg') }}" alt="">
            </div>
            <div class="col-md-11">
                <div class="row m-2">
                    <div class="col-md-12 text-right">
                        <img src="{{ asset('public/assets/logo-biru.png') }}" style="max-width: 200px;">
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12 text-center">
                        <h4 class="text-uppercase"><u>Surat Keterangan Pengalaman Kerja</u></h4>
                        <p>No : 09.000/SKet/Abata/HC/VIII/2021</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12">
                        <p>Yang bertanda tangan di bawah ini, Human Capital Manager CV. Abata , menerangkan bahwa :</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12">
                        <table class="mb-3">
                            <tr>
                                <td class="pr-3">Nama</td>
                                <td class="pr-3">:</td>
                                <td class="pr-3">{{ $karyawan->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="pr-3">Alamat</td>
                                <td class="pr-3">:</td>
                                <td class="pr-3">{{ $karyawan->alamat_asal }}</td>
                            </tr>
                            <tr>
                                <td class="pr-3">Jabatan</td>
                                <td class="pr-3">:</td>
                                <td class="pr-3 text-uppercase">
                                    @if ($karyawan->masterJabatan)
                                        {{ $karyawan->masterJabatan->nama_jabatan }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md-12">
                        <p style="text-align: justify">
                            Adalah benar pernah bekerja sebagai karyawan CV. Abata yang mulai bekerja terhitung pada tanggal
                            @if ($kontrak_awal != "kosong")
                                {{ tgl_indo($kontrak_awal) }}
                            @else
                                _____
                            @endif sampai dengan tanggal

                            @if ($kontrak_akhir != "kosong")
                                {{ tgl_indo($kontrak_akhir) }}.
                            @else
                                _____
                            @endif
                        </p style="text-align: justify">
                        <p>
                            Selama bekerja Saudara {{ $karyawan->nama_lengkap }} telah menunjukkan dedikasi serta loyalitas yang sangat baik terhadap perusahaan kami dan tidak pernah melakukan penyelewengan tugas.
                        </p>
                        <p style="text-align: justify">
                            Demikian surat ini kami buat dengan sebenarnya agar dapat dipergunakan dengan sebaik-baiknya.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-end m-2">
                    <div class="col-md-3">
                        <table>
                            <tr>
                                <td class="text-center">Purwokerto, {{ tgl_indo(date('Y-m-d')) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center pt-3 pb-3"><img src="{{ asset('public/assets/ttd_pak_wahyu.png') }}" alt="ttd direktur" style="max-width: 200px;"></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <u>Wahyu Mardiyanto, SE</u>
                                    <br>
                                    Direktur
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="footer" style="font-size: 12px; margin-top: 400px; margin-left: 30px;">
                    Alamat : Jl. Moch. Yamin Gang III No.5, Karangpucung, Purwokerto Selatan
                    <br>
                    Phone  : (0281) 637 753
                    <br>
                    Email   : haehoecemerlang@gmail.com
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/themes/dist/js/adminlte.min.js') }}"></script>

    <script>
        window.print();
    </script>
</body>
</html>
