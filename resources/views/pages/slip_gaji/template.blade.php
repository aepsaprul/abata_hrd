<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">NIP</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Periode</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bulan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tahun</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Gaji Pokok</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Jabatan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Makan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Transport</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Komunikasi</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Kost</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tunj Khusus</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Uang Lembur</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Project</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Desain</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Bonus Kehadiran</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lain Lain</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Hutang Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Retur Produksi</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Premi BPJS Kesehatan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Premi BPJS TK</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Alpha Ijin</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Abata Peduli</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">PPh 21</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pot Lain</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Jml Hari Kerja</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Jml Hari Uang Makan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lembur Hari Biasa</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Lembur Hari Libur</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Telat</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Sakit</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Tanpa SKD</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Ijin</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Alpha</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Absensi Cuti</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Sisa Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($karyawans as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td></td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>
                    @if ($item->masterCabang)
                        {{ $item->masterCabang->nama_cabang }}
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
            </tr>
        @endforeach
    </tbody>
</table>
