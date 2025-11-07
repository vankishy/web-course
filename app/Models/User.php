<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Pastikan Anda meng-import model-model ini untuk relasi
use App\Models\Roadmap;
use App\Models\UserRoadmap;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Memberi tahu Laravel nama tabel & primary key kustom Anda.
     * Ini adalah perbaikan untuk masalah login Anda.
     */
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        // Kode return $this->hasMany(...) yang salah telah dihapus dari sini.
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the leaderboard
     */
    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'user_id', 'user_id');
    }

    /**
     * INI ADALAH FUNGSI BARU UNTUK RELASI
     * Berisi kode yang sebelumnya salah tempat di dalam fungsi casts().
     */
    public function userRoadmaps()
    {
        return $this->hasMany(UserRoadmap::class, 'user_id', 'user_id');
    }

    /**
     * Ini adalah relasi roadmaps Anda yang sudah ada (sudah benar).
     */
    public function roadmaps()
    {
        return $this->belongsToMany(
            Roadmap::class,
            'user_roadmap',
            'user_id',
            'roadmap_id'
        );
    }
}
