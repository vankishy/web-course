<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WatchLater extends Model
{
    use SoftDeletes;

    protected $table = 'watchlater';
    protected $primaryKey = 'watchlater_id';
    protected $fillable = [

    ];
}
