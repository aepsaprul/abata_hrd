<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabulActivityPlanDetail extends Model
{
    use HasFactory;

    public function activityPlan() {
        return $this->belongsTo(LabulActivityPlan::class, 'activity_plan_id', 'id');
    }
}
