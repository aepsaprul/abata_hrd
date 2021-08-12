<?php

namespace App\Models;

use App\Models\MasterMenu;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaryawanMenu extends Model
{
    use HasFactory;

    public function masterMenu() {
        return $this->belongsTo(MasterMenu::class);
    }

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }
}
