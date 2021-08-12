<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcKeluargaSetelahMenikah extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'hubungan',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan_terkahir'
    ];
}
