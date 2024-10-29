<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 10px;
    }
  </style>
</head>
<body>
    <div>
      <span style="float: left; text-transform: uppercase; font-family:">pt haehoe cemerlang mulia</span>
      <span style="float: right; text-transform: uppercase; font-family:">slip gaji {{ $slip->bulan }} {{ $slip->tahun }}</span>
    </div>
    <div style="clear: both;"></div>
    <hr>
    <table border="1" style="width: 100%; margin-top: 20px;" cellpadding="0" cellspacing="0">
      <tr style="background-color: blue; color: #fff;">
        <th style="padding: 5px;">No</th>
        <th style="padding: 5px;">Nama Cabang</th>
        @foreach ($slip_title as $item)
          <th style="padding: 5px; text-transform: capitalize;">Biaya Gaji {{ $item->bulan }}</th>
        @endforeach
        <th style="padding: 5px;">Biaya Admin</th>
        <th style="padding: 5px;">Total Gaji April</th>
        <th style="padding: 5px;">Efisiensi Biaya Gaji</th>
      </tr>

        @php
          $sum_gaji_sebelumnya = 0;
          $sum_gaji = 0;
          $sum_biaya_admin = 0;
          $sum_total_gaji = 0;
          $sum_efisiensi_gaji = 0;
        @endphp

        @foreach ($slip_detail as $key => $item)
          @php
            $gaji_sebelumnya = 0;

            $penerimaan = $item->gaji_pokok +
              $item->tunj_jabatan +
              $item->tunj_transport +
              $item->tunj_komunikasi +
              $item->tunj_kost +
              $item->tunj_khusus +
              $item->uang_lembur +
              $item->bonus_cabang +
              $item->bonus_project +
              $item->bonus_desain +
              $item->bonus_kehadiran;

            $potongan = $item->hutang_karyawan +
              $item->retur_produksi +
              $item->premi_bpjs_kes +
              $item->premi_bpjs_tk +
              $item->pot_alpha_ijin +
              $item->pot_sakit +
              $item->pot_abata_peduli +
              $item->pph21 +
              $item->pot_lain;

            $biaya_gaji = $penerimaan - $potongan;
            $biaya_admin = 10000;
            $total_gaji = $biaya_gaji + $biaya_admin;
            $efisien_gaji = $biaya_gaji - 0;
          @endphp

          <tr>
            <td style="text-align: center; padding: 5px;">{{ $key + 1 }}</td>
            <td style="padding: 5px;">
              @foreach ($cabangs as $item_cabang)
                @if ($item_cabang->id == $item->master_cabang_id)
                  {{ $item_cabang->nama_cabang }}
                @endif
              @endforeach
            </td>
            <td style="padding: 5px;">Rp. <span style="float: right;">0</span></td>
            <td style="padding: 5px;">Rp. <span style="float: right;">{{ rupiah($biaya_gaji) }}</span></td>
            <td style="padding: 5px;">Rp. <span style="float: right;">{{ rupiah($biaya_admin) }}</span></td>
            <td style="padding: 5px;">Rp. <span style="float: right;">{{ rupiah($total_gaji) }}</span></td>
            <td style="padding: 5px;">Rp. <span style="float: right;">{{ rupiah($efisien_gaji) }}</span></td>
          </tr>

          @php
            $sum_gaji_sebelumnya += $gaji_sebelumnya;
            $sum_gaji += $penerimaan;
            $sum_biaya_admin += $biaya_admin;
            $sum_total_gaji += $total_gaji;
            $sum_efisiensi_gaji += $efisien_gaji;
          @endphp
        @endforeach
        <tr>
          <th style="padding: 5px;" colspan="2">Total</th>
          <th style="padding: 5px; text-align: left;">Rp. <span style="float: right;">{{ rupiah($sum_gaji_sebelumnya) }}</th>
          <th style="padding: 5px; text-align: left;">Rp. <span style="float: right;">{{ rupiah($sum_gaji) }}</span></th>
          <th style="padding: 5px; text-align: left;">Rp. <span style="float: right;">{{ rupiah($sum_biaya_admin) }}</th>
          <th style="padding: 5px; text-align: left;">Rp. <span style="float: right;">{{ rupiah($sum_total_gaji) }}</th>
          <th style="padding: 5px; text-align: left;">Rp. <span style="float: right;">{{ rupiah($sum_efisiensi_gaji) }}</th>
        </tr>
    </table>
</body>
</html>
