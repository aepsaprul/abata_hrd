<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;

    public function approve() {
        return $this->hasMany(CutiApprover::class, 'role_id', 'id');
    }
}
