<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcNavigasiMain extends Model
{
    use HasFactory;

    public function navigasiSub() {
        return $this->hasMany(HcNavigasiSub::class, 'main_id', 'id');
    }

    public function navigasiButton() {
        return $this->hasMany(HcNavigasiButton::class, 'main_id', 'id');
    }
}
