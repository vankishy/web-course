<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaderboard extends Model
{
    use SoftDeletes;

    protected $table = 'leaderboard';
    protected $primaryKey = 'leaderboard_id';
    protected $fillable = [

    ];
}
