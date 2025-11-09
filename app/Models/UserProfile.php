<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'user_profile';
    protected $primaryKey = 'user_profile_id';
    protected $fillable = [

    ];
}
