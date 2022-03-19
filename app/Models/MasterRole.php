<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;

    public function approveCuti() {
        return $this->hasMany(CutiApprover::class, 'role_id', 'id');
    }

    public function approveResign() {
        return $this->hasMany(ResignApprover::class, 'role_id', 'id');
    }
}
