<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbdulApprover extends Model
{
  use HasFactory;

  public function role() {
    return $this->belongsTo(MasterRole::class, 'role_id', 'id');
  }
}
