<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcNavMain extends Model
{
    use HasFactory;

    public function navSub() {
        return $this->hasMany(HcNavSub::class, 'nav_main_id', 'id');
    }

    public function navAccess() {
        return $this->hasMany(HcNavAccess::class, 'main_id', 'id');
    }
}
