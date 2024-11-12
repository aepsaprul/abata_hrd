<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
  use HasFactory;

  public function trainings()
  {
    return $this->belongsToMany(Training::class, 'training_moduls');
  }
}
