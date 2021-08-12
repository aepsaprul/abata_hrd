<?php

namespace App\Models;

use App\Models\MasterMenu;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanMenu extends Model
{
    use HasFactory;

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }

    public function masterMenu() {
        return $this->belongsTo(MasterMenu::class);
    }

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }
}
