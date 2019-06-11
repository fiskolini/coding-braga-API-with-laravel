<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 */
class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'starts_at', 'ends_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * @var array Timestamps
     */
    protected $dates = ['starts_at', 'ends_at', 'created_at', 'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
