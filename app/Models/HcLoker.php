<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class HcLoker extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ['masterJabatan.nama_jabatan'];

    protected static $logName = 'loker';

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class, 'master_jabatan_id', 'id');
    }
}
