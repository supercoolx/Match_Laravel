<?php

namespace App\Models\profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileContract extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'profile_contract';
}
