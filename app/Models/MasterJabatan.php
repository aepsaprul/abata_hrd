<?php

namespace App\Models;

use App\Models\JabatanMenu;
use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class MasterJabatan extends Model
{
    use HasFactory, LogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'nama_jabatan'
    ];

    protected static $logAttributes = ['nama_jabatan'];

    protected static $logName = 'master_jabatan';

    public function masterKaryawan()
    {
        return $this->belongsTo(MasterKaryawan::class);
    }

    public function jabatanMenu()
    {
        return $this->hasMany(JabatanMenu::class);
    }

    public function loker() {
        return $this->hasMany(HcLoker::class, 'master_jabatan_id', 'id');
    }
}
