<table border="1">
  <thead>
    <tr>
      <th rowspan="2">No</th>
      <th rowspan="2">Cabang</th>
      <th colspan="3">Jumlah Karyawan</th>
      <th colspan="9">Tingkat Pendidikan</th>
      <th colspan="2">BPJS TK</th>
      <th colspan="2">BPJS Kesehatan</th>
      <th colspan="4">Status Pernikahan</th>
      <th colspan="5">Penggolongan Usia</th>
    </tr>
    <tr>
      <th>Laki - laki</th>
      <th>Perempuan</th>
      <th>Total</th>
      <th>SD</th>
      <th>SMP</th>
      <th>SMA</th>
      <th>D1</th>
      <th>D2</th>
      <th>D3</th>
      <th>S1</th>
      <th>S2</th>
      <th>Total</th>
      <th>Terdaftar</th>
      <th>Belum</th>
      <th>Terdaftar</th>
      <th>Belum</th>
      <th>Belum Kawin</th>
      <th>Kawin</th>
      <th>Duda</th>
      <th>Janda</th>
      <th>17-23</th>
      <th>24-30</th>
      <th>31-40</th>
      <th>41-55</th>
      <th>56></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($laporan as $index => $data)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $data['cabang'] }}</td>
        <td>{{ $data['jumlah_l'] }}</td>
        <td>{{ $data['jumlah_p'] }}</td>
        <td>{{ $data['total_karyawan'] }}</td>
        <td>{{ $data['jumlah_sd'] }}</td>
        <td>{{ $data['jumlah_smp'] }}</td>
        <td>{{ $data['jumlah_sma'] }}</td>
        <td>{{ $data['jumlah_d1'] }}</td>
        <td>{{ $data['jumlah_d2'] }}</td>
        <td>{{ $data['jumlah_d3'] }}</td>
        <td>{{ $data['jumlah_s1'] }}</td>
        <td>{{ $data['jumlah_s2'] }}</td>
        <td>{{ $data['total_pendidikan'] }}</td>
        <td>{{ $data['bpjs_tk_sudah'] }}</td>
        <td>{{ $data['bpjs_tk_belum'] }}</td>
        <td>{{ $data['bpjs_kes_sudah'] }}</td>
        <td>{{ $data['bpjs_kes_belum'] }}</td>
        <td>{{ $data['jumlah_belum_kawin'] }}</td>
        <td>{{ $data['jumlah_kawin'] }}</td>
        <td>{{ $data['jumlah_duda'] }}</td>
        <td>{{ $data['jumlah_janda'] }}</td>
        <td>{{ $data['usia_17_23'] }}</td>
        <td>{{ $data['usia_24_30'] }}</td>
        <td>{{ $data['usia_31_40'] }}</td>
        <td>{{ $data['usia_41_55'] }}</td>
        <td>{{ $data['usia_56_keatas'] }}</td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2"><strong>Total</strong></td>
      <td>{{ $total['jumlah_l'] }}</td>
      <td>{{ $total['jumlah_p'] }}</td>
      <td>{{ $total['total_karyawan'] }}</td>
      <td>{{ $total['jumlah_sd'] }}</td>
      <td>{{ $total['jumlah_smp'] }}</td>
      <td>{{ $total['jumlah_sma'] }}</td>
      <td>{{ $total['jumlah_d1'] }}</td>
      <td>{{ $total['jumlah_d2'] }}</td>
      <td>{{ $total['jumlah_d3'] }}</td>
      <td>{{ $total['jumlah_s1'] }}</td>
      <td>{{ $total['jumlah_s2'] }}</td>
      <td>{{ $total['total_pendidikan'] }}</td>
      <td>{{ $total['bpjs_tk_sudah'] }}</td>
      <td>{{ $total['bpjs_tk_belum'] }}</td>
      <td>{{ $total['bpjs_kes_sudah'] }}</td>
      <td>{{ $total['bpjs_kes_belum'] }}</td>
      <td>{{ $total['jumlah_belum_kawin'] }}</td>
      <td>{{ $total['jumlah_kawin'] }}</td>
      <td>{{ $total['jumlah_duda'] }}</td>
      <td>{{ $total['jumlah_janda'] }}</td>
      <td>{{ $total['usia_17_23'] }}</td>
      <td>{{ $total['usia_24_30'] }}</td>
      <td>{{ $total['usia_31_40'] }}</td>
      <td>{{ $total['usia_41_55'] }}</td>
      <td>{{ $total['usia_56_keatas'] }}</td>
    </tr>
  </tfoot>
</table>