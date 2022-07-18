<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcNavigasiSub extends Model
{
    use HasFactory;

    public function navigasiMain() {
        return $this->belongsTo(HcNavigasiMain::class, 'main_id', 'id');
    }

    public function navigasiButton() {
        return $this->hasMany(HcNavigasiButton::class, 'sub_id', 'id');
    }
}
