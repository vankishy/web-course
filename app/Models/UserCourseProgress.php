<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourseProgress extends Model
{
    use SoftDeletes;

    protected $table = 'user_course_progress';
    protected $primaryKey = 'user_course_progress_id';
    protected $fillable = [
        'user_id',
        'detail_course_id',
        'done'
    ];

    public function subcourse()
    {
        return $this->belongsTo(DetailCourse::class, "detail_course_id", "detail_course_id");
    }
}
