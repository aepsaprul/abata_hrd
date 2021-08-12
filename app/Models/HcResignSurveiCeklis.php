<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HcResignSurveiNamaCeklis;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcResignSurveiCeklis extends Model
{
    use HasFactory;

    public function resignSurveiCeklis() {
        return $this->belongsTo(HcResignSurveiNamaCeklis::class);
    }
}
