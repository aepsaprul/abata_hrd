<table border="1">
    <thead>
      <tr>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal Input</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Tanggal Omset</th>
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
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Sales</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pencapaian Omzet Sales</th>
        <th style="background-color: lightblue; font-weight: bold; text-align: center;">Pencapaian Cash Sales</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($omzet as $key => $item)
        <tr>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $key + 1 }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">
            @if ($item->karyawan)
              {{ $item->karyawan->nama_lengkap }}
            @else
              @if ($item->karyawan_id == 0)
                Admin
              @endif
            @endif
          </td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">
            @if ($item->cabang)
              {{ $item->cabang->nama_cabang }}
            @endif
          </td>
          @php
            $tanggal_omset = date('Y-m-d', strtotime($item->tanggal));
            $tanggal_input = date('Y-m-d', strtotime($item->created_at));
          @endphp
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $tanggal_input }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $tanggal_omset }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->transaksi }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->traffic_online }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->traffic_offline }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->retail }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->instansi }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->reseller }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->cabang_rp }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->omzet_harian }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->omzet_terbayar }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->leads }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->konsumen_bertanya }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->cetak_banner_harian }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->cetak_a3_harian }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->print_outdoor }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->print_indoor }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->offset }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->merchandise }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->akrilik }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->design }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->laminasi_dingin }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->laminasi_a3 }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->fotocopy }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->dtf }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->uv }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->advertising_produk }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->advertising_jasa }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->cash_harian }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->piutang_bulan_berjalan }}</td>
          <td rowspan="{{ count($item->detailSales) > 1 ? count($item->detailSales) : '1' }}">{{ $item->piutang_terbayar }}</td>
          @if (count($item->detailSales) > 0)
            @foreach($item->detailSales as $key_sales => $item_sales)
              @if ($key_sales == 0)
                <td>{{ $item_sales->karyawan->nama_lengkap }}</td>
                <td>{{ $item_sales->pencapaian_omzet }}</td>
                <td>{{ $item_sales->pencapaian_cash }}</td>
              @else
              <tr>
                <td>{{ $item_sales->karyawan->nama_lengkap }}</td>
                <td>{{ $item_sales->pencapaian_omzet }}</td>
                <td>{{ $item_sales->pencapaian_cash }}</td>
              @endif
            @endforeach
          @else
            <td>-</td>
            <td>-</td>
            <td>-</td>
          @endif
        </tr>
      @endforeach
    </tbody>
</table>
