<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteProject extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'favourite_project';
}
