<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCourse extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'subcourse';
    protected $primaryKey = 'subcourse_id';
    protected $fillable = [
        'name',
        'image_path',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, "course_id", "course_id");
    }

    public function detailcourse()
    {
        return $this->hasMany(DetailCourse::class, "subcourse_id", "subcourse_id");
    }
}
