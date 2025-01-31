<table border="1">
  <tbody>
    <tr>
      <td colspan="5">Laporan Cuti Karyawan</td>
    </tr>
  </tbody>
</table>
{{-- <table border="1">
  <thead>
    <tr>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Karyawan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Total Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Sisa Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Alasan Cuti</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cutis as $key => $cuti)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $cuti->masterKaryawan->nama_lengkap }}</td>
        <td>{{ $cuti->masterKaryawan->masterCabang->nama_cabang }}</td>
        <td>
          @foreach ($cuti->cutiTgl as $tanggal)
            {{ $tanggal->tanggal }} <br>
          @endforeach
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @endforeach
  </tbody>
</table> --}}

{{-- <table class="table table-bordered">
  <thead>
      <tr>
          <th>No</th>
          <th>Nama Karyawan</th>
          <th>Cabang</th>
          <th>Tanggal Cuti</th>
          <th>Total Cuti</th>
          <th>Sisa Cuti</th>
          <th>Alasan Cuti</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($cutis as $index => $laporan)
      <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $laporan->nama_lengkap }}</td>
          <td>{{ $laporan->nama_cabang }}</td>
          <td>{{ $laporan->tanggal }}</td>
          <td>{{ $laporan->totalcuti }}</td>
          <td>{{ $laporan->total_cuti }}</td>
          <td>{{ $laporan->alasan }}</td>
      </tr>
      @endforeach
  </tbody>
</table> --}}
<table class="table table-bordered">
  <thead>
      <tr>
          <th style="text-align: center; font-weight: bold;">No</th>
          <th style="text-align: center; font-weight: bold;">Nama Karyawan</th>
          <th style="text-align: center; font-weight: bold;">Cabang</th>
          <th style="text-align: center; font-weight: bold;">Tanggal Cuti</th>
          <th style="text-align: center; font-weight: bold;">Total Cuti</th>
          <th style="text-align: center; font-weight: bold;">Sisa Cuti</th>
          <th style="text-align: center; font-weight: bold;">Alasan Cuti</th>
          <th style="text-align: center; font-weight: bold;">Pengajuan Cuti</th>
      </tr>
  </thead>
  <tbody>
    {{-- @php $no = 1; @endphp
      @foreach ($cutis->groupBy('nama_lengkap') as $nama_karyawan => $cutis)
      <tr>
          <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ $no++ }}</td>
          <td rowspan="{{ $cutis->count() }}" style="vertical-align: middle;">{{ $nama_karyawan }}</td>
          <td rowspan="{{ $cutis->count() }}" style="vertical-align: middle;">{{ $cutis->first()->nama_cabang }}</td>
          <td style="text-align: center;">{{ $cutis->first()->tanggal }}</td>
          <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ $cutis->count() }}</td>
          <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ $cutis->first()->totalcuti }}</td>
          <td rowspan="{{ $cutis->count() }}" style="vertical-align: middle;">{{ $cutis->first()->alasan }}</td>
      </tr>
      @foreach ($cutis->slice(1) as $cuti)
      <tr>
          <td style="text-align: center;">{{ $cuti->tanggal }}</td>
      </tr>
      @endforeach
    @endforeach --}}
    @php $no = 1; @endphp
    @foreach ($cutis->groupBy('nama_lengkap') as $nama_karyawan => $cuti_karyawan)
      @foreach ($cuti_karyawan->groupBy('created_at') as $tanggal_pengajuan => $cutis)
        <tr>
          @if ($loop->first)
            <td rowspan="{{ $cuti_karyawan->count() }}" style="text-align: center; vertical-align: middle;">{{ $no++ }}</td>
            <td rowspan="{{ $cuti_karyawan->count() }}" style="vertical-align: middle;">{{ $nama_karyawan }}</td>
            <td rowspan="{{ $cuti_karyawan->count() }}" style="vertical-align: middle;">{{ $cutis->first()->nama_cabang }}</td>
          @endif
            <td style="text-align: center;">{{ tglCarbon($cutis->first()->tanggal, 'd/m/Y') }}</td>
            <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ $cutis->count() }}</td>
            <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ $cutis->first()->totalcuti }}</td>
            <td rowspan="{{ $cutis->count() }}" style="vertical-align: middle;">{{ $cutis->first()->alasan }}</td>
            <td rowspan="{{ $cutis->count() }}" style="text-align: center; vertical-align: middle;">{{ tglCarbon($tanggal_pengajuan, 'd/m/Y') }}</td>
        </tr>
        @foreach ($cutis->slice(1) as $cuti)
          <tr>
            <td style="text-align: center;">{{ tglCarbon($cuti->tanggal, 'd/m/Y') }}</td>
          </tr>
        @endforeach
      @endforeach
    @endforeach
  </tbody>
</table>