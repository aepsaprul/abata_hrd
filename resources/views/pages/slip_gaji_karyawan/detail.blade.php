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
            font-size: 12px;
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
    <div style="float: left; width: 40%; margin-top: 20px;">
        <table style="width: 100%;">
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{ $slip_detail->nip }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $slip_detail->nama }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $slip_detail->karyawan->masterJabatan->nama_jabatan }}</td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td>:</td>
                <td>-</td>
            </tr>
        </table>
    </div>
    <div style="float: right; width: 40%; margin-top: 20px;">
        <table style="width: 100%;">
            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td>{{ tgl_indo($kontrak->mulai_kontrak) }}</td>
            </tr>
            <tr>
                <td>Masa Kerja</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Cabang</td>
                <td>:</td>
                <td>{{ $slip_detail->karyawan->masterCabang->nama_cabang }}</td>
            </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
    <table border="1" style="width: 100%; margin-top: 20px;" cellpadding="0" cellspacing="0">
        <tr>
            <th style="text-align: center; text-transform: uppercase; padding-top: 10px; padding-bottom: 10px; font-size: 12px;">penerimaan</th>
            <th style="text-align: center; text-transform: uppercase; padding-top: 10px; padding-bottom: 10px; font-size: 12px;">potongan</th>
            <th style="text-align: center; text-transform: uppercase; padding-top: 10px; padding-bottom: 10px; font-size: 12px;">kehadiran</th>
        </tr>
        <tr>
            <td style="text-align: center; text-transform: uppercase;">
                <table style="width: 100%;"  border="0">
                    <tr>
                        <td style="text-align: left; font-size: 10px;">gaji pokok :</td>
                        <td>rp</td>
                        <td>1000000</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj jabatan :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj makan :</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj transport :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj komunikasi :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj kost :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">tunj khusus :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">uang lembur :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">bonus cabang :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">bonus project :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">bonus desin :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">bonus kehadiran :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">lain - lain :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="text-align: center; text-transform: uppercase; vertical-align: top;">
                <table style="width: 100%;" border="0">
                    <tr>
                        <td style="text-align: left; font-size: 10px;">hutang karyawan :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">retur produksi :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">premi bpjs kes :</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">premi bpjs tk :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">pot. alpha / ijin :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">pot. abata peduli :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">PPh 21 :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">pot. lain :</td>
                        <td>rp</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="text-align: center; text-transform: uppercase; vertical-align: top;">
                <table style="width: 100%;" border="0">
                    <tr>
                        <td colspan="3"><u>priode</u></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">jml hari kerja :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">jml hari uang makan :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">lembur hari biasa</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">lembur hari libur :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi telat :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi sakit :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi sakit tanpa SKD :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi ijin :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi alpha :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">absensi cuti :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">sisa cuti :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 10px;">poin kehadiran</td>
                        <td>100 poin</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div style="clear: both;"></div>
    <div>
        <p><span>total gaji yang diterima / take home pay (THP) :</span> <span class="float-right">rp 50000000</span></p>
    </div>
</body>
</html>
