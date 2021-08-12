<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcKerabatDarurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'hubungan',
        'nama',
        'jenis_kelamin',
        'telepon',
        'alamat'
    ];
}
