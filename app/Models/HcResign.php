<?php

namespace App\Models;

use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcResign extends Model
{
    use HasFactory;

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
