<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignDetail extends Model
{
    use HasFactory;

    public function resign() {
        return $this->belongsTo(HcResign::class, 'resign_id', 'id');
    }
}
