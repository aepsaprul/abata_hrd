<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama Kompetitor</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Hasil Survey</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Promo Kompetitor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($survey_kompetitor as $key => $item)
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
                <td>{{ $item->nama_kompetitor }}</td>
                <td>{{ $item->hasil_survey }}</td>
                <td>{{ $item->promo_kompetitor }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
