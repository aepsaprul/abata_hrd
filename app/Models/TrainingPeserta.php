<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPeserta extends Model
{
  use HasFactory;

  public function dataTraining() {
    return $this->belongsTo(Training::class, 'training_id', 'id');
  }

  public function dataKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'master_karyawan_id', 'id');
  }
}
