<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanPengajuanApprover extends Model
{
  use HasFactory;

  public function pengajuan() {
    return $this->belongsTo(Persetujuan::class, 'pengajuan_id', 'id');
  }
  
  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }
}
