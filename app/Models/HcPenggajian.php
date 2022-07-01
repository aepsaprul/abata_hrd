<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HcPenggajian extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = [
        'karyawan_id',
        'judul',
        'tanggal_upload',
        'status',
        'alasan',
        'file',
        'approved_date',
        'approved_leader',
        'approved_text',
        'approved_percentage',
        'approved_background'
    ];

    protected static $logName = 'penggajian';

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function approvedLeader() {
        return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
    }

    public function penggajianDetail() {
        return $this->hasMany(PenggajianDetail::class, 'penggajian_id', 'id');
    }
}
