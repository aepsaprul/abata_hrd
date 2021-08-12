<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AntrianPengunjung extends Model
{
    use HasFactory;

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }

    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class);
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['tanggal'])
        ->translatedFormat('Y/m/d');
    }
}
