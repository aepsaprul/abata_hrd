<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcKontrak extends Model
{
    use HasFactory;

    protected static $logAttributes = [
        'karyawan_id',
        'mulai_kontrak',
        'akhir_kontrak',
        'lama_kontrak'
    ];

    protected static $logName = 'karyawan_kontrak';
}
