@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<style>
  html {
    scroll-behavior: smooth;
  }
  #backToTop {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #d10000;
  color: white;
  cursor: pointer;
  padding: 5px 10px;
  border-radius: 50%;
  opacity: 0; /* Awalnya tidak terlihat */
  transition: opacity 0.5s ease, visibility 0.5s ease; /* Tambahkan transisi pada opacity dan visibility */
  }

  #backToTop.show {
  display: block;
  opacity: 1; /* Muncul secara bertahap */
  visibility: visible; /* Pastikan tombol terlihat */
  }

  #backToTop:hover {
    background-color: #333;
  }

</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard
                        {{-- <a href="{{ route('dashboard.rekap.download') }}">rekap</a> --}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><a href="#to_tabel_karyawan_aktif" class="text-dark">Karyawan Aktif</a></span>
                            <span class="info-box-number">{{ $count_karyawan_aktif }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><a href="#to_tabel_karyawan_nonaktif" class="text-dark">Karyawan Nonaktif</a></span>
                            <span class="info-box-number">{{ $count_karyawan_nonaktif }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-mug-hot"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><a href="#to_tabel_cuti" class="text-dark">Pengajuan Cuti</a></span>
                            <span class="info-box-number">{{ $count_cuti }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><a href="#to_tabel_resign" class="text-dark">Pengajuan Resign</a></span>
                            <span class="info-box-number">{{ $count_resign }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-male"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Karyawan Pria</span>
                    <span class="info-box-number">{{ count($karyawan_pria) }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-female"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Karyawan Wanita</span>
                    <span class="info-box-number">{{ count($karyawan_wanita) }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-lime elevation-1"><i class="fas fa-file-signature"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"><a href="#to_tabel_kontrak" class="text-dark">Habis Kontrak</a></span>
                    <span class="info-box-number">{{ $total_karyawan_kontrak }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-file-signature"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"><a href="#to_tabel_lewat_kontrak" class="text-dark">Belum PKWT</a></span>
                    <span class="info-box-number">{{ $total_karyawan_lewat_kontrak }}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title font-weight-bold text-uppercase">Jumlah Total Karyawan Per Bulan</h5>
                    </div>
                    <div class="card-body">
                      <canvas id="employeeChart"></canvas>
                    </div>
                  </div>

                    {{-- karyawan kontrak --}}
                    <div id="to_tabel_kontrak" class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Karyawan Kontrak</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_kontrak" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Mulai Kontrak</th>
                                        <th class="text-center text-indigo">Akhir Kontrak</th>
                                        <th class="text-center text-indigo">Hari Tersisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($karyawan_kontraks as $kontrak)
                                    @if($kontrak->akhir_kontrak) {{-- Pastikan ada kontrak --}}
                                      <tr>
                                        <td>{{ $kontrak->nama_lengkap }}</td>
                                        <td class="text-center">{{ $kontrak->mulai_kontrak }}</td>
                                        <td class="text-center">{{ $kontrak->akhir_kontrak }}</td>
                                        <td class="text-right"><strong>{{ $kontrak->sisa_hari }}</strong> hari</td>
                                      </tr>
                                    @endif
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- karyawan lewat kontrak --}}
                    <div id="to_tabel_lewat_kontrak" class="card">
                      <div class="card-header">
                        <h5 class="card-title font-weight-bold text-uppercase">Karyawan Lewat Kontrak</h5>
                      </div>
                      <div class="card-body">
                        <table id="tabel_karyawan_lewat_kontrak" class="table table-bordered" style="font-size: 13px; width: 100%;">
                          <thead>
                            <tr>
                              <th class="text-center text-indigo">Nama</th>
                              <th class="text-center text-indigo">Mulai Kontrak</th>
                              <th class="text-center text-indigo">Akhir Kontrak</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($karyawan_lewat_kontraks as $lewat_kontrak)
                              @if($lewat_kontrak->kontrak->isNotEmpty()) {{-- Pastikan ada kontrak --}}
                                <tr>
                                  <td>{{ $lewat_kontrak->nama_lengkap }}</td>
                                  <td class="text-center">{{ $lewat_kontrak->kontrak->first()->mulai_kontrak }}</td>
                                  <td class="text-center">{{ $lewat_kontrak->kontrak->first()->akhir_kontrak }}</td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>

                    {{-- karyawan aktif --}}
                    <div id="to_tabel_karyawan_aktif" class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Karyawan Aktif</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_aktif" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan_aktif as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td class="text-center">{{ $item->telepon }}</td>
                                            <td>{{ $item->masterCabang->nama_cabang }}</td>
                                            <td>
                                                @if ($item->masterJabatan)
                                                    {{ $item->masterJabatan->nama_jabatan }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- karyawan nonaktif --}}
                    <div id="to_tabel_karyawan_nonaktif" class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase" style="font-weight: 600;">Karyawan Nonaktif</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_karyawan_nonaktif" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Cabang</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan_nonaktif as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td class="text-center">{{ $item->telepon }}</td>
                                            <td>{{ $item->masterCabang->nama_cabang }}</td>
                                            <td>{{ $item->masterJabatan->nama_jabatan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- cuti --}}
                    <div id="to_tabel_cuti" class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase"><strong>Pengajuan Cuti</strong></h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_cuti" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Alasan</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuti as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                @if ($item->masterKaryawan)
                                                    {{ $item->masterKaryawan->nama_lengkap }}
                                                    <br>
                                                    @if (file_exists(env('APP_URL_IMG').'image/' . $item->masterKaryawan->foto))
                                                        @if ($item->masterKaryawan->foto)
                                                            <img src="{{ asset(env('APP_URL_IMG').'image/' . $item->masterKaryawan->foto) }}" alt="img" style="max-width: 100px;">
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $item->alasan }}</td>
                                            <td class="text-capitalize">{{ $item->status_approve }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- resign --}}
                    <div id="to_tabel_resign" class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Pengajuan Resign</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_resign" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Karyawan</th>
                                        <th class="text-center text-indigo">Alasan</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resign as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                @if ($item->masterKaryawan)
                                                    {{ $item->masterKaryawan->nama_panggilan }}

                                                    @if ($item->approved_percentage >= 100)
                                                        @if ($item->status == 1)
                                                            <span class="float-right">
                                                                <a href="{{ route('resign.paklaring', [$item->masterKaryawan->id]) }}" target="_blank">
                                                                    <i class="fas fa-download ml-2"></i> Paklaring
                                                                </a>
                                                            </span>
                                                        @endif
                                                    @endif

                                                    <br>
                                                    @if (file_exists(env('APP_URL_IMG').'image/' . $item->masterKaryawan->foto))
                                                        @if ($item->masterKaryawan->foto)
                                                            <center><img src="{{ asset(env('APP_URL_IMG').'image/' . $item->masterKaryawan->foto) }}" alt="img" style="max-width: 100px;"></center>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $item->alasan }}</td>
                                            <td class="text-capitalize">{{ $item->status_approve }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- back to top --}}
