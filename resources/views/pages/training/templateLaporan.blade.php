<table border="1">
  <tbody>
    <tr>
      <td colspan="5">Laporan Training Bulan 
        @if ($bulan == '01')
          @php $nama_bulan = "Januari"; @endphp
        @elseif ($bulan == '02')
          @php $nama_bulan = "Februari"; @endphp
        @elseif ($bulan == '03')
          @php $nama_bulan = "Maret"; @endphp
        @elseif ($bulan == '04')
          @php $nama_bulan = "April"; @endphp
        @elseif ($bulan == '05')
          @php $nama_bulan = "Mei"; @endphp
        @elseif ($bulan == '06')
          @php $nama_bulan = "Juni"; @endphp
        @elseif ($bulan == '07')
          @php $nama_bulan = "Juli"; @endphp
        @elseif ($bulan == '08')
          @php $nama_bulan = "Agustus"; @endphp
        @elseif ($bulan == '09')
          @php $nama_bulan = "September"; @endphp
        @elseif ($bulan == '10')
          @php $nama_bulan = "Oktober"; @endphp
        @elseif ($bulan == '11')
          @php $nama_bulan = "November"; @endphp
        @elseif ($bulan == '12')
          @php $nama_bulan = "Desember"; @endphp
        @endif
        {{ $nama_bulan }} 
        Tahun {{ $tahun }}
      </td>
    </tr>
  </tbody>
</table>
<table border="1">
  <thead>
    <tr>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal Training</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Materi</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Karyawan</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Durasi (Jam)</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pemateri</th>
      <th style="background-color: lightblue; font-weight: bold; text-align: center;">Target</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pesertas as $key => $peserta)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ tglCarbon($peserta->dataTraining->tanggal, 'd/m/Y') }}</td>
        <td>{{ $peserta->dataTraining->judul }}</td>
        <td>{{ $peserta->dataKaryawan ? $peserta->dataKaryawan->nama_lengkap : '' }}</td>
        <td>{{ $peserta->dataKaryawan ? $peserta->dataKaryawan->masterCabang->nama_cabang : '' }}</td>
        <td>{{ $peserta->dataTraining->durasi }}</td>
        <td>
          @foreach ($peserta->dataTraining->dataPengisi as $pengisi)
            <div>{{ $pengisi->dataKaryawan->nama_lengkap }},</div>
          @endforeach
        </td>
        <td>{{ $peserta->dataTraining->goal }}</td>
      </tr>
    @endforeach
  </tbody>
</table>