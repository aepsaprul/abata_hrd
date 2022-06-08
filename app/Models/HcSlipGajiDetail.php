<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcSlipGajiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'slip_gaji_id',
        'karyawan_id',
        'nip',
        'nama',
        'gaji_pokok',
        'tunj_jabatan',
        'tunj_makan',
        'tunj_transport',
        'tunj_komunikasi',
        'tunj_kost',
        'tunj_khusus',
        'uang_lembur',
        'bonus_cabang',
        'bonus_project',
        'bonus_desain',
        'bonus_kehadiran',
        'lain_lain',
        'hutang_karyawan',
        'retur_produksi',
        'premi_bpjs_kes',
        'premi_bpjs_tk',
        'pot_alpha_ijin',
        'pot_abata_peduli',
        'pph21',
        'pot_lain',
        'jml_hari_kerja',
        'jml_hari_uang_makan',
        'lembur_hari_biasa',
        'lembur_hari_libur',
        'absensi_telat',
        'absensi_sakit',
        'absensi_tanpa_skd',
        'absensi_ijin',
        'absensi_alpha',
        'absensi_cuti',
        'sisa_cuti',
        'poin_kehadiran'
    ];

    public function slipGaji() {
        return $this->belongsTo(HcSlipGaji::class, 'slip_gaji_id', 'id');
    }

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }
}