<button id="backToTop" title="Go to top"><i class="fas fa-arrow-up"></i></button>

{{-- modal show --}}
<div class="modal fade modal-show" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="kontrak_form">

                    {{-- id --}}
                    <input type="hidden" name="show_id" id="show_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="show_nama_lengkap">Nama Lengkap</label>
                                        <input type="text" id="show_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" readonly>
                                        <small id="error_nama_lengkap" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="mulai_kontrak" class="col-form-label col-form-label-sm">Mulai Kontrak</label>
                                        <input type="date" class="form-control form-control-sm" id="mulai_kontrak" name="mulai_kontrak">
                                        <small id="error_mulai_kontrak" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="akhir_kontrak" class="col-form-label col-form-label-sm">Akhir Kontrak</label>
                                        <input type="date" class="form-control form-control-sm" id="akhir_kontrak" name="akhir_kontrak">
                                        <small id="error_akhir_kontrak" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="lama_kontrak" class="col-form-label col-form-label-sm">Lama Kontrak</label>
                                        <input type="text" class="form-control form-control-sm" id="lama_kontrak" name="lama_kontrak" readonly>
                                        <small id="error_lama_kontrak" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-kontrak-spinner d-none" disabled style="width: 130px;">
                                        <span class="spinner-grow spinner-grow-sm"></span>
                                        Loading...
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-kontrak-save"
                                        style="width: 130px;">
                                            <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <table class="table table-bordered" style="font-size: 14px; width: 100%;">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="text-center">Mulai Kontrak</th>
                                                <th class="text-center">Akhir Kontrak</th>
                                                <th class="text-center">Lama Kontrak</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_kontrak"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- moment js --}}
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/moment/moment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-precise-range-plugin@1.3.0/moment-precise-range.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset(env('APP_URL_IMG').'themes/plugins/chart.js/Chart.min.js') }}"></script>

