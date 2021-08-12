<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcKeluargaSebelumMenikah extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'hubungan',
        'nama',
        'usia',
        'pendidikan_terakhir',
        'pekerjaan_terakhir'
    ];
}
