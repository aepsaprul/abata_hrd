<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div style="z-index: 1; position: absolute; text-align: center;">
    <img src="{{ asset(env('APP_URL_IMG') . 'assets/abdul-wm.png') }}" alt="watermark" style="width: 60%; margin-top: 30%;">
  </div>
  <div style="z-index: 3; position: absolute;">
    <div style="margin-bottom: 20px; display: flex; justify-content: space-between;">
      <img src="{{ asset(env('APP_URL_IMG') . 'assets/abdul-logo.png') }}" alt="logo" style="max-width: 150px; height: 80px;">
      <img src="{{ asset(env('APP_URL_IMG') . 'assets/abdul-kop-surat.png') }}" alt="logo" style="max-width: 70px;">
    </div>
    <div>
      <table>
        <tr>
          <td>Nomor</td>
          <td>:</td>
          <td><span class="font-weight-bold">{{ $pengajuan->nomor }}</span></td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>:</td>
          <td>Permohonan Pengajuan Pinjaman Karyawan</td>
        </tr>
      </table>
    </div>
    <div style="margin-top: 20px; margin-left: 3px;">
      <div>Kepada Yth.</div>
      <div>Bapak/Ibu Pimpinan Abata Peduli</div>
      <div>Di Tempat</div>
    </div>
    <div style="margin-top: 20px; margin-left: 3px;">
      <div>Dengan Hormat,</div>
      <div>Saya yang bertanda tangan dibawah ini:</div>
    </div>
    <div>
      <table style="width: 100%;">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><span class="font-weight-bold">{{ $pengajuan->nama }}</span></td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td><span class="font-weight-bold">{{ $pengajuan->jabatan }}</span></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><span class="font-weight-bold">{{ $pengajuan->alamat }}</span></td>
        </tr>
        <tr>
          <td>No HP</td>
          <td>:</td>
          <td><span class="font-weight-bold">{{ $pengajuan->telepon }}</span></td>
        </tr>
      </table>
    </div>
    <div style="margin-top: 5px; margin-left: 3px;">Merupakan karyawan dari Cabang <span class="font-weight-bold">{{ $pengajuan->cabang }}</span></div>
    <div style="margin-left: 3px;">Berencana untuk mengajukan permohonan Pinjaman sebesar Rp.  <span class="font-weight-bold">{{ rupiah($pengajuan->pinjaman) }}</span> <span class="text-sm">(maksimal 5 juta)</span></div>
    <table style="margin-top: 5px;">
      <tr>
        <td>Untuk Keperluan</td>
        <td>:</td>
        <td><span class="font-weight-bold">{{ $pengajuan->keperluan }}</span></td>
      </tr>
      <tr>
        <td>Gaji yang diterima</td>
        <td>:</td>
        <td>Rp. <span class="font-weight-bold">{{ rupiah($pengajuan->gaji) }}</span> /bulan</td>
      </tr>
    </table>
    <div style="margin-top: 5px; margin-left: 3px;">Dengan gaji tersebut, saya berencana untuk mengangsurnya selama <span class="font-weight-bold">{{ $pengajuan->angsuran }}</span> bulan 
      <span class="text-sm">(maksimal 12 bulan)</span>
      sebesar Rp. <span class="font-weight-bold">{{ rupiah($pengajuan->nominal_angsuran) }}</span>/bulan
    <div>Besarnya angsuran tersebut akan saya bayarkan melalui: </div>
    <div>
      @if ($pengajuan->metode_bayar == "transfer")
        <div>Transfer mandiri ke rekening Abata Peduli</div>
      @else
        <div>Pemotongan gaji setiap bulannya hingga selesai, dimulai bulan <span class="text-capitalize font-weight-bold">{{ tglCarbon($pengajuan->tanggal_bayar, 'F') }} tahun {{ tglCarbon($pengajuan->tanggal_bayar, 'Y') }}</span></div>
      @endif
    </div>
    <div>Demikian permohonan kami sampaikan, terima kasih</div>
    <div style="text-align: right; margin-right: 50px; margin-top: 50px;">Purwokerto, 
    @php
      $date = Carbon\Carbon::parse($pengajuan->created_at)->locale('id');
      $date->settings(['formatFunction' => 'translatedFormat']);
    @endphp
    {{ $date->format('d F Y') }}
    </div>
    <div style="margin-top: 30px;">
      <div style="display: flex;">
        <div style="width: 100%; display: flex; justify-content: center;">
          <div>
            <div style="text-align: center;">Atasan Langsung</div>
            <div style="display: flex; justify-content: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 1 && $item->status == 1 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/approved.jpeg') }}" alt="img" style="width: 100px;">
                @elseif ($item->hirarki == 1 && $item->status == 0 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/disapproved.png') }}" alt="img" style="width: 100px;">
                @endif
              @endforeach
            </div>
            <div style="margin-top: 10px;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 1)
                  {{ $item->dataAtasan->nama_lengkap }}
                @endif
              @endforeach
            </div>
            <div style="text-align: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 1 && $item->confirm == "1")
                  {{ $item->approved_keterangan }}
                @endif
              @endforeach
            </div>
          </div>
        </div>
        <div style="width: 100%; display: flex; justify-content: center;">
          <div>
            <div style="text-align: center;">Pemohon</div>
            <div style="margin-top: 80px;">{{ $pengajuan->karyawan->nama_lengkap }}</div>
          </div>
        </div>
      </div>
      <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Menyetujui</div>
      <div style="display: flex;">
        <div style="width: 100%; display: flex; justify-content: center;">
          <div>
            <div style="text-align: center;">Finance Accounting Manager</div>
            <div style="display: flex; justify-content: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 3 && $item->status == 1 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/approved.jpeg') }}" alt="img" style="width: 100px;">
                @elseif ($item->hirarki == 3 && $item->status == 0 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/disapproved.png') }}" alt="img" style="width: 100px;">
                @endif
              @endforeach
            </div>
            <div style="margin-top: 10px; text-align: center;">ANDHIKA SUKMA PUTRA</div>
            <div style="text-align: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 3 && $item->confirm == "1")
                  {{ $item->approved_keterangan }}
                @endif
              @endforeach
            </div>
          </div>
        </div>
        <div style="width: 100%; display: flex; justify-content: center;">
          <div>
            <div style="text-align: center;">Operation Development Manager</div>
            <div style="display: flex; justify-content: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 2 && $item->status == 1 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/approved.jpeg') }}" alt="img" style="width: 100px;">
                @elseif ($item->hirarki == 2 && $item->status == 0 && $item->confirm == "1")
                  <img src="{{ asset(env('APP_URL_IMG') . 'assets/disapproved.png') }}" alt="img" style="width: 100px;">
                @endif
              @endforeach
            </div>
            <div style="margin-top: 10px; text-align: center;">ANDI TRIONO TARSUN</div>
            <div style="text-align: center;">
              @foreach ($pengajuan->pengajuanApprover as $item)
                @if ($item->hirarki == 2 && $item->confirm == "1")
                  {{ $item->approved_keterangan }}
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- {{ $pengajuan->pengajuanApprover }} --}}
  {{-- <br><br><br>
  @foreach ($pengajuan->pengajuanApprover as $item)
    {{ $item->atasan }} - {{ $item->hirarki }} - {{ $item->approved_keterangan }}
  @endforeach --}}
  <script>
    window.print();
  </script>
</body>
</html>