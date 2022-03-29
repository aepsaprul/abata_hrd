<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MasterDivisi extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['nama'];

    protected static $logName = 'master_divisi';
}
