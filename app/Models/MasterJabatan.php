<?php

namespace App\Models;

use App\Models\JabatanMenu;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterJabatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_cabang',
        'menu_akses'
    ];

    public function masterKaryawan()
    {
        return $this->belongsTo(MasterKaryawan::class);
    }

    public function jabatanMenu()
    {
        return $this->hasMany(JabatanMenu::class);
    }
}
