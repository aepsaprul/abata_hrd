@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Resign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Resign</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Lokasi Kerja</th>
                                        <th class="text-center text-indigo">Tanggal Masuk</th>
                                        <th class="text-center text-indigo">Tanggal Keluar</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resigns as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->lokasi_kerja }}</td>
                                            <td class="text-center">{{ $item->tanggal_masuk }}</td>
                                            <td class="text-center">{{ $item->tanggal_keluar }}</td>
                                            <td>
                                                @if ($item->approved_percentage > 100)
                                                    @php
                                                        $percent = 100;
                                                    @endphp
                                                @else
                                                    @php
                                                        $percent = $item->approved_percentage
                                                    @endphp
                                                @endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $item->approved_background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percent }}%;">
                                                            <span class="">{{ $percent }}%</span>
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px;">
                                                    {{ $item->approved_text }} {{ $item->approvedLeader ? $item->approvedLeader->nama_panggilan : "" }}
                                                </span>
                                            </td>
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

<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Form Pengajuan Resign</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        {{-- formulir resign  --}}
                        <div id="formulir_resign">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lokasi Kerja</td>
                                    <td>:</td>
                                    <td><input type="text" name="cabang" id="cabang" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>:</td>
                                    <td><input type="text" name="tanggal_masuk" id="resign_tanggal_masuk" class="form-control" autocomplete="off" required></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Efektif Keluar</td>
                                    <td>:</td>
                                    <td><input type="text" name="tanggal_keluar" id="resign_tanggal_keluar" class="form-control" autocomplete="off" required></td>
                                </tr>
                                <tr>
                                    <td>Alamat Rumah yang ditempati</td>
                                    <td>:</td>
                                    <td><input type="text" name="alamat" id="resign_alamat" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required></td>
                                </tr>
                                <tr>
                                    <td>No Telp / HP</td>
                                    <td>:</td>
                                    <td><input type="text" name="telepon" id="telepon" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <ol>
                                            <li style="text-align: justify">
                                                Saya menyatakan segala data yang berhubungan dengan perusahaan Abata dalam bentuk dokumen tertulis,data dalam social media yang tertuang dalam aplikasi WhatsApp,email, faceboook, Instagram ataupun media social lainnya yang berhubungan dengan Abata dan/atau informasi yang saya terima selama saya bekerja di Abata baik secara langsung maupun tidak langsung adalah bukan menjadi hak saya, dan tidak akan memberikan kepada siapapun dalam bentuk apapun tanpa izin dari Abata serta bersedia untuk menghapus,memusnahkan dan/atau mengembalikan semua data yang telah menjadi millik dan hak Abata dalam bentuk apapun dan saya akan tetap bertanggung jawab untuk tetap menjaga kerahasiaan perusahaan
                                            </li>
                                            <li style="text-align: justify">
                                                Saya menyatakan sebelum efektif keluar untuk menyelesaikan segala kewajiban keuangan dan lainnya yang saya miliki terhadap Abata dan apabila sampai dengan tanggal efektif saya keluar segala kewajiban tersebut belum terselesaikan dengan baik maka saya bersedia untuk dilakukan penyelesaian kewajiban tersebut sampai dengan selesai dan jika tidak dapat diselesaikan dengan secara kekeluargaan saya bersedia diselesaikan melalui proses hukum yang berlaku di Indonesia
                                            </li>
                                            <li style="text-align: justify">
                                                Daftar Penyelesaian Kewajiban Karyawan (lakukan checklist jika sudah dilakukan penyelesaian coret tidak perlu)
                                                <table class="mt-3">
                                                    <tr>
                                                        <td>Kewajiban keuangan</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_kewajiban_keuangan" id="resign_ceklis_kewajiban_keuangan" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_kewajiban_keuangan" id="resign_ceklis_kewajiban_keuangan" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_kewajiban_keuangan" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="kewajiban keuangan">
                                                    </tr>
                                                    <tr>
                                                        <td>Serah terima kerja</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_serah_terima" id="resign_ceklis_serah_terima" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_serah_terima" id="resign_ceklis_serah_terima" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_serah_terima" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="serah terima kerja">
                                                    </tr>
                                                    <tr>
                                                        <td>ID Card karyawan</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_id_card" id="resign_ceklis_id_card" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_id_card" id="resign_ceklis_id_card" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_id_card" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="id card karyawan">
                                                    </tr>
                                                    <tr>
                                                        <td>Seragam karyawan</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_seragam_karyawan" id="resign_ceklis_seragam_karyawan" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_seragam_karyawan" id="resign_ceklis_seragam_karyawan" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_seragam_karyawan" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="seragam karyawan">
                                                    </tr>
                                                    <tr>
                                                        <td>Laptop</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_laptop" id="resign_ceklis_laptop" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_laptop" id="resign_ceklis_laptop" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_laptop" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="laptop">
                                                    </tr>
                                                    <tr>
                                                        <td>Peralatan kantor</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_peralatan_kantor" id="resign_ceklis_peralatan_kantor" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_peralatan_kantor" id="resign_ceklis_peralatan_kantor" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_peralatan_kantor" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="peralatan kantor">
                                                    </tr>
                                                    <tr>
                                                        <td>Penghapusan email dan akun yg berhubungan dengan kantor</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_penghapusan_akun" id="resign_ceklis_penghapusan_akun" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_penghapusan_akun" id="resign_ceklis_penghapusan_akun" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_penghapusan_akun" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="penghapusan email dan akun yg berhubungan dengan kantor">
                                                    </tr>
                                                    <tr>
                                                        <td>Penghapusan chat WA</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_penghapusan_chat" id="resign_ceklis_penghapusan_chat" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_penghapusan_chat" id="resign_ceklis_penghapusan_chat" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_penghapusan_chat" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="penghapusan chat wa">
                                                    </tr>
                                                    <tr>
                                                        <td>Penutupan rekening bank berhubungan dengan kantor</td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_penutupan_rekening" id="resign_ceklis_penutupan_rekening" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_penutupan_rekening" id="resign_ceklis_penutupan_rekening" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_penutupan_rekening" class="form-control" autocomplete="off">
                                                        </td>
                                                        <input type="hidden" name="resign_ceklis[]" value="penutupan rekening bank berhubungan dengan kantor">
                                                    </tr>
                                                    <tr>
                                                        <td>Lain lain <input type="text" class="form-control" name="resign_ceklis[]" value="kosong"></td>
                                                        <td>
                                                            <input type="radio" name="resign_ceklis_lain" id="resign_ceklis_lain" value="ada"> Ada
                                                            <input type="radio" name="resign_ceklis_lain" id="resign_ceklis_lain" value="tidak"> Tidak
                                                        </td>
                                                        <td>
                                                            Tgl Selesai : <input type="text" name="resign_ceklis_tanggal[]" id="resign_tanggal_lain" class="form-control" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                            </table>
                            <label>Pilihlah satu diantara Sangat Tidak Setuju sampai dengan Sangat Setuju pada setiap pernyataan berikut ini:</label>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" colspan="2" style="width: 50%">ASPEK KEBUTUHAN DASAR</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Secara umum saya merasa puas selama bekerja di Abata/Wahana/perfecta Utama">
                                    <td>1.</td>
                                    <td>Secara umum saya merasa puas selama bekerja di Abata/Wahana/perfecta Utama</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_1" id="resign_survei_ceklis_keterangan_1" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya tahu apa yang diharapkan atasan dan perusahaan kepada saya.">
                                    <td>2.</td>
                                    <td>Saya tahu apa yang diharapkan atasan dan perusahaan kepada saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_2" id="resign_survei_ceklis_keterangan_2" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Atasan saya memberikan pengarahan yang jelas mengenai target kerja yang harus saya capai.">
                                    <td>3.</td>
                                    <td>Atasan saya memberikan pengarahan yang jelas mengenai target kerja yang harus saya capai.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_3" id="resign_survei_ceklis_keterangan_3" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya memiliki peralatan bantu yang memadai untuk menyelesaikan setiap tugas saya.">
                                    <td>4.</td>
                                    <td>Saya memiliki peralatan bantu yang memadai untuk menyelesaikan setiap tugas saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_4" id="resign_survei_ceklis_keterangan_4" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Waktu kerja yang saya miliki sesuai dengan beban pekerjaan saya.">
                                    <td>5.</td>
                                    <td>Waktu kerja yang saya miliki sesuai dengan beban pekerjaan saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_5" id="resign_survei_ceklis_keterangan_5" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">ASPEK TIM KERJA</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Rekan tim kerja saya menghargai pendapat saya.">
                                    <td>6.</td>
                                    <td>Rekan tim kerja saya menghargai pendapat saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_6" id="resign_survei_ceklis_keterangan_6" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Rekan tim kerja saya selalu memberikan hasil terbaik dalam bekerja.">
                                    <td>7.</td>
                                    <td>Rekan tim kerja saya selalu memberikan hasil terbaik dalam bekerja.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_7" id="resign_survei_ceklis_keterangan_7" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Di tim kerja, saya memiliki sahabat yang dapat saya ajak bertukar pikirandan berbicara secara personal.">
                                    <td>8.</td>
                                    <td>Di tim kerja, saya memiliki sahabat yang dapat saya ajak bertukar pikirandan berbicara secara personal.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_8" id="resign_survei_ceklis_keterangan_8" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya mengenal secara pribadi setiap anggota tim kerja saya.">
                                    <td>9.</td>
                                    <td>Saya mengenal secara pribadi setiap anggota tim kerja saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_9" id="resign_survei_ceklis_keterangan_9" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya paham arti penting pekerjaan saya dalam upaya pencapaian Misi dan Visi.">
                                    <td>10.</td>
                                    <td>Saya paham arti penting pekerjaan saya dalam upaya pencapaian Misi dan Visi.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_10" id="resign_survei_ceklis_keterangan_10" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">ASPEK KONTRIBUSI</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya memiliki ketrampilan dan keahlian yang memadai untuk	menyelesaikan tugas sehari-hari saya.">
                                    <td>11.</td>
                                    <td>Saya memiliki ketrampilan dan keahlian yang memadai untuk	menyelesaikan tugas sehari-hari saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_11" id="resign_survei_ceklis_keterangan_11" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Atasan saya selalu memberikan pujian atau penghargaan setiap sayamelakukan pekerjaan dengan baik.">
                                    <td>12.</td>
                                    <td>Atasan saya selalu memberikan pujian atau penghargaan setiap sayamelakukan pekerjaan dengan baik.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_12" id="resign_survei_ceklis_keterangan_12" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Atasan saya memberikan bimibingan kepada saya secara teratur.">
                                    <td>13.</td>
                                    <td>Atasan saya memberikan bimibingan kepada saya secara teratur.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_13" id="resign_survei_ceklis_keterangan_13" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Rekan kerja dan atasan saya peduli kepada saya sebagai seorang manusia.">
                                    <td>14.</td>
                                    <td>Rekan kerja dan atasan saya peduli kepada saya sebagai seorang manusia.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_14" id="resign_survei_ceklis_keterangan_14" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Atasan atau rekan kerja saya selalu mendorong dan mendukung saya untuk berkembang.">
                                    <td>15.</td>
                                    <td>Atasan atau rekan kerja saya selalu mendorong dan mendukung saya untuk berkembang.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_15" id="resign_survei_ceklis_keterangan_15" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya memiliki kesempatan untuk melakukan pekerjaan sesuai dengan bakat yang saya miliki.">
                                    <td>16.</td>
                                    <td>Saya memiliki kesempatan untuk melakukan pekerjaan sesuai dengan bakat yang saya miliki.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_16" id="resign_survei_ceklis_keterangan_16" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">ASPEK PERUSAHAAN</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Setiap orang di perusahaan ini diberikan kesempatan yang sama tanpa menghiraukan latar belakang etnis, gender, usia, ketidak-mampuan, atau perbedaan lainnya.">
                                    <td>17.</td>
                                    <td>Setiap orang di perusahaan ini diberikan kesempatan yang sama tanpa menghiraukan latar belakang etnis, gender, usia, ketidak-mampuan, atau perbedaan lainnya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_17" id="resign_survei_ceklis_keterangan_17" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Para rekan kerja saya selalu saling terbuka dan jujur (kecuali terhadap kerahasiaan bisnis).">
                                    <td>18.</td>
                                    <td>Para rekan kerja saya selalu saling terbuka dan jujur (kecuali terhadap kerahasiaan bisnis).</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_18" id="resign_survei_ceklis_keterangan_18" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya akan merekomendasikan kepada teman dan keluargasebagai tempat yang menyenangkan untuk bekerja.">
                                    <td>19.</td>
                                    <td>Saya akan merekomendasikan kepada teman dan keluargasebagai tempat yang menyenangkan untuk bekerja.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_19" id="resign_survei_ceklis_keterangan_19" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">ASPEK PENGEMBANGAN</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Atasan saya memberitahu saya tentang kemajuan yang saya capai dalam setahun terakhir.">
                                    <td>20.</td>
                                    <td>Atasan saya memberitahu saya tentang kemajuan yang saya capai dalam setahun terakhir.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_20" id="resign_survei_ceklis_keterangan_20" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Di perusahaan ini saya berkesempatan mendapatkan pengembangan diri secara profesional dan personal.">
                                    <td>21.</td>
                                    <td>Di perusahaan ini saya berkesempatan mendapatkan pengembangan diri secara profesional dan personal.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_21" id="resign_survei_ceklis_keterangan_21" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Selama bekerja saya menentukan sendiri pengembangan karir seperti apa yang saya inginkan.">
                                    <td>22.</td>
                                    <td>Selama bekerja saya menentukan sendiri pengembangan karir seperti apa yang saya inginkan.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_22" id="resign_survei_ceklis_keterangan_22" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">ASPEK REWARDS</th>
                                    <th class="text-center">Sangat Setuju</th>
                                    <th class="text-center">Setuju</th>
                                    <th class="text-center">Ragu - ragu</th>
                                    <th class="text-center">Tidak Setuju</th>
                                    <th class="text-center">Sangat Tidak Setuju</th>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Sistem penggajian yang diterapkan saat ini sesuai dengan penilaian kinerja.">
                                    <td>23.</td>
                                    <td>Sistem penggajian yang diterapkan saat ini sesuai dengan penilaian kinerja.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_23" id="resign_survei_ceklis_keterangan_23" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Gaji saya kurang lebih sama dibandingkan perusahaan lain yang setara untuk pekerjaan sejenis">
                                    <td>24.</td>
                                    <td>Gaji saya kurang lebih sama dibandingkan perusahaan lain yang setara untuk pekerjaan sejenis</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_24" id="resign_survei_ceklis_keterangan_24" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saya memahami seluruh informasi mengenai benefit yang diberikan perusahaan kepada Karyawan.">
                                    <td>25.</td>
                                    <td>Saya memahami seluruh informasi mengenai benefit yang diberikan perusahaan kepada Karyawan.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_25" id="resign_survei_ceklis_keterangan_25" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Besarnya Insentif dan bonus yang diberikan perusahaan sesuai dengan	kebutuhan saya.">
                                    <td>26.</td>
                                    <td>Besarnya Insentif dan bonus yang diberikan perusahaan sesuai dengan	kebutuhan saya.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_26" id="resign_survei_ceklis_keterangan_26" value="sangat tidak setuju"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hc_resign_survei_nama_ceklis_id[]" value="Saat ini perhatian perusahaan sudah cukup baik dibanding perusahaan lain yang saya ketahui.">
                                    <td>27.</td>
                                    <td>Saat ini perhatian perusahaan sudah cukup baik dibanding perusahaan lain yang saya ketahui.</td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="ragu - ragu"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="tidak setuju"></td>
                                    <td class="text-center"><input type="radio" name="resign_survei_ceklis_keterangan_27" id="resign_survei_ceklis_keterangan_27" value="sangat tidak setuju"></td>
                                </tr>
                            </table>


                            <input type="hidden" name="hc_resign_survei_nama_essay_id[]" value="Alasan utama Anda mengundurkan diri (pilih salah satu) :">
                            <label for="">Alasan utama Anda mengundurkan diri (pilih salah satu) :</label>
                            <ol style="list-style-type: none;">
                                <li>
                                    <input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="pindah"> Pindah ke Perusahaan lain yaitu
                                    <input type="text" name="pindah_perusahaan">
                                </li>
                                <li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="melanjutkan sekolah"> Melanjutkan sekolah</li>
                                <li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="wiraswasta"> Wiraswasta</li>
                                <li><input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="tidak bekerja"> Tidak bekerja</li>
                                <li>
                                    <input type="radio" name="resign_survei_essay_1" id="resign_survei_essay_1" value="lainnya"> Lainnya
                                    <input type="text" name="teks_lainnya">
                                </li>
                            </ol>


                            <input type="hidden" name="hc_resign_survei_nama_essay_id[]" value="Jelaskan apa yang Anda rasakan dengan beban pekerjaan yang telah diberikan pada Anda dari awal masuk kerja hingga saat ini?">
                            <label for="">Jelaskan apa yang Anda rasakan dengan beban pekerjaan yang telah diberikan pada Anda dari awal masuk kerja hingga saat ini?</label><br>
                            <textarea name="resign_survei_essay_2" id="resign_survei_essay_2" rows="3" class="form-control"></textarea>


                            <input type="hidden" name="hc_resign_survei_nama_essay_id[]" value="Bagaimana hubungan kerja Anda di lingkungan kerja perusahaan ini?">
                            <label for="">Bagaimana hubungan kerja Anda di lingkungan kerja perusahaan ini?</label><br>
                            <p for="">
                                <input type="radio" name="essay_radio" id="essay_radio" value="baik, "> Baik, Jelaskan
                                <input type="radio" name="essay_radio" id="essay_radio" value="kurang baik, "> Kurang Baik, Jelaskan
                            </p>
                            <textarea name="resign_survei_essay_3" id="resign_survei_essay_3" rows="3" class="form-control"></textarea>


                            <input type="hidden" name="hc_resign_survei_nama_essay_id[]" value="Berikan pendapat Anda mengenai perusahaan ini sebagi bahan masukan bagi kami">
                            <label for="">Berikan pendapat Anda mengenai perusahaan ini sebagi bahan masukan bagi kami</label>
                            <textarea name="resign_survei_essay_4" id="resign_survei_essay_4" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable();
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

        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.create') }}",
                type: 'GET',
                success: function(response) {
                    $('#nama').val(response.karyawan.nama_lengkap);
                    $('#karyawan_id').val(response.karyawan.id);
                    $('#jabatan').val(response.karyawan.master_jabatan.nama_jabatan);
                    $('#jabatan_id').val(response.karyawan.master_jabatan.id);

                    // atasan
                    let value_atasan = "<option value=\"\">--Pilih Atasan--</option>";
                    $.each(response.atasans, function (index, item) {
                        value_atasan += "<option value=\"" + item.id + "\">" + item.nama_lengkap + "</option>";
                    });
                    $('#atasan').append(value_atasan);

                    // pengganti
                    let value_pengganti = "<option value=\"\">--Pilih Pengganti--</option>";
                    $.each(response.pengganti, function (index, item) {
                        value_pengganti += "<option value=\"" + item.id + "\">" + item.nama_lengkap + "</option>";
                    });
                    $('#pengganti').append(value_pengganti);

                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#nama').focus();

            $('.select_atasan').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-form")
            });

            $('.select_pengganti').select2({
                theme: 'bootstrap4',
                dropdownParent: $(".modal-form")
            });
        });

        $(document).on('submit', '#form', function (e) {
            e.preventDefault();

            $('#error_nama').empty();
            $('#error_jabatan').empty();
            $('#error_atasan').empty();
            $('#error_telepon').empty();
            $('#error_jenis').empty();
            $('#error_jml_hari').empty();
            $('#error_form_tanggal').empty();
            $('#error_pengganti').empty();
            $('#error_alasan').empty();

            var formData = new FormData($('#form')[0]);

            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#error_nama').append(response.errors.nama);
                        $('#error_jabatan').append(response.errors.jabatan);
                        $('#error_atasan').append(response.errors.atasan);
                        $('#error_telepon').append(response.errors.telepon);
                        $('#error_jenis').append(response.errors.jenis);
                        $('#error_jml_hari').append(response.errors.jml_hari);
                        $('#error_form_tanggal').append(response.errors.form_tanggal);
                        $('#error_pengganti').append(response.errors.pengganti);
                        $('#error_alasan').append(response.errors.alasan);

                        $('.btn-spinner').addClass('d-none');
                        $('.btn-save').removeClass('d-none');
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil ditambah'
                        });

                        setTimeout(() => {
                            window.location.reload(1);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                    setTimeout(() => {
                        $('.btn-spinner').addClass('d-none');
                        $('.btn-save').removeClass('d-none');
                    }, 1000);
                }
            });
        });

        $('#form_cuti_lainnya').hide();

        $('input[name="jenis"]').change(function () {
            if ($("#cuti_jenis_5").is(":checked")) {
                $('#form_cuti_lainnya').show();
                $('#form_cuti_lainnya').prop('required', true);
            }
            else {
                $('#form_cuti_lainnya').hide();
            }
        });

		$('#jml_hari').on('change', function () {
			var jml_hari = $(this).val();
			$('#form_tanggal').empty();

			for (let index = 1; index <= jml_hari; index++) {

				var form_tanggal = "<br>" +
					"<div class=\"row\">" +
						"<div class=\"col-md-3\">" +
							"<label for=\"\">Tanggal " + index + "</label>" +
						"</div>" +
						"<div class=\"col-md-9\">" +
							"<input type=\"date\" name=\"cuti_tanggal[]\" id=\"cuti_tanggal_" + index + "\" class=\"form-control\" autocomplete=\"off\" required>" +
						"</div>" +
					"</div>";

				$('#form_tanggal').append(form_tanggal);
			}
		});
    });
</script>

@endsection
