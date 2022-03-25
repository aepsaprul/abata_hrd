<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HcNavAccess extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['user_id'];

    protected static $logName = 'nav_access';

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class, 'user_id', 'id');
    }

    public function navMain() {
        return $this->belongsTo(HcNavMain::class, 'main_id', 'id');
    }

    public function navSub() {
        return $this->belongsTo(HcNavSub::class, 'sub_id', 'id');
    }
}
