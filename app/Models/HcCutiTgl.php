<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HcCutiTgl extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'hc_cuti_id',
        'tanggal'
    ];

    protected static $logAttributes = ['hc_cuti_id', 'tanggal'];

    protected static $logName = 'cuti_tanggal';
}
