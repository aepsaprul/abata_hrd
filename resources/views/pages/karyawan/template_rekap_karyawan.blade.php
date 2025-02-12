<table border="1">
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
      <th style="font-weight: bold; text-align: center;">Laki - laki</th>
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
      <th style="font-weight: bold; text-align: center;">Belum Kawin</th>
      <th style="font-weight: bold; text-align: center;">Kawin</th>
      <th style="font-weight: bold; text-align: center;">Duda</th>
      <th style="font-weight: bold; text-align: center;">Janda</th>
      <th style="font-weight: bold; text-align: center;">17-23</th>
      <th style="font-weight: bold; text-align: center;">24-30</th>
      <th style="font-weight: bold; text-align: center;">31-40</th>
      <th style="font-weight: bold; text-align: center;">41-55</th>
      <th style="font-weight: bold; text-align: center;">56></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($laporan as $index => $data)
      <tr>
        <td style="text-align: center;">{{ $index + 1 }}</td>
        <td>{{ $data['cabang'] }}</td>
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
      <td colspan="2"><strong>Total</strong></td>
      <td style="text-align: center;">{{ $total['jumlah_l'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_p'] }}</td>
      <td style="text-align: center;">{{ $total['total_karyawan'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_sd'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_smp'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_sma'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_d1'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_d2'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_d3'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_s1'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_s2'] }}</td>
      <td style="text-align: center;">{{ $total['total_pendidikan'] }}</td>
      <td style="text-align: center;">{{ $total['bpjs_tk_sudah'] }}</td>
      <td style="text-align: center;">{{ $total['bpjs_tk_belum'] }}</td>
      <td style="text-align: center;">{{ $total['bpjs_kes_sudah'] }}</td>
      <td style="text-align: center;">{{ $total['bpjs_kes_belum'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_belum_kawin'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_kawin'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_duda'] }}</td>
      <td style="text-align: center;">{{ $total['jumlah_janda'] }}</td>
      <td style="text-align: center;">{{ $total['usia_17_23'] }}</td>
      <td style="text-align: center;">{{ $total['usia_24_30'] }}</td>
      <td style="text-align: center;">{{ $total['usia_31_40'] }}</td>
      <td style="text-align: center;">{{ $total['usia_41_55'] }}</td>
      <td style="text-align: center;">{{ $total['usia_56_keatas'] }}</td>
    </tr>
  </tfoot>
</table>