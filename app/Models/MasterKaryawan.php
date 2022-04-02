<?php

namespace App\Models;

use App\Models\User;
use App\Models\HcCuti;
use App\Models\SitumpurCs;
use App\Models\KaryawanMenu;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\SitumpurDesain;
use Illuminate\Database\Eloquent\Model;
use App\Models\SitumpurAntrianDesainNomor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class MasterKaryawan extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'nama_panggilan',
        'telepon',
        'email',
        'nomor_ktp',
        'jenis_sim',
        'nomor_sim',
        'status_ktp',
        'foto',
        'master_cabang_id',
        'master_jabatan_id',
        'master_divisi_id',
        'agama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_asal',
        'alamat_domisili',
        'status_perkawinan',
        'tanggal_masuk',
        'tanggal_keluar',
        'alasan',
        'tanggal_pengambilan_ijazah',
        'status',
        'role'
    ];

    protected static $logAttributes = [
        'nik',
        'nama_lengkap',
        'nama_panggilan',
        'telepon',
        'email',
        'nomor_ktp',
        'jenis_sim',
        'nomor_sim',
        'status_ktp',
        'foto',
        'master_cabang_id',
        'master_jabatan_id',
        'master_divisi_id',
        'agama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_asal',
        'alamat_domisili',
        'status_perkawinan',
        'tanggal_masuk',
        'tanggal_keluar',
        'alasan',
        'tanggal_pengambilan_ijazah',
        'status',
        'role'
    ];

    protected static $logName = 'master_karyawan';

    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class, 'master_cabang_id', 'id');
    }

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class, 'master_jabatan_id', 'id');
    }

    public function masterDivisi() {
        return $this->belongsTo(MasterDivisi::class, 'master_divisi_id', 'id');
    }

    public function user() {
        return $this->hasOne(User::class, 'master_karyawan_id', 'id');
    }

    public function cuti() {
        return $this->hasMany(HcCuti::class, 'master_karyawan_id', 'id');
    }

    public function navAccess() {
        return $this->hasMany(HcNavAccess::class, 'user_id', 'id');
    }

    public function kontrak() {
        return $this->hasMany(HcKontrak::class, 'karyawan_id', 'id');
    }
}
