<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabulActivityPlan extends Model
{
    use HasFactory;

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function cabang() {
        return $this->belongsTo(MasterCabang::class, 'cabang_id', 'id');
    }

    public function activityPlanJumlah() {
        return $this->hasMany(LabulActivityPlanJumlah::class, 'activity_plan_id', 'id');
    }

    public function activityPlanRencana() {
        return $this->hasMany(LabulActivityPlanRencana::class, 'activity_plan_id', 'id');
    }
}
