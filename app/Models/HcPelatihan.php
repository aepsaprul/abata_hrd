<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcPelatihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'nama',
        'tahun'
    ];
}
