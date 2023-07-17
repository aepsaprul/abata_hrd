@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Abata Peduli - <span class="h5">Form Pengajuan</span></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('abdul') }}" class="btn btn-sm btn-danger btn-kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body h5">
              <form action="{{ route('abdul.store') }}" method="post">
                @csrf
                <input type="hidden" name="karyawan_id" id="karyawan_id" value="{{ Auth::user()->master_karyawan_id }}">
                <input type="hidden" name="urutan" value="{{ $urutan }}">
                <div>
                  <table style="width: 100%;">
                    <tr>
                      <td>Nomor</td>
                      <td>:</td>
                      <td><input type="text" name="nomor" class="border-top-0 border-right-0 border-left-0" value="{{ $nomor_pengajuan }}" required readonly style="border-style: dotted; outline: none; width: 40%;"></td>
                    </tr>
                    <tr>
                      <td>Perihal</td>
                      <td>:</td>
                      <td>Permohonan Pengajuan Pinjaman Karyawan</td>
                    </tr>
                  </table>
                </div>
                <div class="my-4">
                  <div>Kepada Yth.</div>
                  <div>Bapak/Ibu Pimpinan Abata Peduli</div>
                  <div>Di Tempat</div>
                </div>
                <div>
                  <div>Dengan Hormat,</div>
                  <div>Saya yang bertanda tangan dibawah ini:</div>
                </div>
                <div>
                  <table style="width: 100%;">
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><input type="text" name="nama" class="border-top-0 border-right-0 border-left-0" value="{{ $user->masterKaryawan ? $user->masterKaryawan->nama_lengkap : $user->name }}" required readonly style="border-style: dotted; outline: none; width: 100%;"></td>
                    </tr>
                    <tr>
                      <td>Jabatan</td>
                      <td>:</td>
                      <td><input type="text" name="jabatan" class="border-top-0 border-right-0 border-left-0" value="{{ $user->masterKaryawan ? $user->masterKaryawan->masterJabatan->nama_jabatan : 'admin' }}" required readonly style="border-style: dotted; outline: none; width: 100%;"></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><input type="text" name="alamat" class="border-top-0 border-right-0 border-left-0" value="{{ $user->masterKaryawan ? $user->masterKaryawan->alamat_domisili : 'admin' }}" required readonly style="border-style: dotted; outline: none; width: 100%;"></td>
                    </tr>
                    <tr>
                      <td>No HP</td>
                      <td>:</td>
                      <td><input type="text" name="telepon" class="border-top-0 border-right-0 border-left-0" value="{{ $user->masterKaryawan ? $user->masterKaryawan->telepon : '123456789' }}" required readonly style="border-style: dotted; outline: none; width: 100%;"></td>
                    </tr>
                  </table>
                </div>
                <div class="my-2">Merupakan karyawan dari Cabang <input type="text" name="cabang" class="border-top-0 border-right-0 border-left-0" value="{{ $user->masterKaryawan ? $user->masterKaryawan->masterCabang->nama_cabang : 'HO' }}" required readonly style="border-style: dotted; outline: none;"></div>
                <div class="my-2">Berencana untuk mengajukan permohonan Pinjaman sebesar Rp.  <input type="text" name="pinjaman" id="pinjaman" class="border-top-0 border-right-0 border-left-0" required style="border-style: dotted; outline: none;" autocomplete="off"> <span class="text-sm">(maksimal 5 juta)</span></div>
                <table style="width: 100%;">
                  <tr>
                    <td>Untuk Keperluan</td>
                    <td>:</td>
                    <td><input type="text" name="keperluan" class="border-top-0 border-right-0 border-left-0" required style="border-style: dotted; outline: none; width: 100%;"></td>
                  </tr>
                  <tr>
                    <td>Gaji yang diterima</td>
                    <td>:</td>
                    <td>Rp. <input type="text" name="gaji" id="gaji" class="border-top-0 border-right-0 border-left-0" required style="border-style: dotted; outline: none;" autocomplete="off"> /bulan</td>
                  </tr>
                </table>
                <div class="my-2">Dengan gaji tersebut, saya berencana untuk mengangsurnya selama 
                  <input type="text" name="angsuran" id="angsuran" class="border-top-0 border-right-0 border-left-0 text-center" required style="border-style: dotted; outline: none; width: 50px;" autocomplete="off"> bulan 
                  <span class="text-sm">(maksimal 12 bulan)</span>
                  sebesar <span class="nominal_angsuran"></span>/bulan
                </div>
                <div class="my-2">Besarnya angsuran tersebut akan saya bayarkan melalui: </div>
                <div class="my-4">
                  <div> 
                    Pemotongan gaji setiap bulannya hingga selesai, dimulai bulan 
                    <select name="bulanBayar" id="bulanBayar" required>
                      <option value="">Pilih Bulan</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                    tahun 
                    <select name="tahunBayar" id="tahunBayar" required>
                      <option value="">Pilih Tahun</option>
                      @for($i = 2023; $i <= 2050; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div>Demikian permohonan kami sampaikan, terima kasih</div>
                <div class="mt-5 text-right">Purwokerto, 
                  @php
                    $date = Carbon\Carbon::parse(date("Y/m/d"))->locale('id');
                    $date->settings(['formatFunction' => 'translatedFormat']);
                  @endphp
                  {{ $date->format('d F Y') }}
                </div>
                <div class="text-center mt-3">
                  <button class="btn btn-primary btn-lg font-weight-bold"><i class="fa fa-paper-plane"></i> Kirim Pengajuan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  let pinjaman_val = document.getElementById("pinjaman");
  pinjaman_val.addEventListener("keyup", function(e) {
    pinjaman_val.value = formatRupiahTitik(this.value, "");
  });
  let gaji_val = document.getElementById("gaji");
  gaji_val.addEventListener("keyup", function(e) {
    gaji_val.value = formatRupiahTitik(this.value, "");
  });

  const angsuran = document.querySelector('#angsuran');
  const nominal_angsuran = document.querySelector('.nominal_angsuran');

  angsuran.addEventListener('keyup', function () {
    nominal_angsuran.textContent = '';
    const pinjaman = Number(pinjaman_val.value.replace(/\./g, ''));
    const angsuran_val = Number(angsuran.value);
    const calAngsuran = Number(pinjaman / angsuran_val);
    nominal_angsuran.append(format_rupiah_titik(calAngsuran, ""));
  })
</script>

@endsection
