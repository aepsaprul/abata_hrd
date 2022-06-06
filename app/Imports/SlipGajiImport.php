<?php

namespace App\Imports;

use App\Models\HcSlipGaji;
use App\Models\HcSlipGajiDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class SlipGajiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $slip = HcSlipGaji::orderBy('id', 'desc')->first();

        HcSlipGajiDetail::create([
            'nip' => $row['nip'],
            'slip_gaji_id' => $slip->id,
            'karyawan_id' => $row['id'],
            'nama' => $row['nama'],
            'gaji_pokok' => $row['gaji_pokok'],
            'tunj_jabatan' => $row['tunj_jabatan'],
            'tunj_makan' => $row['tunj_makan'],
            'tunj_transport' => $row['tunj_transport'],
            'tunj_komunikasi' => $row['tunj_komunikasi'],
            'tunj_kost' => $row['tunj_kost'],
            'tunj_khusus' => $row['tunj_khusus'],
            'uang_lembur' => $row['uang_lembur'],
            'bonus_cabang' => $row['bonus_cabang'],
            'bonus_project' => $row['bonus_project'],
            'bonus_desain' => $row['bonus_desain'],
            'bonus_kehadiran' => $row['bonus_kehadiran'],
            'lain_lain' => $row['lain_lain'],
            'hutang_karyawan' => $row['hutang_karyawan'],
            'retur_produksi' => $row['retur_produksi'],
            'premi_bpjs_kes' => $row['premi_bpjs_kesehatan'],
            'premi_bpjs_tk' => $row['premi_bpjs_tk'],
            'pot_alpha_ijin' => $row['pot_alpha_ijin'],
            'pot_abata_peduli' => $row['pot_abata_peduli'],
            'pph21' => $row['pph21'],
            'pot_lain' => $row['pot_lain'],
            'jml_hari_kerja' => $row['jml_hari_kerja'],
            'jml_hari_uang_makan' => $row['jml_hari_uang_makan'],
            'lembur_hari_biasa' => $row['lembur_hari_biasa'],
            'lembur_hari_libur' => $row['lembur_hari_libur'],
            'absensi_telat' => $row['absensi_telat'],
            'absensi_sakit' => $row['absensi_sakit'],
            'absensi_tanpa_skd' => $row['absensi_tanpa_skd'],
            'absensi_ijin' => $row['absensi_ijin'],
            'absensi_alpha' => $row['absensi_alpha'],
            'absensi_cuti' => $row['absensi_cuti'],
            'sisa_cuti' => $row['sisa_cuti'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
