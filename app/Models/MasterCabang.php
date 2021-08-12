<?php

namespace App\Models;

use App\Models\MasterCustomer;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterCabang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_cabang',
        'menu_akses'
    ];

    public function masterKaryawan() {
        return $this->hasMany(MasterKaryawan::class);
    }

    public function masterCustomer() {
        return $this->hasMany(MasterCustomer::class);
    }
}
