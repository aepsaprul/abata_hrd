<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Customer</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Kritik dan Saran</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Penanganan Awal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($komplain as $key => $item)
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
                <td>{{ $item->nama_customer }}</td>
                <td>{{ $item->kritik_saran }}</td>
                <td>{{ $item->penanganan_awal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
