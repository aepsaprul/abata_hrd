<?php

namespace App\Models;

use App\Models\MasterDivisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'judul',
        'master_divisi_id',
        'tanggal',
        'durasi',
        'peserta',
        'tempat',
        'goal',
        'pengisi',
        'jenis',
        'hasil',
        'status',
        'modul'
    ];

    public function masterDivisi() {
        return $this->belongsTo(MasterDivisi::class);
    }
}
