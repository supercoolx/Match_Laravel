<?php

namespace App\Models\profile;

use App\Models\Week;
use App\Models\ContractType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function weeks() {
        return $this->belongsTo(Week::class, 'week', 'id');
    }

    public function contractType() {
        return $this->belongsTo(ContractType::class, 'contract', 'id');
    }
}
