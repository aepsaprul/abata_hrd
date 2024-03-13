<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MasterRole extends Model
{
  use HasFactory, LogsActivity;

  protected static $logAttributes = ['nama', 'hirarki'];

  protected static $logName = 'master_role';

  public function approveCuti() {
    return $this->hasMany(CutiApprover::class, 'role_id', 'id');
  }

  public function approveResign() {
    return $this->hasMany(ResignApprover::class, 'role_id', 'id');
  }

  public function approvePenggajian() {
    return $this->hasMany(PenggajianApprover::class, 'role_id', 'id');
  }

  public function approveAbdul() {
    return $this->hasMany(AbdulApprover::class, 'role_id', 'id');
  }
  
  public function approvePersetujuan() {
    return $this->hasMany(PersetujuanApprover::class, 'role_id', 'id');
  }

  public function dataApprover() {
    return $this->hasMany(Approver::class, 'role_id', 'id');
  }
}
