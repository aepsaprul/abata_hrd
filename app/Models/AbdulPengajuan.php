<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbdulPengajuan extends Model
{
  use HasFactory;

  public function karyawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }
  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }
  public function pengajuanApprover() {
    return $this->hasMany(AbdulPengajuanApprover::class, 'pengajuan_id', 'id');
  }
}
