<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'habit_id',
        'time',
        'days_of_week',
    ];

    protected $casts = [
        'time' => 'datetime:H:i',
        'days_of_week' => 'array',
    ];

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }
}