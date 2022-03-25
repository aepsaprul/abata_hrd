<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HcNavSub extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['title', 'link', 'navMain.title', 'aktif'];

    protected static $logName = 'nav_sub';

    public function navMain() {
        return $this->belongsTo(HcNavMain::class, 'main_id', 'id');
    }
}
