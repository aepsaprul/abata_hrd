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
    @if ($slip_detail)

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
                    <td>No Rekening</td>
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
                    <td>
                        @if ($kontrak)
                            {{ $kontrak->mulai_kontrak }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Masa Kerja</td>
                    <td>:</td>
                    <td>{{ $lama_kontrak }}</td>
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
                    <table style="width: 100%; padding-left: 10px; padding-right: 10px;"  border="0">
                        <tr>
                            <td style="text-align: left; font-size: 10px;">gaji pokok :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->gaji_pokok) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj jabatan :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_jabatan) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj makan :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_makan) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj transport :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_transport) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj komunikasi :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_komunikasi) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj kost :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_kost) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">tunj khusus :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->tunj_khusus) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">uang lembur :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->uang_lembur) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">bonus cabang :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->bonus_cabang) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">bonus project :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->bonus_project) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">bonus desin :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->bonus_desain) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">bonus kehadiran :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->bonus_kehadiran) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">lain - lain :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->lain_lain) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: center; text-transform: uppercase; vertical-align: top;">
                    <table style="width: 100%; padding-left: 10px; padding-right: 10px;" border="0">
                        <tr>
                            <td style="text-align: left; font-size: 10px;">hutang karyawan :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->hutang_karyawan) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">retur produksi :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->retur_produksi) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">premi bpjs kes :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->premi_bpjs_kes) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">premi bpjs tk :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->premi_bpjs_tk) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">pot. alpha / ijin :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->pot_alpha_ijin) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">pot. sakit :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->pot_sakit) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">pot. abata peduli :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->pot_abata_peduli) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">PPh 21 :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->pph21) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">pot. lain :</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">{{ rupiah($slip_detail->pot_lain) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: center; text-transform: uppercase; vertical-align: top;">
                    <table style="width: 100%; padding-left: 10px; padding-right: 10px;" border="0">
                        <tr>
                            <td colspan="2" style="text-transform: capitalize; text-align: center;"><u>periode {{ $slip->periode }}</u></td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">jml hari kerja :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->jml_hari_kerja }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">jml hari uang makan :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->jml_hari_uang_makan }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">lembur hari biasa</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->lembur_hari_biasa }} jam</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">lembur hari libur :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->lembur_hari_libur }} jam</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi telat :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_telat }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi sakit :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_sakit }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi sakit tanpa SKD :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_tanpa_skd }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi ijin :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_ijin }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi alpha :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_alpha }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">absensi cuti :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->absensi_cuti }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px;">sisa cuti :</td>
                            <td style="text-align: right; text-transform: capitalize;">{{ $slip_detail->sisa_cuti }} hari</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; font-size: 10px; font-weight: bold;">poin kehadiran</td>
                            <td style="text-align: right; text-transform: capitalize; font-weight: bold;">{{ $slip_detail->poin_kehadiran }} poin</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; font-weight: bold; padding-left: 10px; padding-right: 10px;" border="0">
                        <tr>
                            <td style="text-align: left; text-transform: capitalize;">total penerimaan</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">
                                @php
                                    $total_penerimaan =     $slip_detail->gaji_pokok +
                                                            $slip_detail->tunj_jabatan +
                                                            $slip_detail->tunj_makan +
                                                            $slip_detail->tunj_transport +
                                                            $slip_detail->tunj_komunikasi +
                                                            $slip_detail->tunj_kost +
                                                            $slip_detail->tunj_khusus +
                                                            $slip_detail->uang_lembur +
                                                            $slip_detail->bonus_cabang +
                                                            $slip_detail->bonus_project +
                                                            $slip_detail->bonus_desain +
                                                            $slip_detail->bonus_kehadiran +
                                                            $slip_detail->lain_lain;
                                @endphp
                                {{ rupiah($total_penerimaan) }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table style="width: 100%; font-weight: bold; padding-left: 10px; padding-right: 10px;" border="0">
                        <tr>
                            <td style="text-align: left; text-transform: capitalize;">total potongan</td>
                            <td style="text-transform: capitalize;">rp</td>
                            <td style="text-align: right;">
                                @php
                                    $total_potongan =   $slip_detail->hutang_karyawan +
                                                        $slip_detail->retur_produksi +
                                                        $slip_detail->premi_bpjs_kes +
                                                        $slip_detail->premi_bpjs_tk +
                                                        $slip_detail->pot_alpha_ijin +
                                                        $slip_detail->pot_abata_peduli +
                                                        $slip_detail->pph21 +
                                                        $slip_detail->pot_lain;
                                @endphp
                                {{ rupiah($total_potongan) }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table style="width: 100%; font-weight: bold; padding-left: 10px; padding-right: 10px; text-transform: capitalize; background-color: lightgreen; color: #292929;" border="0">
                        <tr>
                            <td style="text-align: left;">penilaian</td>
                            <td style="text-align: right;">
                                @php
                                    $poin = $slip_detail->poin_kehadiran;
                                    if ($poin > 0 && $poin <= 30) {
                                        $penilaian = "pemalas";
                                    } elseif ($poin > 30 && $poin <= 60) {
                                        $penilaian = "perlu pembinaan";
                                    } elseif ($poin > 60 && $poin <= 79) {
                                        $penilaian = "cukup rajin";
                                    } elseif ($poin > 79 && $poin <= 90) {
                                        $penilaian = "rajin";
                                    } else {
                                        $penilaian = "sangat rajin";
                                    }
                                @endphp
                                {{ $penilaian }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="clear: both;"></div>
        <div>
            <p style="margin-top: 30px;"><span style="text-transform: capitalize; font-size: 13px;">total gaji yang diterima / take home pay (THP) : </span> <span style="font-weight: bold; font-size: 13px; text-transform: capitalize;">rp {{ rupiah($total_penerimaan - $total_potongan) }}</span></p>
        </div>
        <div style="clear: both;"></div>
        <table border="1" style="width: 100%; margin-top: 20px;" cellpadding="0" cellspacing="0">
            <tr>
                <th style="padding: 5px;">BPJS Kesehatan</th>
                <th style="padding: 5px;">BPJS TK JHT</th>
                <th style="padding: 5px;">BPJS TK JKM</th>
                <th style="padding: 5px;">BPJS TK JKK</th>
                <th style="padding: 5px;">Total Subsidi</th>
            </tr>
            <tr>
                <td style="padding: 5px;"><span>Rp</span><span style="float: right;">{{ $slip_detail->bpjs_kesehatan }}</span></td>
                <td style="padding: 5px;"><span>Rp</span><span style="float: right;">{{ $slip_detail->bpjs_tk_jht }}</span></td>
                <td style="padding: 5px;"><span>Rp</span><span style="float: right;">{{ $slip_detail->bpjs_tk_jkm }}</td>
                <td style="padding: 5px;"><span>Rp</span><span style="float: right;">{{ $slip_detail->bpjs_tk_jkk }}</td>
                <td style="padding: 5px;"><span>Rp</span><span style="float: right;">{{ $slip_detail->bpjs_kesehatan + $slip_detail->bpjs_tk_jht + $slip_detail->bpjs_tk_jkm + $slip_detail->bpjs_tk_jkk }}</span></td>
            </tr>
        </table>
        <div style="clear: both;"></div>
        <div style="margin-top: 20px;">
            <p style="padding: 0; margin: 0;"><span style="text-transform: capitalize; font-size: 10px; color: red; font-style: italic;">*Barang siapa dengan sengaja membocorkan isi slip gaji ini akan dikenakan sanksi sesuai Perarturan Perusahaan</p>
        </div>
    @else
        <p style="text-align: center;">- Rincian Slip Gaji Masih Proses -</p>
    @endif
</body>
</html>
