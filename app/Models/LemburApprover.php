<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LemburApprover extends Model
{
  use HasFactory;

  public function lembur() {
    return $this->belongsTo(Lembur::class, 'lembur_id', 'id');
  }

  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }

  public function dataAtasan() {
    return $this->belongsTo(MasterKaryawan::class, 'atasan_id', 'id');
  }
}
