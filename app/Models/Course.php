<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'course';
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'name',
        'desc',
        'image_path',
    ];

    public function subcourse()
    {
        return $this->hasMany(SubCourse::class, "course_id", "course_id");
    }

    public function roadmaps()
    {
        // Mendefinisikan relasi Many-to-Many ke Roadmap melalui tabel 'roadmap_course'
        return $this->belongsToMany(
            Roadmap::class, 
            'roadmap_course', 
            'course_id', 
            'roadmap_id',
        );
    }
}
