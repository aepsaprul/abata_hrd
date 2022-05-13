<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LokerData extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "loker_datas";

    protected static $logAttributes = ['jabatan.nama_jabatan'];

    protected static $logName = 'loker';

    public function cabang() {
        return $this->belongsTo(MasterCabang::class, 'cabang_id', 'id');
    }

    public function jabatan() {
        return $this->belongsTo(MasterJabatan::class, 'jabatan_id', 'id');
    }
}
