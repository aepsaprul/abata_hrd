<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CutiDetail extends Model
{
  use HasFactory, LogsActivity;

  protected static $logAttributes = [
    'cuti_id',
    'hirarki',
    'atasan',
    'status',
    'confirm',
    'approved_date',
    'approved_leader',
    'approved_text',
    'approved_percentage',
    'approved_background'
  ];

  protected static $logName = 'cuti_detail';

  public function cuti() {
    return $this->belongsTo(HcCuti::class, 'cuti_id', 'id');
  }

  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }

  public function dataAtasan() {
    return $this->belongsTo(MasterKaryawan::class, 'atasan_id', 'id');
  }
}