<script>
  // back to top
  // Ambil elemen tombol
  let backToTopButton = document.getElementById("backToTop");

  // Ketika pengguna menggulir 20px dari atas dokumen, tampilkan tombol
  window.onscroll = function() {
    scrollFunction();
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      backToTopButton.classList.add("show"); // Tambahkan kelas show
    } else {
      backToTopButton.classList.remove("show"); // Hapus kelas show
    }
  }

  // Ketika pengguna mengklik tombol, gulirkan ke atas halaman
  backToTopButton.addEventListener('click', function() {
    document.body.scrollTop = 0; // Untuk Safari
    document.documentElement.scrollTop = 0; // Untuk Chrome, Firefox, IE, dan Opera
  });

    $(function () {
      $("#tabel_karyawan_kontrak").DataTable({
        'responsive': true,
        'order': [[2, 'asc']]
      });
      
      $("#tabel_karyawan_lewat_kontrak").DataTable({
        'responsive': true
      });
      $("#tabel_karyawan_aktif").DataTable({
        'responsive': true
      });
      $("#tabel_karyawan_nonaktif").DataTable({
        'responsive': true
      });
      $("#tabel_cuti").DataTable({
        'responsive': true
      });
      $("#tabel_resign").DataTable({
        'responsive': true
      });
    });

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

      $(document).on('click', '.btn-detail', function (e) {
        e.preventDefault();
        $('#data_kontrak').empty();

        let id = $(this).attr('data-id');
        let url = '{{ route("dashboard.show", ":id") }}';
        url = url.replace(':id', id );

        $.ajax({
          url: url,
          type: "get",
          success: function (response) {
            $('#show_nama_lengkap').val(response.karyawan.nama_lengkap);
            $('#show_id').val(response.karyawan.id);

            let data_kontrak = "";
            $.each(response.karyawan_kontraks, function (index, item) {
              data_kontrak += "" +
                "<tr>" +
                  "<td class='text-center'> " + tanggalIndo(item.mulai_kontrak) + " </td>" +
                  "<td class='text-center'> " + tanggalIndo(item.akhir_kontrak) + " </td>" +
                  "<td class='text-center'> " + item.lama_kontrak + " </td>" +
                "</tr>";
            })
            $('#data_kontrak').append(data_kontrak);

            $('.modal-show').modal('show');
          }
        })
      })

      $('#mulai_kontrak').on('change', function() {
        if ($('#akhir_kontrak').val() != "") {
          kontrakCalculate();
        }
      });

      $('#akhir_kontrak').on('change', function() {
        if ($('#mulai_kontrak').val() != "") {
          kontrakCalculate();
        }
      });

      function kontrakCalculate() {
        var a = moment($('#mulai_kontrak').val());
        var b = moment($('#akhir_kontrak').val());
        diff = moment.preciseDiff(a, b, true);

        intervals = ['years', 'months'];
        intervalse = ['TAHUN', 'BULAN'];
        output = [];

        for(var i = 0; i < intervals.length; i++) {
          var e = diff[intervals[i]];
          var d = e < 10 ? '' + e : e;
          output.push(d + ' ' + intervalse[i] + ' ');
        }

        $('#lama_kontrak').val(output);
      }

      $('#kontrak_form').submit(function(e) {
        e.preventDefault();
        if ($('#mulai_kontrak').val() == "" || $('#akhir_kontrak').val() == "") {
            alert('Tanggal tidak boleh kosong');
        } else {
          var formData = {
            id: $('#show_id').val(),
            mulai_kontrak: $('#mulai_kontrak').val(),
            akhir_kontrak: $('#akhir_kontrak').val(),
            lama_kontrak: $('#lama_kontrak').val()
          }

          $.ajax({
            url: "{{ URL::route('dashboard.store') }}",
            type: 'POST',
            data: formData,
            beforeSend: function() {
              $('.btn-kontrak-spinner').removeClass('d-none');
              $('.btn-kontrak-save').addClass('d-none');
            },
            success: function(response) {
              Toast.fire({
                icon: 'success',
                title: 'Kontrak behasil diperbaharui'
              });

              setTimeout(() => {
                window.location.reload(1);
              }, 1000);
            },
            error: function(xhr, status, error) {
              var errorMessage = xhr.status + ': ' + error

              Toast.fire({
                icon: 'error',
                title: 'Error - ' + errorMessage
              });
            }
          });
        }
      });

      totalKaryawanPerBulan();
      function totalKaryawanPerBulan() {
        $.ajax({
            url: "{{ URL::route('dashboard.getTotalKaryawanPerBulan') }}",
            method: "GET",
            success: function(data) {
                const ctx = document.getElementById('employeeChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Bisa diubah ke 'bar' atau jenis chart lain
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Jumlah Karyawan',
                            data: data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
      }
    })
</script>
@endsection
