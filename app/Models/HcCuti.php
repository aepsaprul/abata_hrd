<?php

namespace App\Models;

use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcCuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_karyawan_id',
        'master_jabatan_id',
        'atasan',
        'telepon',
        'alamat',
        'jenis',
        // 'tanggal_mulai',
        // 'tanggal_berakhir',
        'karyawan_pengganti',
        'alasan',
        'tanggal_kerja'
    ];

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }

    public function atasanLangsung() {
        return $this->belongsTo(MasterKaryawan::class, 'atasan', 'id');
    }

    public function karyawanPengganti() {
        return $this->belongsTo(MasterKaryawan::class, "karyawanPengganti", "id", "karyawan_pengganti");
    }

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }
}
