<?php

namespace App\Models\profile;

use App\Models\JobType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileJob extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function type() {
        return $this->belongsTo(JobType::class, 'job_id', 'id');
    }
}
