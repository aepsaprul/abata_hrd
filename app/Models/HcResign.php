<?php

namespace App\Models;

use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class HcResign extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = [
        'master_karyawan_id',
        'lokasi_kerja',
        'tanggal_masuk',
        'tanggal_keluar',
        'alamat',
        'telepon',
        'approved_date',
        'approved_leader',
        'approved_text',
        'approved_percentage',
        'approved_background'
    ];

    protected static $logName = 'resign';

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class, 'master_karyawan_id', 'id');
    }

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }

    public function approvedLeader() {
        return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
    }
}
