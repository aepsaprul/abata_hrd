<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokerLamaran extends Model
{
    use HasFactory;

    public function biodata() {
        return $this->belongsTo(LokerBiodata::class, 'email', 'email');
    }

    public function lokerData() {
        return $this->belongsTo(LokerData::class, 'loker_data_id', 'id');
    }
}
