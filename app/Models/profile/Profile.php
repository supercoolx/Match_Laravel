<?php

namespace App\Models\profile;

use App\Models\Address;
use App\Models\Week;
use App\Models\ContractType;
use App\Models\Dress;
use App\Models\JobType;
use App\Models\profile\ProfileEducation;
use App\Models\profile\ProfileEmployee;
use App\Models\profile\ProfileExperience;
use App\Models\profile\ProfileJob;
use App\Models\profile\ProfilePortfolio;
use App\Models\profile\ProfileQualification;
use App\Models\profile\ProfileWriting;
use App\Models\RemoteWork;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function weeks() {
        return $this->belongsTo(Week::class, 'week', 'id');
    }

    public function dress() {
        return $this->belongsTo(Dress::class, 'dress_id', 'id');
    }

    public function location() {
        return $this->belongsTo(Address::class, 'work_location_id', 'id');
    }

    public function remote_work() {
        return $this->belongsTo(RemoteWork::class, 'remote_work_id', 'id');
    }

    public function skills() {
        return $this->hasMany(ProfileSkill::class, 'user_id', 'user_id');
    }

    public function educations() {
        return $this->hasMany(ProfileEducation::class, 'user_id', 'user_id');
    }

    public function employees() {
        return $this->hasMany(ProfileEmployee::class, 'user_id', 'user_id');
    }

    public function experiences() {
        return $this->hasMany(ProfileExperience::class, 'user_id', 'user_id');
    }

    public function jobs() {
        return $this->belongsToMany(JobType::class, 'profile_job', 'user_id', 'job_id', 'user_id', 'id');
    }

    public function contractTypes() {
        return $this->belongsToMany(ContractType::class, 'profile_contract', 'user_id', 'contract_id', 'user_id', 'id');
    }

    public function portfolios() {
        return $this->hasMany(ProfilePortfolio::class, 'user_id', 'user_id');
    }

    public function qualifications() {
        return $this->hasMany(ProfileQualification::class, 'user_id', 'user_id');
    }

    public function writings() {
        return $this->hasMany(ProfileWriting::class, 'user_id', 'user_id');
    }
}
