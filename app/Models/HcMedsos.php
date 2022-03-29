<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcMedsos extends Model
{
    use HasFactory;

    protected static $logAttributes = [
        'karyawan_id',
        'nama_media_sosial',
        'nama_akun'
    ];

    protected static $logName = 'karyawan_medsos';
}
