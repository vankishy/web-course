<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WatchLater extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'watchlater';
    protected $primaryKey = 'watchlater_id';
    protected $fillable = [

    ];
}
