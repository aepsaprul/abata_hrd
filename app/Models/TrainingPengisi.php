<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPengisi extends Model
{
  use HasFactory;

  public function dataTraining() {
    return $this->belongsTo(Training::class, 'training_id', 'id');
  }

  public function dataKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }
}
