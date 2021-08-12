<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcRiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'nama_perusahaan',
        'jenis_industri',
        'jabatan_awal',
        'jabatan_akhir',
        'awal_bekerja',
        'akhir_bekerja',
        'gaji_awal',
        'gaji_akhir',
        'nama_atasan',
        'alasan_berhenti'
    ];
}
