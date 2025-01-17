<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
  use HasFactory;

  public function dataKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }

  public function dataUser() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
