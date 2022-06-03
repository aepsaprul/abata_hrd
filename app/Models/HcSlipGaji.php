<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcSlipGaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'bulan',
        'tahun',
        'periode',
        'gaji_pokok'
    ];
}
