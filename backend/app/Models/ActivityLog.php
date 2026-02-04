<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'habit_id',
        'date',
        'status',
        'done_at',
        'source',
    ];

    protected $casts = [
        'date' => 'date',
        'done_at' => 'datetime',
    ];
}
