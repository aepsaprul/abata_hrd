<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
  use HasFactory;

  public function karyawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }
  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }
  public function pengajuanApprover() {
    return $this->hasMany(PersetujuanPengajuanApprover::class, 'pengajuan_id', 'id');
  }
  public function disposisi() {
    return $this->belongsTo(MasterJabatan::class, 'disposisi_id', 'id');
  }
}
