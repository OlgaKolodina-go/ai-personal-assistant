<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'schedule_id',
        'channel',
        'enabled',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}