<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaderboard extends Model
{
    use SoftDeletes;

    protected $table = 'leaderboard';
    protected $primaryKey = 'leaderboard_id';

    protected $fillable = [
        'urutan',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the user associated with the leaderboard entry
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
