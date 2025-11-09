<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WatchLater extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'watchlater';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'watchlater_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'detail_course_id',
    ];

    /**
     * Get the user that owns this watch later item.
     */
    public function user()
    {
        // We specify the foreign key 'user_id'
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the detailCourse associated with this watch later item.
     */
    public function detailCourse()
    {
        // We specify the foreign key 'detail_course_id'
        return $this->belongsTo(DetailCourse::class, 'detail_course_id', 'detail_course_id');
    }
}