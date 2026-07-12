<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
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
}