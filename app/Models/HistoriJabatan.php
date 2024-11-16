<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriJabatan extends Model
{
  use HasFactory;

  public function dataKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'master_karyawan_id', 'id');
  }

  public function dataJabatan() {
    return $this->belongsTo(MasterJabatan::class, 'master_jabatan_id', 'id');
  }
}
