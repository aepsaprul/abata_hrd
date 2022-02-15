<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcNavSub extends Model
{
    use HasFactory;

    public function navMain() {
        return $this->belongsTo(HcNavMain::class, 'main_id', 'id');
    }
}
