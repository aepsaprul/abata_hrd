<?php

namespace App\Models;

use App\Models\MasterJabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcLamaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_jabatan_id',
        'nama_lengkap',
        'telepon',
        'email',
        'status_lamaran'
    ];

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }
}
