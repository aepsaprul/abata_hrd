{{-- <table border="1">
  <tbody>
    <tr>
      <td colspan="5">Laporan Cuti Karyawan</td>
    </tr>
  </tbody>
</table>
<table border="1">
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

<table class="table table-bordered">
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
</table>