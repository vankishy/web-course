<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCourseProgress extends Model
{
    use SoftDeletes,HasFactory;

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
