<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailCourse extends Model
{
    use SoftDeletes;
    protected $table = 'detail_course';
    protected $primaryKey = 'detail_course_id';
    protected $fillable = [
        'name',
        'type',
        'path',
        'subcourse_id',
    ];

    public function subcourse()
    {
        return $this->belongsTo(SubCourse::class, 'subcourse_id', 'subcourse_id');
    }
}
