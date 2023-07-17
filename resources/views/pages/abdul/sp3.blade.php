<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Prinsip Persetujuan Peminjaman</title>
</head>
<body>
  <div style="z-index: 1; position: absolute; text-align: center;">
    <img src="{{ asset('public/assets/abdul-wm.png') }}" alt="watermark" style="width: 60%; margin-top: 30%;">
  </div>
  <div style="z-index: 2; position: absolute; text-align: center; margin-top: 100%;">
    <img src="{{ asset('public/assets/abdul-wm.png') }}" alt="watermark" style="width: 60%; margin-top: 30%;">
  </div>
  <div style="z-index: 3; position: absolute;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
      <div><img src="{{ asset('public/assets/abdul-logo.png') }}" alt="abdul-logo" style="max-width: 150px;"></div>
      <div><img src="{{ asset('public/assets/abdul-kop-surat.png') }}" alt="abdul-kop-surat" style="max-width: 80px;"></div>
    </div>
    <div style="display: flex; justify-content: space-between; padding: 2px; margin-bottom: 30px;">
      <div>
        <div style="display: flex;">
          <div>Nomor</div>
          <div style="padding-left: 5px; padding-right: 5px;">:</div>
          <div>{{ $pengajuan->nomor }}</div>
        </div>
        <div style="display: flex;">
          <div>Perihal</div>
          <div style="padding-left: 5px; padding-right: 5px;">:</div>
          <div style="font-weight: bold;">Persetujuan Prinsip Pinjaman</div>
        </div>
      </div>
      <div>Purwokerto, {{ tglCarbon($pengajuan->approved_date, 'd F Y') }}</div>
    </div>
    <div style="margin-bottom: 30px;">
      <div>Kepada Yth:</div>
      <div style="font-weight: bold;">{{ $pengajuan->nama }}</div>
      <div style="text-transform: uppercase;">{{ $pengajuan->karyawan->masterCabang->nama_cabang }}</div>
    </div>
    <div>
      <p style="font-weight: bold;">Assalamu’alaikum warahmatullah wabarakatuh</p>
    </div>
    <div>
      <p>
        Semoga Allah Subhanahu Wa Ta’ala memberikan rahmat dan hidayah – Nya kepada kita semua dalam menjalankan aktivitas kita sehari – hari. Aamiin
        <br>
        Sehubungan dengan permohonan pengajuan pinjaman Sdr/i. <span style="font-weight: bold;">{{ $pengajuan->nama }}</span> (Selanjutnya disebut Karyawan {{ $pengajuan->karyawan->masterCabang->nama_cabang }}) seperti tertuang dalam surat tanggal {{ tglCarbon($pengajuan->created_at, 'd F Y') }} untuk memperoleh pinjaman, bersama ini kami sampaikan bahwa ABATA PEDULI pada prinsipnya dapat menyetujui permohonan dimaksud, dengan kondisi dan persyaratan sebagai berikut :
      </p>
      <ol style="list-style-type: upper-roman;">
        <li style="margin-bottom: 10px;">
          FASILITAS <br>
          <table>
            <tr>
              <td>Keperluan</td>
              <td>:</td>
              <td>{{ $pengajuan->keperluan }}</td>
            </tr>
            <tr>
              <td>Pinjaman</td>
              <td>:</td>
              <td>Rp {{ rupiah($pengajuan->pinjaman) }}</td>
            </tr>
            <tr>
              <td>Jangka Waktu</td>
              <td>:</td>
              <td>
                {{ $pengajuan->angsuran }} (<span style="text-transform: capitalize;">{{ terbilang($pengajuan->angsuran) }}</span> ) bulan
              </td>
            </tr>
            <tr>
              <td>Biaya Administrasi</td>
              <td>:</td>
              <td>Rp 30.000,-</td>
            </tr>
          </table>
        </li>
        <li>
          JAMINAN <br>
          <p style="padding: 0; margin: 0;">
            Untuk mengcover fasilitas pinjaman, jaminan yang digunakan adalah Ijazah Terakhir yang diserahkan dan/atau yang sudah diserahkan ke Human Capital Departement.
          </p>
        </li>
        <li>
          PERSYARATAN – PERSYARATAN LAIN YANG MENGIKAT <br>
          <div>
            <span style="font-weight: bold; text-decoration: underline;">Sebelum pencairan fasilitas</span>, Karyawan Abata diwajibkan melaksanakan hal – hal sebagai berikut :
            <ol style="list-style-type: lower-alpha;">
              <li>Masih aktif sebagai karyawan Abata sejak awal permohonan hingga berakhirnya akad</li>
              <li>Memiliki masa kerja lebih dari atau sama dengan 1 tahun diluar masa training</li>
              <li>Melengkapi dan menyerahkan seluruh dokumen baik dokumen data diri dan bukti transaksi penggunaan pinjaman</li>
              <li>d.Bersedia untuk memperpanjang kontrak jika masa kontrak habis sebelum berakhirnya akad pinjaman <span style="font-weight: bold;">(atau melunasi sisa pinjaman jika tidak diperpanjang)</span></li>
              <li>Bebas dari kasbon cabang dan hutang order di cabang</li>
            </ol>
          </div>
          <div>
            <span style="font-weight: bold; text-decoration: underline;">Selama masa pinjaman, Karyawan Abata diwajibkan melaksanakan hal – hal sebagai berikut :</span>
            <ol style="list-style-type: lower-alpha;">
              <li>Memprioritaskan pembayaran kewajiban ke ABATA PEDULI setiap tanggal 28</li>
              <li>Mengadministrasikan fasilitas pinjaman dari ABATA PEDULI secara lengkap dan tertib</li>
              <li>Wajib mentaati dan mematuhi peraturan Abata Group</li>
              <li>Melakukan pekerjaan dengan baik dan benar sesuai dengan prosedur</li>
            </ol>
          </div>
        </li>
      </ol>
      <div style="display: flex;">
        <div>
          <img src="{{ asset('public/assets/abdul-kop-surat-kiri-bawah.png') }}" alt="abdul-kop-surat-bawah" style="width: 10px; height: 67px;">
        </div>
        <div>
          <table style="font-style: italic; color: grey;">
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>Jl. Moch. Yamin  III, Karangpucung, Purwokerto Selatan</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td>085601777740</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>adm.abatapeduli@gmail.com</td>
            </tr>
          </table>
        </div>
      </div>
      <div style="display: flex; justify-content: space-between; padding-top: 10px; margin-bottom: 30px;">
        <div><img src="{{ asset('public/assets/abdul-logo.png') }}" alt="abdul-logo" style="max-width: 150px;"></div>
        <div><img src="{{ asset('public/assets/abdul-kop-surat.png') }}" alt="abdul-kop-surat" style="max-width: 80px;"></div>
      </div>
      <div>
        <ol style="list-style-type: none;">
          <li>
            <span style="font-weight: bold; text-decoration: underline;">Persyaratan – persyaratan lainnya :</span>
            <ol style="list-style-type: lower-alpha;">
              <li>Realisasi pinjaman dilakukan jika semua persyaratan telah dipenuhi</li>
              <li>Semua biaya yang timbul akibat pinjaman ini menjadi beban karyawan Abata dan dibayar dimuka</li>
              <li>Apabila dianggap perlu disebabkan suatu pertimbangan resiko yang dipikul, ABATA PEDULI berhak meminta jaminan dan mengambil langkah – langkah terhadap jaminan tersebut jika dianggap perlu.</li>
              <li>Apabila tidak mengajukan perpanjangan akad dan/atau ada hal – hal yang mengakibatkan karyawan meninggal dunia dan/atau diberhentikan kerjasamanya dengan Abata Group maka akan dilakukan pemotongan kewajiban pinjaman secara sepihak oleh Abata Peduli.</li>
              <li>Apabila pembayaran upah yang diterima pada  bulan terakhir kerjasama lebih kecil dari kewajiban pengembalian pinjaman, maka bersedia mengisi dan menyetujui dokumen Surat Pernyataan dan Pengakuan Hutang.</li>
              <li>Hal – hal lain yang belum diatur dalam surat persetujuan ini akan diatur dalam perjanjian pinjaman dan merupakan satu kesatuan yang tidak terlepas dari surat persetujuan ini sesuai dengan ketentuan yang berlaku.</li>
              <li style="font-weight: bold; font-style: italic;">Jika masa kontrak yang saat ini berjalan sudah habis dan angsuran Abata Peduli masih ada maka yang bersangkutan bersedia untuk memperpanjang kontrak dengan CV Abata.</li>
            </ol>
          </li>
        </ol>
      </div>
      <div>
        <p>
          Surat persetujuan ini merupakan satu kesatuan yang tidak terlepas dengan perjanjian pinjaman yang akan ditandatangani di kemudian hari. Sebagai tanda persetujuan, surat ini di tandatangani diatas materai 10.000.
        </p>
      </div>
      <div style="font-weight: bold;">Wassalamu’alaikum warahmatullah wabarkatuh</div>
      <div style="text-align: center; margin-bottom: 100px; margin-top: 20px; font-weight: bold;">ABATA PEDULI</div>
      <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <div style="display: flex; justify-content: center; width: 50%;">
          <div>
            <div style="font-weight: bold;">Wahyu Mardianto, S.E.</div>
            <div style="font-style: italic;">Direktur Abata Group</div>
          </div>
        </div>
        <div style="display: flex; justify-content: center; width: 50%;">
          <div>
            <div style="font-weight: bold;">Rizky Alfiani Febriana</div>
            <div style="font-style: italic;">Koordinator Abata Peduli</div>
          </div>
        </div>
      </div>
      <div>
        <div style="text-align: center; margin-bottom: 30px; font-weight: bold;">Menyetujui persyaratan tersebut diatas,</div>
        <div style="text-align: center; color: grey; margin-bottom: 30px; color: grey;">Materai 10.000</div>
        <div style="text-align: center; font-weight: bold;">{{ $pengajuan->nama }}</div>
      </div>
      <div style="display: flex; margin-top: 70px;">
        <div>
          <img src="{{ asset('public/assets/abdul-kop-surat-kiri-bawah.png') }}" alt="abdul-kop-surat-bawah" style="width: 10px; height: 67px;">
        </div>
        <div>
          <table style="font-style: italic; color: grey;">
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>Jl. Moch. Yamin  III, Karangpucung, Purwokerto Selatan</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td>085601777740</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>adm.abatapeduli@gmail.com</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.print();
  </script>
</body>
</html>