<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcPertanyaanTambahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'master_pertanyaan_tambahan_id',
        'jawaban',
        'uraian'
    ];
}
