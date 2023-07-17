@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Abata Peduli - <span class="h5">Detail Pengajuan</span></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('abdul') }}" class="btn btn-sm btn-danger btn-kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
            <div class="card-body h5">
                <div>
                  <table>
                    <tr>
                      <td>Nomor</td>
                      <td>:</td>
                      <td><span class="font-weight-bold">{{ $pengajuan->nomor }}</span></td>
                    </tr>
                    <tr>
                      <td>Perihal</td>
                      <td>:</td>
                      <td>Permohonan Pengajuan Pinjaman Karyawan</td>
                    </tr>
                  </table>
                </div>
                <div class="my-4">
                  <div>Kepada Yth.</div>
                  <div>Bapak/Ibu Pimpinan Abata Peduli</div>
                  <div>Di Tempat</div>
                </div>
                <div>
                  <div>Dengan Hormat,</div>
                  <div>Saya yang bertanda tangan dibawah ini:</div>
                </div>
                <div>
                  <table style="width: 100%;">
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><span class="font-weight-bold">{{ $pengajuan->nama }}</span></td>
                    </tr>
                    <tr>
                      <td>Jabatan</td>
                      <td>:</td>
                      <td><span class="font-weight-bold">{{ $pengajuan->jabatan }}</span></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><span class="font-weight-bold">{{ $pengajuan->alamat }}</span></td>
                    </tr>
                    <tr>
                      <td>No HP</td>
                      <td>:</td>
                      <td><span class="font-weight-bold">{{ $pengajuan->telepon }}</span></td>
                    </tr>
                  </table>
                </div>
                <div class="my-2">Merupakan karyawan dari Cabang <span class="font-weight-bold">{{ $pengajuan->cabang }}</span></div>
                <div class="my-2">Berencana untuk mengajukan permohonan Pinjaman sebesar Rp.  <span class="font-weight-bold">{{ rupiah($pengajuan->pinjaman) }}</span> <span class="text-sm">(maksimal 5 juta)</span></div>
                <table>
                  <tr>
                    <td>Untuk Keperluan</td>
                    <td>:</td>
                    <td><span class="font-weight-bold">{{ $pengajuan->keperluan }}</span></td>
                  </tr>
                  <tr>
                    <td>Gaji yang diterima</td>
                    <td>:</td>
                    <td>Rp. <span class="font-weight-bold">{{ rupiah($pengajuan->gaji) }}</span> /bulan</td>
                  </tr>
                </table>
                <div class="my-2">Dengan gaji tersebut, saya berencana untuk mengangsurnya selama <span class="font-weight-bold">{{ $pengajuan->angsuran }}</span> bulan 
                  <span class="text-sm">(maksimal 12 bulan)</span>
                  sebesar Rp. <span class="font-weight-bold">{{ rupiah($pengajuan->nominal_angsuran) }}</span>/bulan
                <div class="my-2">Besarnya angsuran tersebut akan saya bayarkan melalui: </div>
                <div class="my-4">
                  @if ($pengajuan->metode_bayar == "transfer")
                    <div>Transfer mandiri ke rekening Abata Peduli</div>
                  @else
                    <div>Pemotongan gaji setiap bulannya hingga selesai, dimulai bulan <span class="text-capitalize font-weight-bold">{{ tglCarbon($pengajuan->tanggal_bayar, 'F') }} tahun {{ tglCarbon($pengajuan->tanggal_bayar, 'Y') }}</span></div>
                  @endif
                </div>
                <div>Demikian permohonan kami sampaikan, terima kasih</div>
                <div class="mt-5 text-right">Purwokerto, 
                @php
                  $date = Carbon\Carbon::parse($pengajuan->created_at)->locale('id');
                  $date->settings(['formatFunction' => 'translatedFormat']);
                @endphp
                {{ $date->format('d F Y') }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
