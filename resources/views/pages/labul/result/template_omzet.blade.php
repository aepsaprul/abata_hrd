<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Transaksi</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Traffic Online</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Traffic Offline</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Retail</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Instansi</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Reseller</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Omzet Harian</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Omzet Terbayar</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Leads</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Konsumen Bertanya</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cetak Banner Harian</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cetak A3 Harian</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Print Outdoor</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Print Indoor</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Offset</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Merchandise</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Akrilik</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Design</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Laminasi Dingin</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Laminasi A3</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Fotocopy</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">DTF</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">UV</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Advertising Produk</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Advertising Jasa</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cash Harian</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Piutang Bulan Berjalan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Piutang Terbayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($omzet as $key => $item)
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
                <td>{{ $item->transaksi }}</td>
                <td>{{ $item->traffic_online }}</td>
                <td>{{ $item->traffic_offline }}</td>
                <td>{{ $item->retail }}</td>
                <td>{{ $item->instansi }}</td>
                <td>{{ $item->reseller }}</td>
                <td>{{ $item->cabang_rp }}</td>
                <td>{{ $item->omzet_harian }}</td>
                <td>{{ $item->omzet_terbayar }}</td>
                <td>{{ $item->leads }}</td>
                <td>{{ $item->konsumen_bertanya }}</td>
                <td>{{ $item->cetak_banner_harian }}</td>
                <td>{{ $item->cetak_a3_harian }}</td>
                <td>{{ $item->print_outdoor }}</td>
                <td>{{ $item->print_indoor }}</td>
                <td>{{ $item->offset }}</td>
                <td>{{ $item->merchandhise }}</td>
                <td>{{ $item->akrilik }}</td>
                <td>{{ $item->design }}</td>
                <td>{{ $item->laminasi_dingin }}</td>
                <td>{{ $item->laminasi_a3 }}</td>
                <td>{{ $item->fotocopy }}</td>
                <td>{{ $item->dtf }}</td>
                <td>{{ $item->uv }}</td>
                <td>{{ $item->advertising_produk }}</td>
                <td>{{ $item->advertising_jasa }}</td>
                <td>{{ $item->cash_harian }}</td>
                <td>{{ $item->piutang_bulan_berjalan }}</td>
                <td>{{ $item->piutang_terbayar }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
