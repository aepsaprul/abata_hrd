<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
  use HasFactory;

  public function dataPeserta() {
    return $this->hasMany(TrainingPeserta::class, 'training_id', 'id');
  }

  public function dataPengisi() {
    return $this->hasMany(TrainingPengisi::class, 'training_id', 'id');
  }

  public function dataModul() {
    return $this->hasMany(TrainingModul::class, 'training_id', 'id');
  }

  public function karyawan()
  {
      return $this->belongsToMany(MasterKaryawan::class, 'training_pesertas');
  }

  public function moduls()
  {
      return $this->belongsToMany(Modul::class, 'training_moduls');
  }
}
