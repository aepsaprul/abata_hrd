<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LabulOmzet extends Model
{
  use HasFactory;

  public function karyawan() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
  }

  public function cabang() {
    return $this->belongsTo(MasterCabang::class, 'cabang_id', 'id');
  }

  public function sales() {
    return $this->belongsTo(MasterKaryawan::class, 'karyawan_sales_id', 'id');
  }

  public function getTanggalAttribute() {
    return Carbon::parse($this->attributes['tanggal'])->translatedFormat('d/m/Y H:i');
  }

  public function detailSales() {
    return $this->hasMany(LabulOmzetSales::class, 'omzet_id', 'id');
  }
}
