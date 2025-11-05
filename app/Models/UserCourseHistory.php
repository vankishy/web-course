<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourseHistory extends Model
{
    use SoftDeletes;
    protected $table = 'user_course_history';
    protected $primaryKey = 'user_course_history_id';
    protected $fillable = [
        'last_seen',
        'user_id',
        'detail_course_id',
    ];
}
