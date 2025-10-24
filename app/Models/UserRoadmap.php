<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoadmap extends Model
{
    use SoftDeletes;

    protected $table = 'user_roadmap';
    protected $primaryKey = 'user_roadmap_id';
    protected $fillable = [];

    // 🔹 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // 🔹 Relasi ke Roadmap
    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class, 'roadmap_id', 'roadmap_id');
    }
}
