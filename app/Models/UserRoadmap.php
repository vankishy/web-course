<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserRoadmap extends Model
{
    use SoftDeletes;
    protected $table = 'user_roadmap';
    protected $primaryKey = 'user_roadmap_id';
    protected $fillable = [

    ];
}
