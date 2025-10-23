<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCourse extends Model
{
    use SoftDeletes;

    protected $table = 'subcourse';
    protected $primaryKey = 'subcourse_id';
    protected $fillable = [

    ];
}
