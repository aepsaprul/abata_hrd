<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HcNavMain extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['title', 'link', 'icon', 'aktif'];

    protected static $logName = 'nav_main';

    public function navSub() {
        return $this->hasMany(HcNavSub::class, 'nav_main_id', 'id');
    }

    public function navAccess() {
        return $this->hasMany(HcNavAccess::class, 'main_id', 'id');
    }
}
