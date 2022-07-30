<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Reseller</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Usaha</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nomor Hp</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_reseller as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    @if ($item->karyawan)
                        {{ $item->karyawan->nama_lengkap }}
                    @else
                        @if ($item->karyawan_id == 0)
                            Admin
                        @endif
                    @endif
                </td>
                <td>
                    @if ($item->cabang)
                        {{ $item->cabang->nama_cabang }}
                    @endif
                </td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->nama_reseller }}</td>
                <td>{{ $item->nama_usaha }}</td>
                <td>{{ $item->nomor_hp }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
