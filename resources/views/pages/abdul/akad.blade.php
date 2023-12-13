<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akad Al - Qardh</title>
</head>
<body>
  <div style="text-align: right; opacity: 0.5; margin-bottom: 30px;">Al-Qardh ABATA PEDULI</div>
  <div style="font-weight: bold; text-align: center;">BISMILLAHIRRAHMANIRRAHIM</div>
  <div style="text-align: center; margin-bottom: 30px; font-size: 12px;">“Dengan Nama ALLAH yang Maha Pengasih dan Penyayang”</div>
  <div style="text-align: center; font-weight: bold; margin-bottom: 30px;">AKAD AL-QARDH</div>
  <div style="text-align: center; font-style: italic; margin-bottom: 20px;">
    “Hai orang-orang yang beriman, janganlah kamu mengkhianati Allah dan Rasul dan juga janganlah kamu <br> mengkhianati amanah-amanah yang dipercayakan kepada kamu, sedang kamu mengetahui” <br> (QS. Al-Anfaal: 27).
  </div>
  <div>
    <p style="text-align: justify;">Pada hari ini {{ tglCarbon(date('Y-m-d'), 'l') }}, tanggal <span style="text-transform: capitalize;">{{ terbilang(date('j')) }}</span> bulan {{ tglCarbon(date('Y-m-d'), 'F') }} tahun <span style="text-transform: capitalize;">{{ terbilang(date('Y')) }}</span> ({{ tglCarbon(date('Y-m-d'), 'd-m-Y') }}), yang bertandatangan di bawah ini :</p>
  </div>
  <div>
    <ol style="list-style-type: upper-roman; padding-left: 18px;">
      <li>
        <div style="display: flex;">
          <div style="width: 200px;">Nama</div>
          <div style="margin-right: 10px;">:</div>
          <div>Rizky Alfiani Febriana</div>
        </div>
        <div style="margin-bottom: 10px; text-align: justify;">bertindak dalam  jabatannya selaku <span style="font-weight: bold;">KOORDINATOR ABATA PEDULI</span> selanjutnya disebut <span style="font-weight: bold;">”ABATA PEDULI”</span>.</div>
      </li>
      <li>
        <div style="display: flex;">
          <div style="width: 200px;">Nama</div>
          <div style="margin-right: 10px;">:</div>
          <div>{{ $pengajuan->nama }}</div>
        </div>
        <div style="display: flex;">
          <div style="width: 200px;">Tempat/Tanggal Lahir</div>
          <div style="margin-right: 10px;">:</div>
          <div>
            {{ $pengajuan->karyawan->tempat_lahir }}, 

            {{ tglCarbon($pengajuan->karyawan->tanggal_lahir, 'd F Y') }}
          </div>
        </div>
        <div style="display: flex;">
          <div style="width: 200px;">No.KTP/Paspor</div>
          <div style="margin-right: 10px;">:</div>
          <div>{{ $pengajuan->karyawan->nomor_ktp }}</div>
        </div>
        <div style="margin-top: 10px; text-align: justify;">
          bertindak untuk untuk dan atas nama sendiri, beralamat/berkedudukan di <span style="text-transform: capitalize;">{{ strtolower($pengajuan->karyawan->alamat_domisili) }}</span>, selanjutnya disebut <span style="font-weight: bold;">”PEMINJAM”</span>;
        </div>
      </li>
    </ol>
  </div>
  <div style="text-align: justify;">
    <span style="font-weight: bold;">ABATA PEDULI</span> dan <span style="font-weight: bold;">PEMINJAM</span>, selanjutnya secara bersama-sama disebut <span style="font-weight: bold;">“Para Pihak”</span>, Para pihak terlebih dahulu menerangkan hal-hal sebagai berikut :
  </div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        Bahwa, berdasarkan surat permohonan pengajuan pinjaman karyawan tanggal {{ tglCarbon($pengajuan->created_at, 'd F Y') }}, <span style="font-weight: bold;">PEMINJAM</span> telah mengajukan permohonan kepada ABATA PEDULI untuk menyediakan fasilitas Al-Qardh dalam rangka <span style="font-weight: bold; text-transform: capitalize;">{{ $pengajuan->keperluan }}</span>.
      </li>
      <li style="text-align: justify;">
        Bahwa ABATA PEDULI telah menyatakan persetujuannya untuk memberikan fasilitas Al-Qardh kepada <span style="font-weight: bold;">PEMINJAM</span> sebagaimana tertuang dalam Surat Persetujuan Pinjaman tanggal <span style="font-weight: bold;">{{ tglCarbon($pengajuan->created_at, 'd F Y') }}</span>.
      </li>
    </ol>
  </div>
  <div>
    <p style="text-align: justify;">
      Sehubungan dengan hal-hal yang telah diterangkan di atas, Para Pihak sepakat untuk membuat Akad Al-Qardh, selanjutnya disebut <span style="font-weight: bold;">“Akad”</span>, dengan syarat-syarat dan ketentuan-ketentuan sebagai berikut :
    </p>
  </div>
  <div style="text-align: center; font-weight: bold;">Pasal 1</div>
  <div style="text-align: center; font-weight: bold;">DEFINISI</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Akad Al-Qardh</span> adalah perjanjian dan perikatan pemberian dana talangan dari ABATA PEDULI untuk menunjang kegiatan usaha dan/atau kebutuhan PEMINJAM yang diberikan berdasarkan prinsip syariah, yang wajib dikembalikan oleh PEMINJAM pada tanggal yang disepakati oleh ABATA PEDULI dan PEMINJAM.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Abata Peduli</span> adalah salah satu divisi pengelola dana CSR (Corporate Social Responsibility) Abata Group.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Peminjam</span> adalah karyawan aktif Abata Group yang bertugas di salah satu cabang Abata Group.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Cidera Janji</span> adalah peristiwa atau peristiwa-peristiwa sebagaimana dimaksud Pasal 11 Akad ini, yang menyebabkan ABATA PEDULI dapat menghentikan seluruh atau sebagian dari isi Akad ini, menagih seketika dan sekaligus jumlah kewajiban PEMINJAM kepada ABATA PEDULI sebelum jangka waktu Akad ini berakhir.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Kewajiban Peminjam</span> adalah segala sesuatu yang berkaitan dengan pengembalian nilai hutang berdasarkan Akad Al-Qardh sebagaimana dimaksud dalam Akad ini .
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Pinjaman Al-Qardh</span> adalah fasilitas pinjaman yang diberikan oleh ABATA PEDULI kepada PEMINJAM berdasarkan Akad Al-Qardh.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Tanda Terima Uang</span> adalah bukti penerimaan uang oleh PEMINJAM yang berasal dari pencairan fasilitas Al-Qardh.
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Utang Al-Qardh</span> adalah utang PEMINJAM yang timbul karena Akad Al-Qardh yang wajib dibayar oleh PEMINJAM kepada ABATA PEDULI.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 2</div>
  <div style="text-align: center; font-weight: bold;">POKOK PERJANJIAN</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        ABATA PEDULI dengan ini memberikan fasilitas Al-Qardh kepada PEMINJAM sebesar <span style="font-weight: bold;">Rp {{ rupiah($pengajuan->pinjaman) }}</span> (<span style="text-transform: capitalize; font-weight: bold;">{{ terbilang($pengajuan->pinjaman) }} Rupiah)</span> dan PEMINJAM dengan ini mengikatkan menerima fasilitas Al-Qardh tersebut dari ABATA PEDULI dan mengaku berutang kepada ABATA PEDULI atas setiap Kewajiban PEMINJAM yang timbul dari Akad ini .
      </li>
      <li style="text-align: justify;">
        Fasilitas Al-Qardh tersebut diminta oleh PEMINJAM kepada ABATA PEDULI dalam rangka membiayai kebutuhan PEMINJAM sebagaimana disebutkan dalam surat permohonan pengajuan pinjaman PEMINJAM tersebut dalam awal Akad ini.
      </li>
      <li style="text-align: justify;">
        Bahwa salah satu syarat persetujuan realisasi  fasilitas Al-Qardh berdasarkan Akad ini adalah pemberian fasilitas tersebut akan dilakukan sesuai dengan prinsip-prinsip syariah dan prosedur, serta ketentuan-ketentuan yang berlaku maupun yang akan ditetapkan kemudian pada/oleh ABATA PEDULI
      </li>
      <li style="text-align: justify;">
        Realisasi  fasilitas Al-Qardh oleh ABATA PEDULI kepada PEMINJAM diberikan dengan memperhatikan ketentuan-ketentuan dalam Akad ini , serta tersedianya dana pada ABATA PEDULI
      </li>
      <li style="text-align: justify;">
        ABATA PEDULI sewaktu-waktu berhak (atas kebijakan ABATA PEDULI sendiri) untuk mengurangi pagu/plafon fasilitas Al-Qardh dan/atau membatalkan tanpa syarat pemberian Akad ini dengan semata-mata menurut pertimbangan ABATA PEDULI:
        <ol style="list-style-type: lower-alpha;">
          <li style="text-align: justify;">
            Bahwa kondisi/kualitas fasilitas Al-Qardh yang diperoleh PEMINJAM dari ABATA PEDULI berdasarkan Akad ini atau Pinjaman lainnya menurun menjadi kurang lancar, diragukan atau macet.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        PEMINJAM sepenuhnya bertanggung-jawab atas ketepatan atau kebenaran penggunaan  fasilitas Al-Qardh dan ABATA PEDULI sewaktu-waktu dapat meminta pelunasan seluruh outstanding  fasilitas Al-Qardh jika ketepatan atau kebenaran penggunaan fasilitas Al-Qardh di luar keperluan/tujuannya sebagaimana ditetapkan dalam Akad ini.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold;">Pasal 3</div>
  <div style="text-align: center; font-weight: bold;">JANGKA WAKTU</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        @php $jml_angsuran = $pengajuan->angsuran - 1; @endphp
        Akad ini berlangsung untuk jangka waktu {{ $pengajuan->angsuran }} (<span style="text-transform: capitalize;">{{ terbilang($pengajuan->angsuran) }}</span>) bulan, terhitung sejak tanggal <span style="font-weight: bold;">{{ tglCarbon($pengajuan->tanggal_bayar, 'd F Y') }}</span> sampai dengan tanggal <span style="font-weight: bold;">{{ tglCarbon(date('Y-m-d', strtotime('+'.$jml_angsuran.' month', strtotime($pengajuan->tanggal_bayar))), 'd F Y') }}</span>.
      </li>
      <li style="text-align: justify;">
        PEMINJAM wajib melunasi fasilitas Al-Qardh selambat-lambatnya pada akhir jangka waktu Akad ini.
      </li>
      <li style="text-align: justify;">
        Perpanjangan Jangka Waktu Akad
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM dapat mengajukan perpanjangan jangka waktu fasilitas Al-Qardh dengan cara mengajukan permohonan tertulis kepada ABATA PEDULI sekurang-kurangnya 2 (dua) bulan sebelum berakhirnya jangka waktu Akad ini. Atas permohonan tersebut, ABATA PEDULI memiliki hak untuk menyetujui atau menolak perpanjangan jangka waktu Akad ini berdasarkan pertimbangan ABATA PEDULI sendiri.
          </li>
          <li style="text-align: justify;">
            Perpanjangan jangka waktu Akad ini sebagaimana dimaksud Ayat 3.a di atas akan dinyatakan dalam suatu perjanjian tersendiri yang dibuat oleh dan antara ABATA PEDULI dan PEMINJAM.
          </li>
        </ol>
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold;">Pasal 4</div>
  <div style="text-align: center; font-weight: bold;">BIAYA ADMINISTRASI</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        PEMINJAM sepakat dan dengan ini mengikatkan diri untuk membayar kepada ABATA PEDULI, Biaya Administrasi sebesar Rp. 30.000,- (Tiga puluh ribu rupiah)  yang wajib dibayar PEMINJAM sebelum fasilitas Al-Qardh dicairkan.
      </li>
      <li style="text-align: justify;">
        PEMINJAM dengan ini memberi kuasa kepada ABATA PEDULI dengan hak subtitusi untuk melakukan pemotongan gaji PEMINJAM untuk keperluan tersebut pada Pasal 4 Akad ini. Apabila total penerimaan gaji PEMINJAM pada ABATA PEDULI tidak mencukupi untuk memenuhi kewajiban-kewajibannya tersebut, maka PEMINJAM wajib segera melakukan penambahan guna mencukupi angsuran PEMINJAM;
      </li>
      <li style="text-align: justify;">
        Setiap pembayaran/pelunasan Kewajiban PEMINJAM sehubungan dengan Akad ini , dan/atau perjanjian lain yang terkait dengan Akad ini, dilakukan oleh PEMINJAM kepada ABATA PEDULI tanpa potongan, pungutan, bea, pajak dan/atau biaya-biaya lainnya, kecuali jika potongan, pungutan, bea, pajak dan/atau biaya-biaya lainnya tersebut diharuskan berdasarkan peraturan perundang-undangan yang berlaku.
      </li>
      <li style="text-align: justify;">
        Biaya Administrasi dan biaya lain yang telah dibayarkan PEMINJAM kepada ABATA PEDULI tidak dapat ditarik kembali dengan alasan apapun juga.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 5</div>
  <div style="text-align: center; font-weight: bold;">REALISASI PINJAMAN DAN/ATAU PENGGUNAAN FACILITY</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        Dengan tetap memperhatikan batasan-batasan dan ketentuan-ketentuan lain yang ditetapkan oleh pihak yang berwenang, ABATA PEDULI berjanji dan mengikat diri untuk merealisasikan  fasilitas Al-Qardh, setelah PEMINJAM memenuhi seluruh persyaratan sebagai berikut:
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            Menyerahkan kepada ABATA PEDULI seluruh dokumen yang disyaratkan oleh ABATA PEDULI termasuk namun tidak terbatas pada dokumen bukti diri PEMINJAM, dan atau surat lainnya yang berkaitan dengan Akad ini yang telah ditandatangani oleh PEMINJAM.
          </li>
          <li style="text-align: justify;">
            Setiap pemberian  fasilitas Al-Qardh berdasarkan Akad ini hanya dapat dilakukan pada Hari Kerja.
          </li>
          <li style="text-align: justify;">
            Permintaan untuk realisasi  fasilitas Al-Qardh diajukan secara tertulis oleh PEMINJAM kepada ABATA PEDULI selambat-lambatnya 7 (tujuh) Hari Kerja sebelum tanggal realisasi  fasilitas Al-Qardh dengan menandatangani aplikasi permohonan realisasi  fasilitas Al-Qardh dan dokumen-dokumen yang dipersyaratkan oleh ABATA PEDULI, dan/atau instansi yang berwenang lainnya.
          </li>
          <li style="text-align: justify;">
            Menandatangani Akad ini dan dokumen lainnya yang disyaratkan oleh ABATA PEDULI;
          </li>
          <li style="text-align: justify;">
            Melunasi biaya-biaya yang disyaratkan oleh ABATA PEDULI sebagaimana tercantum dalam Surat Persetujuan Prinsip Pinjaman dan yang terkait dengan pembuatan Akad ini dan perjanjian lain yang terkait dengan Akad ini;
          </li>
          <li style="text-align: justify;">
            Segala persyaratan lainnya yang tercantum dalam Surat Persetujuan Prinsip Pinjaman.
          </li>
          <li style="text-align: justify;">
            Pernyataan dan Jaminan yang tercantum dalam Akad ini, dan perjanjian Jaminan adalah sebenarnya, masih berlaku pada tanggal realisasi  fasilitas Al-Qardh  dan/atau pada tanggal digunakannya  fasilitas Al-Qardh.
          </li>
          <li style="text-align: justify;">
            ABATA PEDULI telah menerima :
            <ul style="padding-left: 15px;">
              <li style="text-align: justify;">
                copy dari semua permohonan, pendaftaran, persetujuan, dan perizinan, yang diperlukan atau disarankan sehubungan dengan usaha PEMINJAM atau pelaksanaan Akad ini, dan lain-lain dokumen yang diharuskan dan disahkan kebenarannya oleh pejabat yang berwenang dari PEMINJAM ;
              </li>
              <li style="text-align: justify;">
                ABATA PEDULI telah menerima dokumen yang membuktikan mengenai wewenang PEMINJAM untuk melakukan tindakan hukum dan menandatangani Akad ini , perjanjian Jaminan serta dokumen-dokumen lain yang ditentukan dalam Akad ini ,  perjanjian Jaminan dan karenanya mengikat PEMINJAM ;
              </li>
              <li style="text-align: justify;">
                bukti yang menunjukkan  bahwa PEMINJAM  telah membayar semua bea meterai, pajak, dan biaya lain-lain kepada negara, sehubungan dengan Akad ini , perjanjian Jaminan dan dokumen-dokumen lain yang telah ditentukan;
              </li>
              <li style="text-align: justify;">
                dokumen-dokumen yang menjadi persyaratan realisasi  fasilitas Al-Qardh dan dokumen-dokumen lain yang dipandang perlu dan diminta oleh ABATA PEDULI.
              </li>
              <li style="text-align: justify;">
                Pada saat realisasi  fasilitas Al-Qardh, tidak terjadi perselisihan, klaim, atau tuntutan lainnya yang terjadi di pengadilan, badan arbitrase atau institusi lainnya yang dapat mengganggu operasi dan/atau kinerja usaha dan/atau kemampuan PEMINJAM dan/atau penjamin dalam memenuhi kewajibannya kepada ABATA PEDULI.
              </li>
            </ul>
          </li>
          <li style="text-align: justify;">
            Pada saat realisasi  fasilitas Al-Qardh tidak terjadi atau berlangsung suatu peristiwa Kelalaian/Cidera Janji /pelanggaran (event of default) sebagaimana diuraikan dalam Akad ini.
          </li>
          <li style="text-align: justify;">
            [lain-lain disesuaikan dengan Surat Persetujuan Prinsip Pinjaman]
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        Terhadap permintaan realisasi  fasilitas Al-Qardh yang diajukan oleh PEMINJAM, ABATA PEDULI berhak atas pertimbangannya sendiri untuk tidak merealisasikan  fasilitas Al-Qardh, dengan suatu pemberitahuan tertulis sebelumnya.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 80px;">Pasal 6</div>
  <div style="text-align: center; font-weight: bold;">PEMBAYARAN KEMBALI</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        PEMINJAM berjanji dan dengan ini mengikatkan diri untuk mengembalikan kepada ABATA PEDULI, seluruh jumlah Utang Al-Qardh paling lambat pada tanggal berakhirnya Akad Al-Qardh dengan mekanisme/tata cara yang disepakati Para Pihak atau sesuai dengan jadwal yang disepakati dalam lampiran Akad Al-Qardh dan menjadi satu kesatuan yang tidak dapat dipisahkan dari Akad ini. Pelanggaran atas ketentuan ini, baik mengenai jumlah maupun keterlambatan pembayaran kembali, sudah merupakan bukti kelalaian PEMINJAM tanpa diperlukan alat bukti lain, dan ABATA PEDULI atas dasar kelalaian tersebut berhak menentukan bahwa  fasilitas Al-Qardh jatuh tempo sebagaimana diatur dalam pasal 11 Akad ini
      </li>
      <li style="text-align: justify;">
        Dalam hal PEMINJAM membayar kembali atau melunasi Pinjaman yang diberikan oleh ABATA PEDULI lebih awal dari waktu yang diperjanjikan, maka tidak berarti pembayaran tersebut akan menghapuskan atau mengurangi Biaya Administrasi yang telah atau belum dibayar PEMINJAM kepada ABATA PEDULI.
      </li>
      <li>
        Setiap pembayaran, pelunasan atau angsuran atas Kewajiban PEMINJAM wajib dilakukan PEMINJAM pada Hari Kerja ABATA PEDULI atau tempat lain yang ditunjuk oleh ABATA PEDULI dan dibayarkan melalui rekening, sehingga dalam hal pembayaran diterima oleh ABATA PEDULI setelah jam kerja ABATA PEDULI, maka pembayaran tersebut akan dibukukan pada keesokan harinya dan apabila hari tersebut bukan Hari Kerja ABATA PEDULI, pembukuan akan dilakukan pada Hari Kerja ABATA PEDULI yang pertama setelah pembayaran diterima.
      </li>
      <li style="text-align: justify;">
        Semua pembayaran atau pembayaran kembali atas Utang  Al-Qardh, Biaya Administrasi dan lain-lain jumlah uang yang terutang oleh PEMINJAM kepada ABATA PEDULI sehubungan dengan  fasilitas Al-Qardh, wajib dilakukan oleh PEMINJAM dalam mata uang yang sama dengan mata uang Kewajiban PEMINJAM apabila tidak ada pemberitahuan tertulis dari ABATA PEDULI untuk membayar dalam mata uang yang lain.
      </li>
      <li style="text-align: justify;">
        Pembayaran kembali oleh PEMINJAM atas Utang Al-Qardh berikut Biaya Administrasi dan lain-lain jumlah uang yang wajib dibayar oleh PEMINJAM kepada ABATA PEDULI, dilakukan dengan cara transfer melalui rekening ABATA PEDULI dan atau memotongnya secara otomatis dari gaji yang PEMINJAM.
      </li>
      <li style="text-align: justify;">
        Semua pembayaran atau pembayaran kembali atas Utang Al-Qardh berikut Biaya Administrasi dan lain-lain jumlah uang yang terutang oleh PEMINJAM kepada ABATA PEDULI sehubungan dengan  fasilitas Al-Qardh adalah bebas dan tanpa pengurangan atau pemotongan untuk pajak-pajak, biaya-biaya, pungutan-pungutan atau beban-beban apapun juga yang dikenakan oleh instansi perpajakan yang berwenang.
      </li>
      <li style="text-align: justify;">
        PEMINJAM tidak diperbolehkan membayar kewajibannya kepada ABATA PEDULI dengan jalan menjumpakan atau memperhitungkan (kompensasi) dengan tagihan, tuntutan/klaim PEMINJAM kepada ABATA PEDULI bila ada, dan PEMINJAM juga tidak diperbolehkan menuntut suatu pembayaran lain (counter claim) kepada ABATA PEDULI. Untuk hal tersebut, PEMINJAM dengan ini melepaskan seluruh haknya sebagaimana dimaksud dalam pasal 1425 sampai dengan pasal 1429 Kitab Undang-Undang Hukum Perdata.
      </li>
      <li style="text-align: justify;">
        Bilamana pembayaran atau pembayaran kembali yang harus dilakukan PEMINJAM kepada ABATA PEDULI atas Kewajiban PEMINJAM, biaya-biaya dan lain-lain jumlah uang yang terutang  oleh PEMINJAM kepada ABATA PEDULI sehubungan dengan  fasilitas Al-Qardh berdasarkan Akad ini , dan   atau berdasarkan instrumen lain yang berkaitan dengan Akad ini , jatuh bukan pada Hari Kerja, maka pembayaran atau pembayaran kembali tersebut harus dilakukan pada 1 (satu) Hari Kerja sebelumnya.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 7</div>
  <div style="text-align: center; font-weight: bold;">PENGAKUAN UTANG DAN PEMBUKTIAN UTANG</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        PEMINJAM dengan ini mengaku berutang pada ABATA PEDULI atas Kewajiban PEMINJAM yang belum dilunasi kepada ABATA PEDULI untuk memenuhi Kewajibannya sebagaimana diatur dalam Akad ini. Oleh karenanya PEMINJAM dengan ini sekarang untuk nanti pada waktunya mengaku benar-benar dan secara sah telah berutang kepada ABATA PEDULI disebabkan karena Kewajiban PEMINJAM yang timbul berdasarkan Akad ini, uang sejumlah pokok sebesar <span style="font-weight: bold;">Rp {{ rupiah($pengajuan->pinjaman) }}</span> (<span style="text-transform: capitalize; font-weight: bold;">{{ terbilang($pengajuan->pinjaman) }} Rupiah)</span> atau keseluruhan jumlah-jumlah uang yang diterima sebagai utang oleh PEMINJAM dari ABATA PEDULI berdasarkan Akad ini, demikian berikut dengan Biaya Administrasi yang wajib dibayar oleh PEMINJAM kepada ABATA PEDULI berdasarkan Akad ini.
      </li>
      <li style="text-align: justify;">
        PEMINJAM menyetujui bahwa jumlah Kewajiban PEMINJAM yang terutang oleh PEMINJAM kepada ABATA PEDULI pada waktu-waktu tertentu akan terbukti dari :
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            Rekening PEMINJAM yang dipegang dan digunakan untuk kepentingan payroll;
          </li>
          <li style="text-align: justify;">
            Catatan-catatan dan administrasi yang dipegang dan dipelihara oleh ABATA PEDULI mengenai atau sehubungan dengan pemberian  fasilitas Al-Qardh kepada PEMINJAM; dan/atau
          </li>
          <li style="text-align: justify;">
            Surat-surat dan dokumen-dokumen lain yang dikeluarkan oleh ABATA PEDULI.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        Apabila karena kesalahan ABATA PEDULI yang dapat dibuktikan oleh PEMINJAM menyebabkan jumlah yang diterima oleh ABATA PEDULI melebihi jumlah yang terutang oleh PEMINJAM kepada ABATA PEDULI, maka ABATA PEDULI wajib mengembalikan kelebihannya kepada PEMINJAM namun ABATA PEDULI tidak diwajibkan membayar biaya apapun kepada PEMINJAM atas kelebihan pembayaran tersebut.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 8</div>
  <div style="text-align: center; font-weight: bold;">PERNYATAAN DAN JAMINAN PEMINJAM</div>
  <div style="margin-top: 20px;">
    PEMINJAM  menyatakan dan menjamin ABATA PEDULI hal-hal sebagai berikut :
  </div>
  <div>
    <ol style="list-style-type: lower-roman; padding-left: 22px;">
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Kewenangan</span>
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM berhak, cakap  dan berwenang sepenuhnya untuk menandatangani Akad ini dan semua surat dokumen yang menjadi kelengkapannya serta berhak pula untuk menjalankan usaha tersebut dalam Akad ini.
          </li>
          <li style="text-align: justify;">
            PEMINJAM mempunyai kuasa penuh dan wewenang untuk meminjam dan memenuhi kewajibannya dalam Akad ini ,  dan/atau dokumen lain, untuk menjalankan usahanya, memiliki harta kekayaan dan aset dan/atau terdaftar untuk menjalankan usahanya yang dijalankan sekarang, berhak dan/atau terdaftar untuk menjalankan usahanya di domisili hukum manapun
          </li>
          <li style="text-align: justify;">
            PEMINJAM tidak sedang dalam keadaan menderita kerugian yang mempengaruhi jalannya usahanya secara materil atau mempengaruhi kemampuannya dalam melaksanakan kewajibannya kepada ABATA PEDULI, dan pada saat ini tidak berada dalam keadaan sebagaimana dimaksud dalam pasal 142 Undang-Undang nomor 40 tahun 2007 tentang Perseroan Terbatas.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Tindakan Hukum PEMINJAM</span>
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM telah mengambil semua tindakan yang diperlukan sesuai ketentuan yang berlaku yang memberi wewenang untuk pelaksanaan Akad ini dan dokumen lain yang disyaratkan, dan pihak-pihak yang menandatangani dokumen-dokumen tersebut, telah diberi wewenang untuk berbuat demikian atas nama PEMINJAM.
          </li>
          <li style="text-align: justify;">
            PEMINJAM memiliki ijin-ijin dari pihak-pihak yang terkait yang mengharuskan PEMINJAM memperoleh ijin-ijin tersebut untuk membuat dan menandatangani Akad ini, menyerahkan jaminan-jaminan dan dokumen-dokumen lain yang berkaitan dengan Akad ini dan Perjanjian Jaminan.
          </li>
          <li style="text-align: justify;">
            Diadakannya Akad ini dan/atau penambahan/perubahan (Amandemen/Addendum) Akad ini tidak akan bertentangan dengan suatu akad/perjanjian yang telah ada atau yang akan diadakan oleh PEMINJAM dengan pihak ketiga lainnya.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Perikatan Akad ini</span>
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            Akad ini , Perjanjian Jaminan dan dokumen lain yang disyaratkan bila dilaksanakan dan diserahkan merupakan suatu kewajiban hukum bagi PEMINJAM  dan karenanya dapat dieksekusi sesuai dengan ketentuan-ketentuan yang tercantum di dalamnya.
          </li>
          <li style="text-align: justify;">
            Akad ini, Perjanjian Jaminan dan dokumen-dokumen lain yang disyaratkan, pada saat ditandatangani tidak melanggar Undang-Undang, Peraturan, Ketetapan atau Keputusan dari Negara Republik Indonesia dan juga tidak bertentangan dengan atau mengakibatkan pelanggaran terhadap setiap perjanjian yang mengikat PEMINJAM .
          </li>
          <li style="text-align: justify;">
            Semua permohonan, pendaftaran dan persetujuan yang diperlukan atau diharuskan agar kepastian pelaksanaan, penyerahan, keberhasilan, keabsahan, keefektifan maupun pengeksekusian Akad ini ,   dan dokumen lain yang diperlukan sesuai dengan yang disyaratkan telah dibuat dan diperoleh.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Tidak Terjadi/Mengalami Peristiwa Cidera Janji</span>
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM tidak mengalami hal atau peristiwa yang merupakan suatu peristiwa Cidera Janji, kelalaian/pelanggaran sebagaimana dimaksud dalam Akad ini maupun merupakan peristiwa kelalaian/pelanggaran terhadap perjanjian lain yang dibuat PEMINJAM dengan pihak lain, dan pemberian  fasilitas Al-Qardh oleh ABATA PEDULI kepada PEMINJAM  tidak akan menyebabkan timbulnya suatu peristiwa kelalaian/pelanggaran menurut perjanjian lain yang dibuat oleh PEMINJAM.
          </li>
          <li style="text-align: justify;">
            PEMINJAM tidak terlibat perkara pidana maupun perdata, tuntutan pajak atau sengketa yang sedang berlangsung atau menurut pengetahuan PEMINJAM akan menjadi ancaman dikemudian hari atau yang dapat berakibat negatif terhadap PEMINJAM atau harta kekayaannya, yang nantinya mempengaruhi keadaan keuangan atau usahanya atau dapat mengganggu kemampuannya untuk melakukan kewajibannya berdasarkan Akad ini.
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        <span style="font-weight: bold;">Transaksi Dengan Pihak Ketiga</span>
        <div>
          Transaksi atau kontrak kerja yang dilakukan oleh PEMINJAM dengan Pihak Ketiga yang merupakan dasar dari pemberian  fasilitas Al-Qardh oleh ABATA PEDULI kepada PEMINJAM adalah benar adanya, sah dan sesuai dengan peraturan perundang-undangan yang berlaku.
        </div>
      </li>
      <li style="text-align: justify;">
        Selama berlangsungnya Akad ini, PEMINJAM akan menjaga semua perizinan, lisensi, persetujuan dan sertifikat yang wajib dimiliki untuk melaksanakan usahanya.
      </li>
      <li style="text-align: justify;">
        Sepanjang tidak bertentangan dengan peraturan perundang-undangan yang berlaku, PEMINJAM berjanji dan dengan ini mengikatkan diri mendahulukan untuk membayar dan melunasi Kewajiban PEMINJAM kepada ABATA PEDULI dari kewajiban lainnya.
      </li>
      <li style="text-align: justify;">
        [lain-lain disesuaikan dengan Surat Persetujuan Prinsip Pinjaman].
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 9</div>
  <div style="text-align: center; font-weight: bold;">KEWAJIBAN DAN PEMBATASAN TERHADAP TINDAKAN PEMINJAM</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        PEMINJAM dengan ini berjanji dan mengikatkan diri selama jangka waktu Akad ini dan hingga pembayaran penuh dan lunas atas seluruh Kewajiban PEMINJAM berdasarkan Akad ini , maka PEMINJAM wajib melakukan hal-hal sebagai berikut:
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM wajib membayar kembali kepada ABATA PEDULI seluruh kewajibannya yang timbul baik karena kewajiban pelunasan  fasilitas Al-Qardh, Denda, Ganti Rugi dan Biaya Administrasi, secara tepat waktu sebagaimana ditentukan di dalam Akad in.
          </li>
          <li style="text-align: justify;">
            PEMINJAM wajib menggunakan  fasilitas Al-Qardh sesuai dengan tujuan penggunaannya sebagaimana ditetapkan dalam Akad ini.
          </li>
          <li style="text-align: justify;">
            PEMINJAM wajib memberikan seluruh keterangan baik lisan maupun tertulis dalam bentuk dokumen-dokumen, surat-surat atau dalam bentuk lainnya mengenai keadaan keuangan PEMINJAM dan/atau penjamin pada waktu dan dalam bentuk yang diminta ABATA PEDULI.
          </li>
          <li style="text-align: justify;">
            PEMINJAM wajib membayar semua pajak dan beban-beban lainnya berdasarkan ketentuan yang berlaku.
          </li>
          <li style="text-align: justify;">
            [lain-lain disesuaikan dengan Surat Persetujuan Prinsip Pinjaman].
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        Seluruh aktifitas keuangan PEMINJAM berkaitan dengan Akad ini   wajib disalurkan melalui Rekening PEMINJAM di ABATA PEDULI serta mencantumkan nomor Rekening PEMINJAM di ABATA PEDULI pada setiap Invoice/tagihan kepada pembeli/rekanan.
      </li>
      <li style="text-align: justify;">
        PEMINJAM  dan/atau penjamin wajib memberitahukan secara tertulis kepada ABATA PEDULI, jika terjadi kejadian berikut ini:
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            Setiap tuntutan perkara perdata terhadap PEMINJAM dan/atau penjamin yang nilainya minimal 1/3 (satu per tiga) dari Utang Al-Qardh;
          </li>
          <li style="text-align: justify;">
            Sesuatu perkara atau tuntutan hukum yang terjadi antara PEMINJAM dan/atau penjamin dengan suatu badan/instansi pemerintah; dan/atau
          </li>
          <li style="text-align: justify;">
            Suatu kejadian yang dengan lewatnya waktu atau karena pemberitahuan atau kedua-duanya akan menjadi kejadian kelalaian ke pihak lain,
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        [lain-lain disesuaikan dengan Surat Persetujuan Prinsip Pinjaman]
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; 20px;">Pasal 10</div>
  <div style="text-align: center; font-weight: bold;">CIDERA JANJI/KELALAIAN/PELANGGARAN</div>
  <div style="margin-top: 20px;">
    <div style="text-align: justify;">
      Menyimpang dari ketentuan dalam Pasal 3 Akad ini, ABATA PEDULI berhak untuk meminta kembali kepada  PEMINJAM atau siapa pun juga yang memperoleh hak darinya, atas seluruh atau sebagian jumlah Kewajiban PEMINJAM kepada ABATA PEDULI berdasarkan Akad  ini , untuk dibayar dengan seketika dan sekaligus, tanpa diperlukan adanya surat pemberitahuan, surat teguran, atau surat lainnya, apabila terjadi salah satu hal atau peristiwa tersebut di bawah ini:
    </div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        PEMINJAM tidak melaksanakan kewajiban pembayaran/pelunasan Kewajiban tepat pada waktu yang diperjanjikan sesuai dengan tanggal jatuh tempo, berdasarkan Akad ini;
      </li>
      <li style="text-align: justify;">
        Dokumen atau keterangan yang dimasukkan atau disuruh masukkan ke dalam dokumen yang diserahkan PEMINJAM kepada ABATA PEDULI adalah palsu, tidak sah, atau tidak benar;
      </li>
      <li style="text-align: justify;">
        Pihak yang bertindak untuk dan atas nama serta mewakili PEMINJAM dalam Akad ini  menjadi pemboros, pemabuk, atau dihukum penjara atau kurungan berdasarkan putusan Pengadilan yang telah berkekuatan tetap dan pasti (in kracht van gewijsde) karena tindak pidana yang dilakukannya;
      </li>
      <li style="text-align: justify;">
        PEMINJAM tidak memenuhi dan atau melanggar salah satu ketentuan atau lebih ketentuan-ketentuan yang tercantum dalam Akad ini;
      </li>
      <li style="text-align: justify;">
        Apabila berdasarkan peraturan perundang-undangan yang berlaku pada saat Akad ini ditandatangani atau diberlakukan pada kemudian hari, PEMINJAM tidak dapat atau tidak berhak menjadi PEMINJAM dan atau ABATA Group.;
      </li>
      <li style="text-align: justify;">
        PEMINJAM melakukan penyimpangan/kelalaian terhadap hal-hal yang disepakati dalam Akad ini yang mengakibatkan kerugian ABATA PEDULI sesuai dengan ketentuan yang berlaku pada ABATA PEDULI dan ABATA Group.
      </li>
      <li style="text-align: justify;">
        Cross Default
        <ul style="list-style-type: circle; padding-left: 15px;">
          <li style="text-align: justify;">
            PEMINJAM dan/atau salah satu Penjamin lalai melaksanakan sesuatu kewajiban atau melakukan pelanggaran terhadap sesuatu ketentuan dalam akad lain dan/atau perjanjian jaminan lain yang dibuat dengan ABATA PEDULI.
          </li>
          <li style="text-align: justify;">
            Bila pihak/PEMINJAM lain yang diberi  fasilitas Al-Qardh oleh ABATA PEDULI dengan jaminan seluruh atau sebagian dari Jaminan sebagaimana disebutkan dalam Akad ini, melakukan kelalaian atau pelanggaran yang ditentukan dalam akad Pinjaman yang dibuat pihak/PEMINJAM  lain tersebut dengan ABATA PEDULI.
          </li>
          <li style="text-align: justify;">
            Bilamana PEMINJAM dan/atau Penjamin lalai melaksanakan sesuatu kewajiban atau melakukan pelanggaran terhadap sesuatu ketentuan dalam sesuatu akad/perjanjian lain baik dengan ABATA PEDULI maupun dengan orang/pihak/ABATA PEDULI lain termasuk yang mengenai atau berhubungan dengan pinjaman uang/pemberian  fasilitas Al-Qardh dimana PEMINJAM dan/atau salah seorang penjamin adalah sebagai pihak yang menerima pinjaman atau sebagai penjamin dan kelalaian atau pelanggaran mana memberikan hak kepada ABATA PEDULI maupun pihak yang memberikan pinjaman atau  fasilitas Al-Qardh untuk menuntut pembayaran kembali atas apa yang terutang atau wajib dibayar oleh PEMINJAM dan/atau salah seorang  penjamin dalam perjanjian tersebut secara sekaligus sebelum tanggal jatuh tempo pinjamannya.
          </li>
        </ul>
      </li>
      <li style="text-align: justify;">
        Terjadi peristiwa apapun yang menurut pendapat ABATA PEDULI akan dapat mengakibatkan PEMINJAM/Penjamin tidak dapat memenuhi kewajiban-kewajibannya kepada ABATA PEDULI.
      </li>
      <li style="text-align: justify;">
        [lain-lain disesuaikan dengan Surat Persetujuan Prinsip Pinjaman]
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 11</div>
  <div style="text-align: center; font-weight: bold;">AKIBAT CIDERA JANJI</div>
  <div style="margin-top: 20px; text-align: justify;">
    Apabila terjadi satu atau lebih peristiwa sebagaimana dimaksud dalam Pasal 14 Akad ini, maka dengan mengesampingkan ketentuan dalam Pasal 1266 Kitab Undang-Undang Hukum Perdata, ABATA PEDULI berhak untuk:
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        Kewajiban ABATA PEDULI untuk memberikan  fasilitas Al-Qardh kepada PEMINJAM berdasarkan Akad ini menjadi berakhir.
      </li>
      <li style="text-align: justify;">
        Menyatakan semua Kewajiban PEMINJAM dan setiap jumlah uang yang pada waktu itu terutang oleh PEMINJAM  menjadi jatuh tempo dan dapat ditagih pembayarannya sekaligus oleh ABATA PEDULI tanpa peringatan atau teguran berupa apapun dan dari siapapun juga;
      </li>
      <li style="text-align: justify;">
        ABATA PEDULI berhak untuk menjalankan hak-hak dan wewenangnya yang timbul dari atau berdasarkan Akad ini  dan Perjanjian Jaminan;
      </li>
      <li style="text-align: justify;">
        Mengambil langkah-langkah yang dianggap perlu untuk mengamankan ABATA PEDULI termasuk namun tidak terbatas pada memasuki pekarangan, tanah dan bangunan, memeriksa barang Agunan beserta fasilitasnya yang melekat, memberi peringatan dengan cara memasang papan (plank) atau media lainnya; dan/atau
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 12</div>
  <div style="text-align: center; font-weight: bold;">KOMUNIKASI DAN PEMBERITAHUAN</div>
  <div>
    <ol style="padding-left: 18px;">
      <li>
        <div>Alamat Pemberitahuan</div>
        <div style="text-align: justify;">
          Semua surat menyurat atau pemberitahuan yang dikirim oleh masing-masing pihak kepada pihak yang lain harus dilakukan dengan surat tercatat, atau melalui kurir (ekspedisi) ke alamat-alamat sebagai berikut :
        </div>
        <div><span style="font-weight: bold;">ABATA PEDULI</span></div>
        <div style="display: flex;">
          <div style="width: 100px;">Alamat</div>
          <div style="margin-right: 10px;">:</div>
          <div>Jalan Moch.Yamin III, Karangpucung, Purwokerto Selatan</div>
        </div>
        <div style="display: flex; margin-bottom: 10px;">
          <div style="width: 100px;">Telepon</div>
          <div style="margin-right: 10px;">:</div>
          <div>085601777740</div>
        </div>
        <div><span style="font-weight: bold;">PEMINJAM</span></div>
        <div style="display: flex;">
          <div style="width: 100px;">Nama</div>
          <div style="margin-right: 10px;">:</div>
          <div>{{ $pengajuan->nama }}</div>
        </div>
        <div style="display: flex;">
          <div style="width: 100px;">Alamat</div>
          <div style="margin-right: 10px;">:</div>
          <div style="text-transform: capitalize;">{{ strtolower($pengajuan->alamat) }}</div>
        </div>
        <div style="display: flex;">
          <div style="width: 100px;">Telepon</div>
          <div style="margin-right: 10px;">:</div>
          <div>{{ $pengajuan->telepon }}</div>
        </div>
      </li>
      <li>
        Pemberitahuan dari salah satu pihak kepada pihak lainnya dianggap diterima:
        <ol style="list-style-type: lower-alpha; padding-left: 15px;">
          <li style="text-align: justify;">
            Jika dikirim melalui kurir (ekspedisi) pada tanggal penerimaan dan/atau;
          </li>
          <li style="text-align: justify;">
            Jika dikirim melalui pos tercatat 7 (tujuh) hari setelah tanggal pengirimannya, dan/atau;
          </li>
        </ol>
      </li>
      <li style="text-align: justify;">
        PEMINJAM dapat mengganti alamatnya dengan memberitahukan secara tertulis kepada ABATA PEDULI. Perubahan alamat tersebut dianggap diterima oleh ABATA PEDULI sesuai dengan ketentuan ayat 2 Pasal ini.
      </li>
      <li style="text-align: justify;">
        Dalam hal terjadi perubahan alamat ABATA PEDULI, pemberitahuan perubahan alamat ABATA PEDULI melalui media massa (cetak) berskala nasional atau lokal merupakan pemberitahuan resmi kepada PEMINJAM.
      </li>
    </ol>
  </div>
  <div style="text-align: center; font-weight: bold;">Pasal 13</div>
  <div style="text-align: center; font-weight: bold;">HUKUM YANG BERLAKU</div>
  <div style="margin-top: 20px; text-align: justify;">
    Pelaksanaan Akad ini tunduk kepada peraturan  perundang-undangan yang berlaku di Indonesia dan ketentuan syariah.
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 14</div>
  <div style="text-align: center; font-weight: bold;">PENYELESAIAN PERSELISIHAN DAN DOMISILI HUKUM</div>
  <div style="margin-top: 20px; text-align: justify;">
    Apabila di kemudian hari terjadi perbedaan pendapat atau penafsiran atas hal-hal yang tercantum di dalam Akad ini atau terjadi perselisihan atau sengketa dalam pelaksanaan Akad ini, Para Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.
  </div>
  <div style="text-align: center; font-weight: bold; margin-top: 20px;">Pasal 15</div>
  <div style="text-align: center; font-weight: bold;">KETENTUAN PENUTUP</div>
  <div>
    <ol style="padding-left: 18px;">
      <li style="text-align: justify;">
        Sebelum Akad ini ditandatangani oleh PEMINJAM, PEMINJAM mengakui dengan sebenarnya bahwa PEMINJAM telah membaca dengan cermat atau dibacakan kepadanya seluruh isi Akad ini berikut semua surat dan/atau dokumen yang menjadi lampiran Akad ini, sehingga  PEMINJAM memahami sepenuhnya segala yang akan menjadi akibat hukum setelah PEMINJAM menandatangani Akad ini.
      </li>
      <li style="text-align: justify;">
        PEMINJAM tidak dapat mengalihkan kewajibannya yang timbul berdasarkan Akad ini, kepada pihak lain tanpa persetujuan tertulis dari ABATA PEDULI.
      </li>
      <li style="text-align: justify;">
        Akad ini  mengikat  Para  Pihak  yang sah,  para  pengganti  atau pihak-pihak  yang menerima hak dari  masing-masing Para Pihak.
      </li>
      <li style="text-align: justify;">
        Akad ini memuat (jika tidak ditentukan lain di dalam Akad ini), dan karenanya menggantikan semua pengertian dan kesepakatan yang telah dicapai oleh Para Pihak sebelum ditandatanganinya Akad ini, baik tertulis maupun lisan, mengenai hal yang sama.
      </li>
      <li style="text-align: justify;">
        Jika salah satu atau sebagian ketentuan-ketentuan dalam Akad ini menjadi batal atau tidak berlaku, maka tidak mengakibatkan seluruh Akad ini menjadi batal atau tidak berlaku seluruhnya.
      </li>
      <li style="text-align: justify;">
        Para Pihak mengakui bahwa judul pada setiap pasal dalam Akad ini dipakai hanya untuk  memudahkan pembaca Akad ini, karenanya judul tersebut tidak memberikan penafsiran apapun atas isi Akad ini.
      </li>
      <li style="text-align: justify;">
        Apabila ada hal-hal yang belum diatur dalam Akad ini, maka ABATA PEDULI dan PEMINJAM akan mengaturnya bersama secara musyawarah untuk mufakat dalam suatu perjanjian tambahan (Addendum) yang ditandatangani oleh Para Pihak.
      </li>
      <li style="text-align: justify;">
        Segala sesuatu yang belum diatur atau belum cukup diatur pada Akad ini akan dibicarakan oleh Para Pihak untuk mencapai suatu kesepakatan, kesepakatan mana akan dituangkan dalam suatu surat menyurat atau perjanjian tertulis yang dibuat dan ditandatangani oleh dan antara Para Pihak yang merupakan satu kesatuan dan bagian yang tidak terpisahkan dengan Akad ini.
      </li>
    </ol>
  </div>
  <div style="text-align: justify;">
    Demikian Akad ini dibuat dan ditandatangani oleh Para Pihak pada hari, tanggal dan tempat sebagaimana disebutkan pada awal Akad ini .
  </div>
  <div style="width: 100%; height: 100px;"></div>
  <!-- tertanda -->
  <div style="display: flex; justify-content: space-between; margin-bottom: 20px; margin-top: 450px;">
    <div style="display: flex; justify-content: center; width: 50%;">
      <div>
        <div style="margin-bottom: 110px; text-align: center;">ABATA PEDULI,</div>
        <div>[ RIZKY ALFIANI FEBRIANA ]</div>
      </div>
    </div>
    <div style="display: flex; justify-content: center; width: 50%;">
      <div>
        <div style="margin-bottom: 50px; text-align: center;">PEMINJAM,</div>
        <div style="color: grey; margin-bottom: 50px; text-align: center;">Materai 10.000</div>
        <div style="text-align: center;">[{{ $pengajuan->nama }}]</div>
      </div>
    </div>
  </div>
  <div>
    <div style="text-align: center;">Menyetujui,</div>
    <div style="text-align: center; margin-bottom: 100px;">Direksi/Komisaris</div>
    <div style="text-align: center;">[ WAHYU MARDIANTO, S.E ]</div>
  </div>

  <script>
    window.print();
  </script>
</body>
</html>