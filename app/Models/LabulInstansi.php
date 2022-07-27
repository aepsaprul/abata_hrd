<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabulInstansi extends Model
{
    use HasFactory;

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function cabang() {
        return $this->belongsTo(MasterCabang::class, 'cabang_id', 'id');
    }
}
