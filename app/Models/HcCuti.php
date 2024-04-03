<?php

namespace App\Models;

use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class HcCuti extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'master_karyawan_id',
    'master_jabatan_id',
    'atasan',
    'telepon',
    'alamat',
    'jenis',
    'karyawan_pengganti',
    'alasan',
    'tanggal_kerja'
  ];

  protected static $logAttributes = [
    'master_karyawan_id',
    'jenis',
    'jml_hari',
    'alasan',
    'approved_date',
    'approved_leader',
    'approved_text',
    'approved_percentage',
    'approved_background'
  ];

  protected static $logName = 'cuti';

  public function masterKaryawan() {
    return $this->belongsTo(MasterKaryawan::class, 'master_karyawan_id', 'id');
  }

  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }

  public function karyawanPengganti() {
    return $this->belongsTo(MasterKaryawan::class, "karyawan_pengganti", "id");
  }

  public function masterJabatan() {
    return $this->belongsTo(MasterJabatan::class);
  }

  public function cutiDetail() {
    return $this->hasMany(CutiDetail::class, 'cuti_id', 'id');
  }

  public function cutiTgl() {
    return $this->hasMany(HcCutiTgl::class, 'hc_cuti_id', 'id');
  }
}
