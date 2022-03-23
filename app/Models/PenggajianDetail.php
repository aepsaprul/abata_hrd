<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggajianDetail extends Model
{
    use HasFactory;

    public function penggajian() {
        return $this->belongsTo(HcPenggajian::class, 'penggajian_id', 'id');
    }
}
