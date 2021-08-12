<?php

namespace App\Models;

use App\Models\JabatanMenu;
use App\Models\KaryawanMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterMenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_menu',
        'level_menu',
        'root_menu',
        'link'
    ];

    public function jabatanMenu() {
        return $this->hasMany(JabatanMenu::class);
    }
    
    public function karyawanMenu() {
        return $this->hasMany(KaryawanMenu::class);
    }
}
