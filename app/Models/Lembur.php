<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
  use HasFactory;

  public function dataDetail() {
    return $this->hasMany(LemburDetail::class, 'lembur_id', 'id');
  }

  public function dataUser() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function dataKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }
  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }
  public function dataApprover() {
    return $this->hasMany(LemburApprover::class, 'lembur_id', 'id');
  }
}
