<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ResignApprover extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['role_id', 'hirarki', 'atasan_id'];

    protected static $logName = 'resign_approver';

    public function role() {
        return $this->belongsTo(MasterRole::class, 'role_id', 'id');
    }
}
