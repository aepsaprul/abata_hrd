<?php

namespace App\Models;

use App\Models\HcResignSurveiCeklis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HcResignSurveiNamaCeklis extends Model
{
    use HasFactory;

    public function surveiCeklis() {
        return $this->hasMany(HcResignSurveiCeklis::class);
    }
}
