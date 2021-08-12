<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'tingkat',
        'nama',
        'kota',
        'jurusan',
        'tahun_masuk',
        'tahun_lulus'
    ];
}
