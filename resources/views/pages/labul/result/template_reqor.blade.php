<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Customer</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nomor HP</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Request Produk</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Produk Tertolak</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Alasan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reqor as $key => $item)
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
                <td>{{ $item->nomor_hp }}</td>
                <td>{{ $item->request_produk }}</td>
                <td>{{ $item->produk_tertolak }}</td>
                <td>{{ $item->alasan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
