<table border="1">
  <thead>
    <tr>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">ID</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">NIP</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Gaji Pokok</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Jabatan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Transport</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Komunikasi</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Kost</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Khusus</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Cabang</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Project</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Desain</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Kehadiran</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lain Lain</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Makan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Uang Lembur</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Total Tambahan Penghasilan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Hutang Karyawan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Retur Produksi</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Abata Peduli</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">PPh21</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Lain</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Premi BPJS Kesehatan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Premi BPJS TK</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Alpha Ijin</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Sakit</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Jml Hari Kerja</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Jml Hari Uang Makan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lembur Hari Biasa</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lembur Hari Libur</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Telat</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Telat Kehadiran</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Sakit</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Tanpa SKD</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Ijin</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Alpha</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Sisa Cuti</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Poin Kehadiran</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">BPJS Kesehatan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">BPJS TK JHT</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">BPJS TK JKM</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">BPJS TK JKK</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($karyawans as $key => $item)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>
          @if ($item->karyawan)
            {{ $item->karyawan->id }}
          @endif
        </td>
        <td></td>
        <td>
          @if ($item->karyawan)
            {{ $item->karyawan->nama_lengkap }}
          @endif
        </td>
        <td>
          @if ($item->karyawan)
            {{ $item->karyawan->masterCabang->nama_cabang }}
          @endif
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @endforeach
  </tbody>
</table>
