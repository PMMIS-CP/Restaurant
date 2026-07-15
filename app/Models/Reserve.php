<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'event_type',
        'guest_count',
        'reservation_date',
        'entry_time',
        'exit_time',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}