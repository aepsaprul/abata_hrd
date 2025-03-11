<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'title',
    'parent_id'
  ];

  public function children()
  {
    return $this->hasMany(Struktur::class, 'parent_id');
  }

  public function parent()
  {
    return $this->belongsTo(Struktur::class, 'parent_id');
  }
}
