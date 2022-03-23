<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcPenggajian extends Model
{
    use HasFactory;

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function approvedLeader() {
        return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
    }
}
