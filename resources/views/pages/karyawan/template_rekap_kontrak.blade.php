<table border="1">
  <thead>
    <tr>
      <th style="font-weight: bold; text-align: center;">No</th>
      <th style="font-weight: bold; text-align: center;">Nama</th>
      <th style="font-weight: bold; text-align: center;">Cabang</th>
      <th style="font-weight: bold; text-align: center;">Tanggal Habis Kontrak</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($kontraks as $index => $data)
      <tr>
        <td style="text-align: center;">{{ $index + 1 }}</td>
        <td>{{ $data->nama_lengkap }}</td>
        <td>{{ $data->masterCabang ? $data->masterCabang->nama_cabang : '' }}</td>
        <td style="text-align: center;">{{ $data->kontrak->last() ? $data->kontrak->last()->akhir_kontrak : '' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>