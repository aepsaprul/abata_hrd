@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Formulir</h1>
            </div>
        </div>
    </div>
	</section>

	<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session('status'))
                        <div class="alert alert-success">
                                {{session('status')}}
                        </div>
                    @endif
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ $nama_karyawan->nama_lengkap }}
                            </h3>
                            <div class="card-tools mr-0">
                                <a href="{{ route('resign.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('resign.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                {{-- karyawan id --}}
                                <input type="hidden" name="master_karyawan_id" id="master_karyawan_id" value="{{ $nama_karyawan->id }}">

                                {{-- formulir resign  --}}
                                <div id="formulir_resign">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>
                                                <select name="master_jabatan_id" id="resign_jabatan" class="form-control select2" style="width: 100%;" required>
                                                    <option value="">--Pilih Bagian--</option>
                                                    @foreach ($jabatans as $jabatan)
                                                        <option value="{{ $jabatan->id }}"
                                                            @if ($nama_karyawan->master_jabatan_id == $jabatan->id)
                                                                selected
                                                            @else
                                                            @endif
                                                                >{{ $jabatan->nama_jabatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Kerja</td>
                                            <td>:</td>
                                            <td>
                                                <select name="lokasi_kerja" id="resign_lokasi" class="form-control select2" style="width: 100%;" required>
                                                    <option value="">--Pilih Cabang--</option>
                                                    @foreach ($cabangs as $cabang)
                                                        <option value="{{ $cabang->nama_cabang }}"
                                                            @if ($nama_karyawan->master_cabang_id == $cabang->id)
                                                                selected
                                                            @else
                                                            @endif
                                                                >{{ $cabang->nama_cabang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Masuk</td>
                                            <td>:</td>
                                            <td><input type="text" name="tanggal_masuk" id="resign_tanggal_masuk" class="form-control" value="{{ $tanggal_masuk }}" autocomplete="off" required></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Efektif Keluar</td>
                                            <td>:</td>
                                            <td><input type="text" name="tanggal_keluar" id="resign_tanggal_keluar" class="form-control" autocomplete="off" required></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Rumah yang ditempati</td>
                                            <td>:</td>
                                            <td><input type="text" name="alamat" id="resign_alamat" class="form-control" value="{{ $nama_karyawan->alamat_domisili }}" onkeyup="this.value = this.value.toUpperCase()" required></td>
                                        </tr>
                                        <tr>
                                            <td>No Telp / HP</td>
                                            <td>:</td>
                                            <td><input type="number" name="telepon" id="resign_telepon" class="form-control" value="{{ $nama_karyawan->telepon }}" required></td>
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
                                <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                                    <span class="spinner-grow spinner-grow-sm"></span>
                                    Loading..
                                </button>
                                <button type="submit" class="btn btn-primary btn-save" style="width: 130px;"><i class="fa fa-save"></i> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

<!-- InputMask -->
<script src="{{ asset('public/themes/plugins/moment/moment.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/themes/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('public/themes/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('public/themes/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $( "#resign_tanggal_masuk" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_keluar" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_kewajiban_keuangan" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_serah_terima" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_id_card" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_seragam_karyawan" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_laptop" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_peralatan_kantor" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_penghapusan_akun" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_penghapusan_chat" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_penutupan_rekening" ).datepicker({
            dateFormat: "yy-mm-dd"
		});
		$( "#resign_tanggal_lain" ).datepicker({
            dateFormat: "yy-mm-dd"
		});

        $('.btn-save').on('click', function () {
            $('.btn-spinner').removeClass('d-none');
            $('.btn-save').addClass('d-none');
        });
	});
</script>
@endsection

