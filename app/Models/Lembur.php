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
}
