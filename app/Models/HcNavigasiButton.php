<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcNavigasiButton extends Model
{
    use HasFactory;

    public function navigasiSub() {
        return $this->belongsTo(HcNavigasiSub::class, 'sub_id', 'id');
    }

    public function navigasiAccess() {
        return $this->hasMany(HcNavigasiAccess::class, 'button_id', 'id');
    }

    public function navigasiMain() {
        return $this->belongsTo(HcNavigasiMain::class, 'main_id', 'id');
    }
}
