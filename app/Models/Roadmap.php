<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roadmap extends Model
{
    use SoftDeletes;

    protected $table = 'roadmap';
    protected $primaryKey = 'roadmap_id';
    protected $fillable = [
        'name'
    ];
}
