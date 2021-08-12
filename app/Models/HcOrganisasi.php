<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'nama',
        'jabatan',
        'masa_kerja'
    ];
}
