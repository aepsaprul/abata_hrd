@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Karyawan Rekap</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
            <li class="breadcrumb-item active">Rekap</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body d-flex overflow-auto">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="font-weight: bold; text-align: center;" rowspan="2">No</th>
                    <th style="font-weight: bold; text-align: center;" rowspan="2">Cabang</th>
                    <th style="font-weight: bold; text-align: center;" colspan="3">Jumlah Karyawan</th>
                    <th style="font-weight: bold; text-align: center;" colspan="9">Tingkat Pendidikan</th>
                    <th style="font-weight: bold; text-align: center;" colspan="2">BPJS TK</th>
                    <th style="font-weight: bold; text-align: center;" colspan="2">BPJS Kesehatan</th>
                    <th style="font-weight: bold; text-align: center;" colspan="4">Status Pernikahan</th>
                    <th style="font-weight: bold; text-align: center;" colspan="5">Penggolongan Usia</th>
                  </tr>
                  <tr>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">Laki - laki</div></th>
                    <th style="font-weight: bold; text-align: center;">Perempuan</th>
                    <th style="font-weight: bold; text-align: center;">Total</th>
                    <th style="font-weight: bold; text-align: center;">SD</th>
                    <th style="font-weight: bold; text-align: center;">SMP</th>
                    <th style="font-weight: bold; text-align: center;">SMA</th>
                    <th style="font-weight: bold; text-align: center;">D1</th>
                    <th style="font-weight: bold; text-align: center;">D2</th>
                    <th style="font-weight: bold; text-align: center;">D3</th>
                    <th style="font-weight: bold; text-align: center;">S1</th>
                    <th style="font-weight: bold; text-align: center;">S2</th>
                    <th style="font-weight: bold; text-align: center;">Total</th>
                    <th style="font-weight: bold; text-align: center;">Terdaftar</th>
                    <th style="font-weight: bold; text-align: center;">Belum</th>
                    <th style="font-weight: bold; text-align: center;">Terdaftar</th>
                    <th style="font-weight: bold; text-align: center;">Belum</th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 100px;">Belum Kawin</div></th>
                    <th style="font-weight: bold; text-align: center;">Kawin</th>
                    <th style="font-weight: bold; text-align: center;">Duda</th>
                    <th style="font-weight: bold; text-align: center;">Janda</th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">17-23</div></th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">24-30</div></th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">31-40</div></th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">41-55</div></th>
                    <th style="font-weight: bold; text-align: center;"><div style="width: 80px;">56></div></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($laporan as $index => $data)
                    <tr>
                      <td style="text-align: center;">{{ $index + 1 }}</td>
                      <td><div style="width: 150px;">{{ $data['cabang'] }}</div></td>
                      <td style="text-align: center;">{{ $data['jumlah_l'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_p'] }}</td>
                      <td style="text-align: center;">{{ $data['total_karyawan'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_sd'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_smp'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_sma'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_d1'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_d2'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_d3'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_s1'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_s2'] }}</td>
                      <td style="text-align: center;">{{ $data['total_pendidikan'] }}</td>
                      <td style="text-align: center;">{{ $data['bpjs_tk_sudah'] }}</td>
                      <td style="text-align: center;">{{ $data['bpjs_tk_belum'] }}</td>
                      <td style="text-align: center;">{{ $data['bpjs_kes_sudah'] }}</td>
                      <td style="text-align: center;">{{ $data['bpjs_kes_belum'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_belum_kawin'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_kawin'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_duda'] }}</td>
                      <td style="text-align: center;">{{ $data['jumlah_janda'] }}</td>
                      <td style="text-align: center;">{{ $data['usia_17_23'] }}</td>
                      <td style="text-align: center;">{{ $data['usia_24_30'] }}</td>
                      <td style="text-align: center;">{{ $data['usia_31_40'] }}</td>
                      <td style="text-align: center;">{{ $data['usia_41_55'] }}</td>
                      <td style="text-align: center;">{{ $data['usia_56_keatas'] }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_l'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_p'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['total_karyawan'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_sd'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_smp'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_sma'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_d1'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_d2'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_d3'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_s1'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_s2'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['total_pendidikan'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['bpjs_tk_sudah'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['bpjs_tk_belum'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['bpjs_kes_sudah'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['bpjs_kes_belum'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_belum_kawin'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_kawin'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_duda'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['jumlah_janda'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['usia_17_23'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['usia_24_30'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['usia_31_40'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['usia_41_55'] }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $total['usia_56_keatas'] }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->
@endsection
