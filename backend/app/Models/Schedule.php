<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'habit_id',
        'time',
        'days_of_week',
        'timezone',
    ];

    protected $casts = [
        'days_of_week' => 'array',
    ];

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}