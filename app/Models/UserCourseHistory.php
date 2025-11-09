<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserCourseHistory extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'user_course_history';
    protected $primaryKey = 'user_course_history_id';
    protected $fillable = [
        'last_seen',
        'user_id',
        'detail_course_id',
    ];
}
