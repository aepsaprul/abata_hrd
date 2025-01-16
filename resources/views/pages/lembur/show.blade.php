@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Lembur</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lembur') }}">Lembur</a></li>
            <li class="breadcrumb-item active">Detail</li>
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
            <div class="card-body">
              <div class="mb-3">
                <div class="d-flex justify-content-start">
                  <div style="width: 150px;">Nama Cabang</div>
                  <div class="mx-2">:</div>
                  <div class="">{{ $lembur->cabang }}</div>
                </div>
                <div class="d-flex">
                  <div style="width: 150px;">Hari Tanggal</div>
                  <div class="mx-2">:</div>
                  <div>{{ tglCarbon($lembur->created_at, 'l, d M Y') }}</div>
                </div>
              </div>
              <div class="row">
                <table class="table table-bordered p-0">
                  <thead>
                    <tr>
                      <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                      <th class="text-center" rowspan="2" style="vertical-align: middle;">Nama</th>
                      <th class="text-center" rowspan="2" style="vertical-align: middle;">Jabatan</th>
                      <th class="text-center" colspan="3">Waktu Lembur (Jam)</th>
                      <th class="text-center" rowspan="2" style="vertical-align: middle;">Aktivitas</th>
                      <th class="text-center" rowspan="2" style="vertical-align: middle;">Keterangan Lembur</th>
                    </tr>
                    <tr>
                      <th class="text-center">Mulai</th>
                      <th class="text-center">Selesai</th>
                      <th class="text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lembur->dataDetail as $key => $detail)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detail->nama_karyawan }}</td>
                        <td>{{ $detail->jabatan }}</td>
                        <td class="text-center">{{ $detail->mulai ? tglCarbon($detail->mulai, 'd/m/Y H:i') : '' }}</td>
                        <td class="text-center">{{ $detail->selesai ? tglCarbon($detail->selesai, 'd/m/Y H:i') : '' }}</td>
                        <td class="text-right">
                          @if ($detail->mulai && $detail->selesai)
                            @php
                              $datetime1 = Carbon\Carbon::parse($detail->mulai);
                              $datetime2 = Carbon\Carbon::parse($detail->selesai);

                              $hours = $datetime1->diffInHours($datetime2);
                              $minutes = $datetime1->diffInMinutes($datetime2) % 60;
                            @endphp
                            {{ $hours }}{{ $minutes > 0 ? ','.$minutes : '' }} Jam
                          @endif
                        </td>
                        <td>{{ $detail->nama_task }}</td>
                        <td>{{ $detail->keterangan }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                @foreach ($lembur->dataApprover as $approver)
                  @if ($approver->confirm == 1)
                    <div class="col-3">
                      <div class="text-center">Approver {{ $approver->hierarki }}</div>
                      <div class="d-flex justify-content-center">
                        @if ($approver->status == 1 && $approver->confirm == "1")
                          <img src="{{ asset(env('APP_URL_IMG') . 'assets/approved.jpeg') }}" alt="img" style="width: 100px; height: 50px;">
                        @elseif ($approver->status == 0 && $approver->confirm == "1")
                          <img src="{{ asset(env('APP_URL_IMG') . 'assets/disapproved.png') }}" alt="img" style="width: 100px; height: 50px;">
                        @endif
                      </div>
                      <div style="margin-top: 10px; text-align: center;">
                        {{ $approver->dataAtasan->nama_lengkap }}
                      </div>
                      <div class="text-center">
                        {{ $approver->dataAtasan->masterJabatan->nama_jabatan }}
                      </div>
                    </div>
                  @endif
                @endforeach
                <div class="col-3">
                  <div class="text-center">Diajukan Oleh,</div>
                  <div class="d-flex justify-content-center">
                    
                  </div>
                  <div style="margin-top: 60px; text-align: center;">
                    {{ $lembur->nama_karyawan }}
                  </div>
                  <div class="text-center">
                    {{ $lembur->jabatan }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
