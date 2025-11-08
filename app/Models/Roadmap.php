<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roadmap extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roadmap';
    protected $primaryKey = 'roadmap_id';
    protected $fillable = ['name'];

    // 🔹 Relasi ke UserRoadmap (banyak user bisa ikut 1 roadmap)
    public function userRoadmaps()
    {
        return $this->hasMany(UserRoadmap::class, 'roadmap_id', 'roadmap_id');
    }

    public function courses()
    {
        // Mendefinisikan relasi Many-to-Many ke Course melalui tabel 'roadmap_course'
        return $this->belongsToMany(
            Course::class, 
            'roadmap_course', 
            'roadmap_id',  // FK Model saat ini di tabel pivot
            'course_id',   // FK Model yang dihubungkan di tabel pivot
        );
    }

}
