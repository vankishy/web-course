<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roadmap extends Model
{
    use SoftDeletes;

    protected $table = 'roadmap';
    protected $primaryKey = 'roadmap_id';
    protected $fillable = ['name'];

    // 🔹 Relasi ke UserRoadmap (banyak user bisa ikut 1 roadmap)
    public function userRoadmaps()
    {
        return $this->hasMany(UserRoadmap::class, 'roadmap_id', 'roadmap_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

}
