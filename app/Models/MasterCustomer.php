<?php

namespace App\Models;

use App\Models\MasterCabang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterCustomer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_customer',
        'telepon',
        // 'email',
        // 'alamat',
        // 'nomor_ktp',
        // 'tanggal_lahir',
        // 'segmen',
        // 'member',
        // 'jenis',
        'master_cabang_id'
    ];
    
    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class);
    }
}
