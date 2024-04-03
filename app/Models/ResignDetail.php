<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ResignDetail extends Model
{
  use HasFactory, LogsActivity;

  protected static $logAttributes = [
    'resign_id',
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

  protected static $logName = 'resign_detail';

  public function resign() {
    return $this->belongsTo(HcResign::class, 'resign_id', 'id');
  }

  public function approvedLeader() {
    return $this->belongsTo(MasterKaryawan::class, 'approved_leader', 'id');
  }

  public function dataAtasan() {
    return $this->belongsTo(MasterKaryawan::class, 'atasan_id', 'id');
  }
}
